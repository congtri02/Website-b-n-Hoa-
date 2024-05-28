<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Users\UserShopController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {

    return view('welcome');
});

Route::get('admin/login', [
    'as' => 'admin.login',
    'uses' => 'App\Http\Controllers\Admin\Users\LoginController@index'
]);
Route::get('admin/logout', [
    'as' => 'admin.logout',
    'uses' => 'App\Http\Controllers\Admin\Users\LoginController@logout'
]);


Route::post('/admin/users/login/store', [
    'as' => 'admin.store',
    'uses' => 'App\Http\Controllers\Admin\Users\LoginController@store'
]);

Route::group(['middleware' => 'Admin'], function () {

    Route::get('admin/main', [
        'as' => 'admin.main',
        'uses' => 'App\Http\Controllers\Admin\MainController@index'
    ]);
    #menus
        // Route::prefix('menus')->group(function(){
            Route::get('admin/menus/add', [
                'as' => 'menus.add',
                'uses' => 'App\Http\Controllers\Admin\MenuController@create'
            ]);
            Route::post('admin/menus/add', [
                'as' => 'menus.add',
                'uses' => 'App\Http\Controllers\Admin\MenuController@store'
            ]);
            Route::get('admin/menus/list', [
                'as' => 'menus.list',
                'uses' => 'App\Http\Controllers\Admin\MenuController@index'
            ]);
            Route::post('admin/menus/destroy', [
                'as' => 'menus.destroy',
                'uses' => 'App\Http\Controllers\Admin\MenuController@destroy'
            ]);

            Route::get('/admin/menus/edit/{menu}',[MenuController::class,'show'])->name('menus.edit');
            Route::post('/admin/menus/edit/{menu}',[MenuController::class,'update'])->name('menus.edit');
        #product
//             Route::prefix('product')->group(function(){
                 Route::get('admin/product/add', [
                     'as' => 'product.add',
                     'uses' => 'App\Http\Controllers\Admin\ProductController@create'
                 ]);
                 Route::post('admin/product/store',[
                     'as' => 'product.store',
                     'uses'=>'App\Http\Controllers\Admin\ProductController@store'
                 ]);
                 Route::get('admin/product/list',[
                    'as' => 'product.list',
                    'uses'=>'App\Http\Controllers\Admin\ProductController@index'
        ]);
                Route::get('/admin/product/edit/{product}',[ProductController::class,'show'])->name('product.edit');
                Route::post('/admin/product/edit/{product}',[ProductController::class,'update'])->name('product.edit');
                Route::post('admin/product/destroy', [
                    'as' => 'product.destroy',
                    'uses' => 'App\Http\Controllers\Admin\ProductController@destroy'
        ]);
        #slide
        Route::get('admin/sliders/add', [
            'as' => 'sliders.add',
            'uses' => 'App\Http\Controllers\Admin\SliderController@create'
        ]);
        Route::post('admin/sliders/add',[
            'as' => 'sliders.add',
            'uses'=>'App\Http\Controllers\Admin\SliderController@store'
        ]);
        Route::get('admin/sliders/list',[
            'as' => 'sliders.list',
            'uses'=>'App\Http\Controllers\Admin\SliderController@index'
        ]);
        Route::get('/admin/sliders/edit/{id}',[SliderController::class,'show'])->name('sliders.edit');
        Route::post('/admin/sliders/edit/{id}',[SliderController::class,'update'])->name('sliders.edit');
        Route::post('admin/sliders/destroy', [
            'as' => 'sliders.destroy',
            'uses' => 'App\Http\Controllers\Admin\SliderController@destroy'
        ]);
        #tin tức
        Route::get('admin/news/add', [
            'as' => 'news.create',
            'uses' => 'App\Http\Controllers\Admin\NewController@create'
        ]);
        Route::post('admin/news/add',[
            'as' => 'news.add',
            'uses'=>'App\Http\Controllers\Admin\NewController@store'
        ]);
        Route::get('admin/news/list',[
            'as' => 'news.list',
            'uses'=>'App\Http\Controllers\Admin\NewController@index'
        ]);
        Route::get('/admin/news/edit/{id}',[NewController::class,'show'])->name('news.edit');
        Route::post('/admin/news/edit/{id}',[NewController::class,'update'])->name('news.edit');
        Route::post('admin/news/destroy', [
            'as' => 'news.destroy',
            'uses' => 'App\Http\Controllers\Admin\NewController@destroy'
        ]);
        #cart admin
        Route::get('admin/customers/cart', [
            'as' => 'customers.cart',
            'uses' => 'App\Http\Controllers\Admin\CartAdminController@index'
        ]);
    Route::post('admin/customers/destroy{id}', [
        'as' => 'customers.destroy',
        'uses' => 'App\Http\Controllers\Admin\CartAdminController@destroy'
    ]);
        Route::get('admin/customers/view/{customer}', [
            'as' => 'customers.view',
            'uses' => 'App\Http\Controllers\Admin\CartAdminController@show'
        ]);



        #upload
        Route::post('admin/upload/services', [
            'as' => 'upload.services',
            'uses' => 'App\Http\Controllers\Admin\UploadController@store'
        ]);

//    quan ly người dùng qua admin
    Route::get('admin/user/add', [
        'as' => 'user.add',
        'uses' => 'App\Http\Controllers\Admin\Users\UserShopController@create'
    ]);
    Route::post('admin/user/store',[
        'as' => 'user.store',
        'uses'=>'App\Http\Controllers\Admin\Users\UserShopController@store'
    ]);
    Route::get('admin/user/list',[
        'as' => 'user.list',
        'uses'=>'App\Http\Controllers\Admin\Users\UserShopController@index'
    ]);
    Route::get('/admin/user/edit/{id}',[UserShopController::class,'show'])->name('user.edit');
    Route::post('/admin/user/edit/{id}',[UserShopController::class,'update'])->name('user.edit');
    Route::post('admin/user/destroy', [
        'as' => 'user.destroy',
        'uses' => 'App\Http\Controllers\Admin\Users\UserShopController@destroy'
        ]);
});
//});
#==================================================================================================================================

