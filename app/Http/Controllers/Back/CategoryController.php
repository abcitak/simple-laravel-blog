<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Posts;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yoeunes\Toastr\Toastr;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu == "true" ? 1 : 0;
        $category->save();
    }

    public function create(Request $request)
    {
        $isExists = Category::where('slug',Str::slug($request->category))->first();
        if($isExists)
        {
            Toastr('Kategori adı zaten mevcut!',NotificationInterface::ERROR,'Kategori Hatası');
            return redirect()->back();
        }
        $category = new Category;
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->save();
        Toastr('Kategori Eklendi',NotificationInterface::SUCCESS,'Başarılı');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $isCategory = Category::where('name',Str::slug($request->category))->whereNotIn('id',[$request->id])->first();
        $isSlug = Category::where('slug',$request->slug)->whereNotIn('id',[$request->id])->first();
        if($isCategory or $isSlug)
        {
            Toastr('Kategori adı zaten mevcut!',NotificationInterface::ERROR,'Kategori Hatası');
            return redirect()->route('category.index');
        }
        $category = Category::findOrFail($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->slug);
        $category->save();
        Toastr('Kategori Güncellendi',NotificationInterface::SUCCESS,'Başarılı');
        return redirect()->route('category.index');
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if($category->id == 1)
        {
            toastr("Bu kategori silinemez",NotificationInterface::ERROR,'Kategori');
            return redirect()->back();
        }
        $count = $category->PostCount();
        $message = '';
        if($category->PostCount() > 0)
        {
            Posts::where('category_id',$category->id)->update(['category_id' => 1]);
            $defaultCategory = Category::find(1);
            $message ='Kategori Silindi. Bu kategoriye ait '.$count.' makale '.$defaultCategory->name. ' kategorisine taşındı.';
            toastr($message,NotificationInterface::SUCCESS,'Kategori',['positionClass' => 'toast-bottom-right']);

        }else{
            toastr('Kategori Başarıyla Silindi',NotificationInterface::SUCCESS,'Kategori',['positionClass' => 'toast-bottom-right','showDuration'=> 600]);
        }

        $category->delete();
        return redirect()->back();
    }
}
