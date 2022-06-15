<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Myapp\PostController;
use App\Http\Controllers\Myapp\MyappController;
use App\Http\Controllers\Myapp\BlogController;
use App\Http\Controllers\Ecommerce\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Chat\ChatboxController;
use App\Http\Controllers\FileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/users-list',[UsersController::class, 'index'])->name('users-list');
Route::get('/menu-list', [UsersController::class, 'menulist'])->name('menu.list');
//group prefixes route call

Route::controller(MyappController::class)->group(function () {
    Route::get('/my-app', 'myapp');
    Route::group(['prefix' => 'multi'], function(){
        Route::get('/' ,'multiplelanguage')->name('multi');
        Route::post('/save', 'multiplelanguagestore')->name('multi.save');
    });
    Route::group(['prefix' => 'add-lag'], function(){
        Route::get('/', 'addlanguage')->name('add.lag');
        Route::post('/save', 'savelanguage')->name('add-lag.save');
    });
    Route::group(['prefix' => 'learn1'], function(){
        Route::get('/', 'index')->name('learn1');
    });
    Route::group(['prefix' => 'learn2'], function(){
        Route::get('/', 'learn2')->name('learn2');
        Route::get('/get-states', 'getStates')->name('learn2.getStates');
        Route::get('/get-cities', 'getCities')->name('learn2.getCities');
    });
    Route::group(['prefix' => 'learn3'], function(){
        Route::get('/', 'learn3')->name('learn3');
    });
});

//cat post

Route::controller(PostController::class)->group(function(){
    Route::group(['prefix' => 'learn4'], function(){
      Route::get('/', 'index')->name('learn4');
      Route::get('/create', 'create')->name('learn4.create');
      Route::post('/store', 'store')->name('learn4.store');
      Route::post('/delete', 'delete')->name('learn4.delete');
    });
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index');
    Route::post('/save', 'registerbloguser');
    Route::get('/customer', 'customer');
    Route::group(['prefix'=>'post'], function(){
        Route::get('/index', 'postview');
        Route::post('/save', 'postsave')->name('post.save');
        Route::get('/{slug}' ,'postview')->name('post.view');
        Route::get('/edit/{id}', 'postedit')->name('post.edit');
        Route::post('/store/', 'storepost')->name('post.store');
    });
});

Route::controller(IndexController::class)->group(function () {
   Route::group(['prefix' => 'ecommerce'], function(){
      Route::get('/', 'index')->name('ecommerce');
   }); 
});

Route::get('/test', [ProductController::class, 'index']);  
Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

Route::get('/products', [ProductController::class, 'productsapi'])->name('products');
Route::get('/count',[UsersController::class, 'countuser']);
//menu multiple
Route::get('/menu', [MenuController::class, 'getMenu']);

Route::controller(ChatboxController::class)->group(function(){
    Route::group(['prefix' => 'chat'], function(){
        Route::get('/', 'index')->name('chat');
        Route::post('/save', 'sendsms')->name('chat.save');
    });
});

//file upload
Route::controller(FileController::class)->group(function(){
    Route::group(['prefix' => 'file'], function(){
        Route::get('/', 'index')->name('file');
        Route::post('/save', 'save')->name('file.save');
    });
});

