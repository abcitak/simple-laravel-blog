<?php

use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Front\Homepage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\PostController;
use App\Http\Controllers\Back\ConfigController;

// Admin Routes
Route::prefix('admin')->middleware(['isLogin'])->group(function (){
Route::get('login',[AuthController::class,'login'])->name('admin.login');
Route::post('login',[AuthController::class,'loginPost'])->name('admin.login.post');
});

Route::prefix('admin')->middleware(['isAdmin'])->group(function (){
    Route::get('panel', [Dashboard::class,'index'])->name('admin.panel');

    // POSTS ROUTE'S
    Route::get('/deletePost/{id}',[PostController::class,'delete'])->name('admin.delete');
    Route::get('/deleteTrashed',[PostController::class,'trashed'])->name('admin.delete.trashed');
    Route::get('/recoverPost/{id}',[PostController::class,'recovery'])->name('admin.delete.recovery');
    Route::get('/deleteNow/{id}',[PostController::class,'deleteNow'])->name('admin.delete.hardDelete');
    Route::resource('makaleler', PostController::class);
    Route::get('/switch',[PostController::class,'switch'])->name('admin.switch');

    // CATEGORY ROUTE'S
    Route::get('/kategoriler',[CategoryController::class,'index'])->name('category.index');
    Route::get('/category/switch',[CategoryController::class,'switch'])->name('category.switch');
    Route::post('/kategori/create',[CategoryController::class,'create'])->name('category.create');
    Route::get('kategoriler/getData',[CategoryController::class,'getData'])->name('category.getData');
    Route::post('kategoriler/update',[CategoryController::class,'update'])->name('category.update');
    Route::post('kategoriler/delete',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('logout',[AuthController::class,'logout'])->name('admin.logout');

    // PAGE ROUTE'S
    Route::get('sayfalar/',[PageController::class,'index'])->name('page.index');
    Route::get('sayfa/create',[PageController::class,'create'])->name('page.create');
    Route::post('sayfa/create',[PageController::class,'createPage'])->name('page.create.new');
    Route::post('/sayfa/update/{id}',[PageController::class,'update'])->name('page.update');
    Route::get('/sayfa/updatePage/{id}',[PageController::class,'updatePage'])->name('page.update.process');
    Route::get('sayfa/delete/{id}',[PageController::class,'delete'])->name('page.delete');
    Route::get('/sayfa/switch',[PageController::class,'switch'])->name('admin.page.switch');
    Route::get('/sayfa/orders',[PageController::class,'orders'])->name('page.orders');

    // CONFIG ROUTE'S
    Route::get('/ayarlar',[ConfigController::class,'index'])->name('site.settings');
    Route::post('/ayarlar/update',[ConfigController::class,'update'])->name('config.update');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('site-bakimda',function(){
    return view('front.offline');
});

Route::get('/', [Homepage::class,'index'])->name('homepage');


Route::get('/iletisim',[Homepage::class,'contact'])->name('contact');
Route::post('/iletisim',[Homepage::class,'contactPost'])->name('contact.post');
Route::get('/yazilar', [Homepage::class,'index']);
Route::get('/kategori/{slug}',[Homepage::class,'getCategories'])->name('Categories');
Route::get('/blog/{kategoriSlug}/{slug}',[Homepage::class,'singlePost'])->name('singlePost');
Route::get('/{sayfa}',[Homepage::class,'page'])->name('pages');

