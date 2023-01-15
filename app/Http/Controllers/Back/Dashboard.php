<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pages;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{

    public function index()
    {
        $posts = Posts::all()->count();
        $hit = Posts::sum('hit');
        $category = Category::all()->count();
        $page = Pages::all()->count();
        return view('back.dashboard',compact('posts','hit','category','page'));
    }


}
