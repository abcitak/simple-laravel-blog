<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use App\Models\Contact;
use App\Models\Pages;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Homepage extends Controller
{
    //

    public function __construct()
    {
        $config = Config::find(1);
        if($config->active == 0)
        {
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages',Pages::where('status',1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::where('status',1)->get());
        view()->share('config',Config::findOrFail(1));
    }

    public function index()
    {
        $data['posts'] = Posts::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
            $query->where('status',1);
        })->simplePaginate(10);
        return view('front.homepage',$data);

    }

    public function singlePost($category,$slug)
    {
        $categories = Category::whereSlug($category)->first() ?? abort(403,'Kategori Bulunamadı');
        $posts = Posts::whereSlug($slug)->whereCategoryId($categories->id)->first() ?? abort(403,'Yazı Bulunamadı');
        $posts->increment('hit');
        $data['post'] = $posts;
        return view('front.singlePost',$data);
    }

    public function getCategories($slug)
    {

        $category = Category::whereSlug($slug)->first() ?? abort(403,'Kategori Bulunamadı');
        $data['category'] = $category;
        $data['posts'] = Posts::where('category_id',$category->id)->where('status',1)->simplePaginate(1);
        return view('front.categories',$data);
    }

    public function page($slug)
    {
        $pages = Pages::where('slug',$slug)->first() ?? abort(403,'Sayfa bulunamadı');
        $data['page']=$pages;
        return view('front.page',$data);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactPost(Request $request)
    {
        $rules = [
            'name' => 'min:3|required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'min:10|required'
        ];
        $validation = Validator::make($request->post(),$rules);
        if ($validation->fails())
        {
            return redirect()->route('contact')->withErrors($validation)->withInput();
        }

       $contact = new Contact();
       $contact->name = $request->name;
       $contact->email = $request->email;
       $contact->subject = $request->subject;
       $contact->message = $request->message;
       $contact->save();
       return redirect()->route('contact')->with('success','Mesajınız Gönderildi! En kısa sürede dönüş sağlanacaktır.');
    }
}
