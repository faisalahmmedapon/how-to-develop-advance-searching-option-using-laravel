<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChildCategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Property\PropertyController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::group(['namespace' => 'Admin'], function () {

    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard')->middleware('admin.check');
    Route::get('/admin/login',[AdminController::class,'login'] )->name('admin.login.page')->middleware('admin.check.login');
    Route::post('/admin/login',[AdminController::class,'adminLogin'])->name('admin.login');
    Route::get('/admin/register',[AdminController::class,'register'])->name('admin.register.page')->middleware('admin.check.login');
    Route::post('/admin/register',[AdminController::class,'adminRegister'])->name('admin.register');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
});



Route::prefix('/category')->group(function () {
    Route::get('/index',[CategoryController::class,'index'])->name('category.index');
    Route::get('/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/update/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('/status/{id}',[CategoryController::class,'status'])->name('category.status');
});




Route::prefix('/sub-category')->group(function () {
    Route::get('/index',[SubCategoryController::class,'index'])->name('subcategory.index');
    Route::get('/create',[SubCategoryController::class,'create'])->name('subcategory.create');
    Route::post('/store',[SubCategoryController::class,'store'])->name('subcategory.store');
    Route::get('/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
    Route::post('/update/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
    Route::get('/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');
    Route::get('/status/{id}',[SubCategoryController::class,'status'])->name('subcategory.status');
});




Route::prefix('/child-category')->group(function () {
    Route::get('/index',[ChildCategoryController::class,'index'])->name('childcategory.index');
    Route::get('/create',[ChildCategoryController::class,'create'])->name('childcategory.create');
    Route::post('/store',[ChildCategoryController::class,'store'])->name('childcategory.store');
    Route::get('/edit/{id}',[ChildCategoryController::class,'edit'])->name('childcategory.edit');
    Route::post('/update/{id}',[ChildCategoryController::class,'update'])->name('childcategory.update');
    Route::get('/delete/{id}',[ChildCategoryController::class,'delete'])->name('childcategory.delete');
    Route::get('/status/{id}',[ChildCategoryController::class,'status'])->name('childcategory.status');
});





Route::prefix('/post')->group(function () {
    Route::get('/index',[PostController::class,'index'])->name('post.index');
    Route::get('/create',[PostController::class,'create'])->name('post.create');
    Route::post('/store',[PostController::class,'store'])->name('post.store');
    Route::get('/edit/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::post('/update/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('/delete/{id}',[PostController::class,'delete'])->name('post.delete');
    Route::get('/status/{id}',[PostController::class,'status'])->name('post.status');
    Route::get('/show/{id}',[PostController::class,'show'])->name('post.show');

});


Route::prefix('/user')->group(function () {
    Route::get('/index',[UserController::class,'index'])->name('user.index');
    Route::get('/create',[UserController::class,'create'])->name('user.create');
    Route::post('/store',[UserController::class,'store'])->name('user.store');
    Route::get('/edit/{id}',[UserController::class,'edit'])->name('user.edit');
    Route::post('/update/{id}',[UserController::class,'update'])->name('user.update');
    Route::get('/delete/{id}',[UserController::class,'delete'])->name('user.delete');
    Route::get('/status/{id}',[UserController::class,'status'])->name('user.status');
    Route::get('/show/{id}',[UserController::class,'show'])->name('user.show');

});





Route::prefix('/product')->group(function () {
    Route::get('/index',[ProductController::class,'index'])->name('product.index');
    Route::get('/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/update/{id}',[ProductController::class,'update'])->name('product.update');
    Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
    Route::get('/status/{id}',[ProductController::class,'status'])->name('product.status');
    Route::get('/show/{id}',[ProductController::class,'show'])->name('product.show');

});


Route::prefix('/property')->group(function () {
    Route::get('/index',[PropertyController::class,'index'])->name('property.index');
    Route::get('/create',[PropertyController::class,'create'])->name('property.create');
    Route::post('/store',[PropertyController::class,'store'])->name('property.store');
    Route::get('/edit/{id}',[PropertyController::class,'edit'])->name('property.edit');
    Route::post('/update/{id}',[PropertyController::class,'update'])->name('property.update');
    Route::get('/delete/{id}',[PropertyController::class,'delete'])->name('property.delete');
    Route::get('/status/{id}',[PropertyController::class,'status'])->name('property.status');
    Route::get('/show/{id}',[PropertyController::class,'show'])->name('property.show');

});





Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', [FrontendController::class,'index'])->name('frontend.index');
    Route::get('/category/product/{id}', [FrontendController::class,'show'])->name('category.product');
    Route::get('/product/details/{id}/{category_id}', [FrontendController::class,'productDetails'])->name('product.details');
    Route::get('/districts/{division_id}', [FrontendController::class,'districts'])->name('all.districts');
    Route::get('/upazilas/{district_id}', [FrontendController::class,'upazilas'])->name('all.upazilas');
    Route::get('/unions/{upazila_id}', [FrontendController::class,'unions'])->name('all.unions');

    Route::post('/properties', [FrontendController::class,'properties'])->name('properties');

    Route::get('/property-details/{property_id}', [FrontendController::class,'propertyDetails'])->name('property.details');


});

//
//Route::get('/','FrontendController@index')->name('frontend');
//Route::get('category/product/{id}','FrontendController@show')->name('category.product');
//Route::get('product/details/{id}/{category_id}','FrontendController@productDetails')->name('product.details');