Route::get('pages/login', [
    'as' => 'pages.login',
    'uses' => 'App\Http\Controllers\PagesShopController@index'
]);
Route::post('pages/store', [
    'as' => 'pages.store',
    'uses' => 'App\Http\Controllers\PagesShopController@store'
]);
Route::get('pages/dangki', [
    'as' => 'pages.dangki',
    'uses' => 'App\Http\Controllers\PagesShopController@dangki'
]);
Route::post('shop/dangki', [
    'as' => 'shop.dangki',
    'uses' => 'App\Http\Controllers\PagesShopController@dangkinguoidung'
]);
#home
# trang người dùng
Route::get('/home',[
    'as' => 'home',
    'uses'=>'App\Http\Controllers\MainController@index'
]);
Route::post('/services/load-product', [
    'as' => 'services.load-product',
    'uses' => 'App\Http\Controllers\MainController@loadProduct'
]);

Route::get('tin-tuc/{id}-{slug}.html', [
    'as' => 'new.shop',
    'uses' => 'App\Http\Controllers\NewShopController@index'
]);
Route::get('danh-muc/{id}-{slug}.html', [
    'as' => 'menu.shop',
    'uses' => 'App\Http\Controllers\MenushopController@index'
]);
Route::get('san-pham/{id}-{slug}.html', [
    'as' => 'product.shop',
    'uses' => 'App\Http\Controllers\ProductshopController@index'
]);
    Route::get('search/product', [
        'as' => 'search/product',
        'uses' => 'App\Http\Controllers\ProductshopController@searchProduct'
    ]);
// ====================================================
Route::middleware(['User'])->group(function(){

Route::get('user/logout', [
    'as' => 'user.logout',
    'uses' => 'App\Http\Controllers\PagesShopController@logout'
]);

#AI
Route::get('ai/shop',[
    'as' => 'ai.shop',
    'uses'=>'App\Http\Controllers\AiController@index'
]);

Route::post('user-send-request',[
    'as' =>'user.sendAi',
    'uses' => 'App\Http\Controllers\AiController@sendAi'
]);
Route::post('search-products/shop',[
    'as' => 'search.products',
    'uses'=>'App\Http\Controllers\AiController@search'
]);

//Route::get('/danh-muc/{id}-{slug}', 'MenushopController@index')->name('danh-muc');

Route::post('addCart/shop',[
    'as' => 'addCart.shop',
    'uses' => 'App\Http\Controllers\CartController@index'
]);
Route::get('carts/shop',[
    'as' => 'carts.shop',
    'uses' => 'App\Http\Controllers\CartController@show'
]);
Route::post('UpdateCarts/shop',[
    'as' => 'UpdateCarts.shop',
    'uses' => 'App\Http\Controllers\CartController@update'
]);
Route::get('carts/delete/{id}',[
    'as' => 'cartsDelete.shop',
    'uses' => 'App\Http\Controllers\CartController@remove'
]);
Route::post('carts/shop',[
    'as' => 'carts.shop',
    'uses' => 'App\Http\Controllers\CartController@addCart'
    ]);
});
