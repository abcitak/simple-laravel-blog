<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Posts::orderBy('created_at','ASC')->get();
        return view('back.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id','ASC')->get();
        return view('back.posts.create',compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,gif|max:2048',
            'category' => 'required',
            'content' => 'required'
        ]);
        // ekleme işlemi
        $posts = new Posts;
        $posts->category_id = $request->category;
        $posts->title = $request->title;
        $posts->content = $request->content;
        $posts->slug = Str::slug($request->title);
        if($request->hasFile('image'))
        {
            $imageName = Str::slug($request->title).'-'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $posts->image = 'uploads/'.$imageName;
        }
        $posts->save();
        toastr('Makale eklendi');
        return redirect()->route('makaleler.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $posts = Posts::findOrFail($id);
        $categories = Category::orderBy('id','ASC')->get();
        return view('back.posts.update',compact('categories','posts'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:jpg,png,jpeg,webp,gif|max:2048',
            'category' => 'required',
            'content' => 'required'
        ]);
        // ekleme işlemi
        $posts = Posts::findOrFail($id);
        $posts->category_id = $request->category;
        $posts->title = $request->title;
        $posts->content = $request->content;
        $posts->slug = Str::slug($request->title);
        if($request->hasFile('image'))
        {
            $imageName = Str::slug($request->title).'-.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $posts->image = 'uploads/'.$imageName;
        }
        $posts->save();
        toastr('Makale güncellendi');
        return redirect()->route('makaleler.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        Posts::findOrFail($id)->delete();
        toastr('Başarılı');
        return redirect()->back();
    }

    public function trashed()
    {
        $posts = Posts::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('back.posts.trashed',compact('posts'));
    }

    public function recovery($id)
    {
        Posts::onlyTrashed()->find($id)->restore();
        toastr('Makale Geri Alındı');
        return redirect()->route('makaleler.index');
    }

    public function deleteNow($id)
    {
        $posts = Posts::onlyTrashed()->findOrFail($id);
        if(File::exists($posts->image))
        {
            File::delete(public_path($posts->image));
        }
        toastr('Makale başarıyla silindi');
        return redirect()->route('makaleler.index');
    }
    public function switch(Request $request)
    {
        $posts = Posts::findOrFail($request->id);
        $posts->status = $request->statu == "true" ? 1 : 0;
        $posts->save();
    }
}
