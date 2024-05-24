<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\front\FrontHomeController;
use App\Http\Controllers\front\CartController;
use Illuminate\Http\Request;


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




/*
		##########################################
		########### Admin Route ##################
		##########################################
*/

Route::group(['prefix'=> 'admin'],function(){

	Route::group(['middleware' => 'admin.guest'], function(){
		Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
		Route::post('/auth', [AdminController::class, 'authenticate'])->name('admin.authenticate');
	});

	Route::group(['middleware' => 'admin.auth'], function(){

		Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
		Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

		/*
		##########################################
		########### Categories####################
		##########################################
		*/
		Route::get('/categories', [CategorieController::class, 'index'])->name('admin.all.categorie');
		Route::get('/add/categorie', [CategorieController::class, 'create'])->name('admin.add.categorie');
		Route::post('/store/categorie', [CategorieController::class, 'store'])->name('admin.store.categorie');
		Route::get('/edit/categorie/{cid}', [CategorieController::class, 'edit'])->name('admin.edit.categorie');
		Route::post('/update/categorie', [CategorieController::class, 'update'])->name('admin.update.categorie');
		Route::get('/delete/categorie/{id}', [CategorieController::class, 'destroy'])->name('admin.delete.categorie');

		/*
		##########################################
		########### Categories####################
		##########################################
		*/

		Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('admin.all.subcategory');
		Route::get('/add/subcategories', [SubCategoryController::class, 'create'])->name('admin.add.subcategory');
		Route::post('/store/subcategories', [SubCategoryController::class, 'store'])->name('admin.store.subcategory');
		Route::get('/edit/subcategories/{id}', [SubCategoryController::class, 'edit'])->name('admin.edit.subcategory');
		Route::post('/update/subcategories', [SubCategoryController::class, 'update'])->name('admin.update.subcategory');
		Route::get('/update/subcategories/{id}', [SubCategoryController::class, 'delete'])->name('admin.delete.subcategory');

		/*
		##########################################
		########### Categories####################
		##########################################
		*/

		Route::get('/brand', [BrandController::class, 'index'])->name('admin.all.brand');
		Route::get('/add/brand', [BrandController::class, 'create'])->name('admin.add.brand');
		Route::post('/store/brand', [BrandController::class, 'store'])->name('admin.store.brand');
		Route::get('/edit/brand/{id}', [BrandController::class, 'edit'])->name('admin.edit.brand');
		Route::post('/update/brand', [BrandController::class, 'update'])->name('admin.update.brand');
		Route::get('/delete/brand/{id}', [BrandController::class, 'delete'])->name('admin.delete.brand');


		/*
		##########################################
		############## Product ###################
		##########################################
		*/

		Route::get('/product', [ProductController::class, 'index'])->name('admin.all.product');
		Route::get('/add/product', [ProductController::class, 'create'])->name('admin.add.product');
		Route::post('/store/product', [ProductController::class, 'store'])->name('admin.store.product');
		Route::get('/edit/product/{id}', [ProductController::class, 'edit'])->name('admin.edit.product');
		Route::post('/update/product', [ProductController::class, 'update'])->name('admin.update.product');
		Route::get('/delete/product/{id}', [ProductController::class, 'destroy'])->name('admin.delete.product');


		Route::get('/product/subcategory', [ProductSubCategoryController::class, 'index'])->name('admin.product.subcategory');



	});
});

/*
		##########################################
		########### Front End Route ##############
		##########################################
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontHomeController::class, 'index'])->name('front.home');
Route::get('/cart', [CartController::class, 'cart'])->name('front.cart');
// Route definition in web.php
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('front.addToCart');
Route::get('/{categorySlug?}/{subCategorySlug?}', [FrontHomeController::class, 'products'])->name('front.product');
