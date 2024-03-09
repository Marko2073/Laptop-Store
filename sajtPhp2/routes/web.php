<?php

use App\Http\Controllers\AdminModelSpecificationController;
use App\Http\Controllers\AdminPicturesController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminSpecificationsController;
use App\Http\Controllers\AdminSpecificationsIndividualyController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminBrandsController;
use App\Http\Controllers\AdminModelsController;
use App\Http\Controllers\AdminMenusController;
use App\Http\Controllers\AdminPricesController;
use App\Http\Controllers\AdminRolesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/api/products', [ShopController::class, 'api'])->name('api');
Route::get('/api/products/{param}', [ShopController::class, 'search'])->name('search');
Route::get('/api/usercard', [UserController::class, 'usercard'])->name('usercard');
Route::post('/products/order', [ShopController::class, 'orderproducts'])->name('orderproducts');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/store', [RegisterController::class, 'store'])->name('store');
Route::post('/updateuser', [RegisterController::class, 'updateuser'])->name('updateuser');
Route::post('/updatepicture', [RegisterController::class, 'updatepicture'])->name('updatepicture');
Route::post('/mailto', [ContactController::class, 'mailto'])->name('mailto');

Route::post('/storecard', [UserController::class, 'storecard'])->name('storecard');
Route::post('/updatecard', [UserController::class, 'updatecard'])->name('updatecard');
Route::post('/addreview', [UserController::class, 'addreview'])->name('addreview');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');



Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/admin/{dateFilter?}', [AdminController::class, 'admin'])->name('admin');
    Route::get('/admin/{name}', [AdminController::class, 'table'])->name('table');
    Route::resource('/brands', AdminBrandsController::class);
    Route::resource('/models', AdminModelsController::class);
    Route::resource('/menus', AdminMenusController::class);
    Route::resource('/model_specification', AdminModelSpecificationController::class);
    Route::resource('/pictures', AdminPicturesController::class);
    Route::resource('/prices', AdminPricesController::class);
    Route::resource('/roles', AdminRolesController::class);
    Route::resource('/specifications', AdminSpecificationsController::class);
    Route::resource('/specifications_individually', AdminSpecificationsIndividualyController::class);
    Route::resource('users', AdminUsersController::class);
    Route::resource('/reviews', AdminReviewController::class);
});

/*Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::get('/admin/{name}', [AdminController::class, 'table'])->name('table');


Route::resource('/brands', AdminBrandsController::class);
Route::resource('/models', AdminModelsController::class);
Route::resource('/menus', AdminMenusController::class);
Route::resource('/model_specification', AdminModelSpecificationController::class);
Route::resource('/pictures', AdminPicturesController::class);
Route::resource('/prices', AdminPricesController::class);
Route::resource('/roles', AdminRolesController::class);
Route::resource('/specifications', AdminSpecificationsController::class);
Route::resource('/specifications_individually', AdminSpecificationsIndividualyController::class);
Route::resource('users', AdminUsersController::class);*/



