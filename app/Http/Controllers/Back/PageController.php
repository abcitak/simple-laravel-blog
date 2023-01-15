<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PageController extends Controller
{
    //

    public function index()
    {
        $pages = Pages::orderBy('order','ASC')->get();
        return view('back.page.index',compact('pages'));
    }

    public function switch(Request $request)
    {
        $page = Pages::findOrFail($request->id);
        $page->status = $request->statu == "true" ? 1 : 0;
        $page->save();
    }

    public function create()
    {
        return view('back.page.create');
    }

    public function createPage(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,gif,webp,jpeg|max:2048'
        ]);

        $last = Pages::orderBy('order','DESC')->first();
        $page = new Pages();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = Str::slug($request->title);
        $page->order = $last->order + 1;
        if($request->hasFile('image'))
        {
            $imageName = Str::slug($request->title).'-'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image = 'uploads/'.$imageName;
        }
        $page->save();
        toastr('Sayfa eklendi',NotificationInterface::SUCCESS,'Başarılı');
        return redirect()->route('page.index');

    }

    public function updatePage($id)
    {
        $page = Pages::find($id);
        return view('back.page.update',compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:jpg,png,jpeg,webp,gif|max:2048',
            'content' => 'required'
        ]);
        // güncelleme işlemi
        $page = Pages::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = Str::slug($request->title);
        if($request->hasFile('image'))
        {
            $imageName = Str::slug($request->title).'-'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image = 'uploads/'.$imageName;
        }
        $page->save();
        toastr('Sayfa güncellendi',NotificationInterface::SUCCESS,'Sayfa');
        return redirect()->route('page.index');
    }

    public function delete($id)
    {
        Pages::findOrFail($id)->delete();
        toastr('Başarılı',NotificationInterface::SUCCESS,'Sayfa Silindi');
        return redirect()->back();
    }

    public function orders(Request $request)
    {
        foreach($request->get('page') as $key => $order)
        {
            Pages::where('id',$key)->update(['order' => $order]);
        }
    }
}
