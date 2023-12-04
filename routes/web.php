<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Product;
use App\Models\Cart;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return view('home');
    });


});


//GUEST SIDE---------------------------------------------------------------
Route::get('/guest-viewproduct/{id}',[ProductController::class,'viewProduct']);

//CUSTOMER SIDE------------------------------------------------------------

Route::get('/',[AnnouncementController::class,'viewAnnouncements']);
Route::get('/home',[AnnouncementController::class,'viewAnnouncements']);

Route::get('/menu', [ProductController::class,'displayAllProducts']);
Route::get('/viewproduct/{id}', [ProductController::class,'viewProduct']);

Route::get('/about', function (){
    if(Auth::check() && Auth::user()->account_type == 'customer'){
        return view('about'); 
    }
    return view('guest-about');
});

//MANAGE CART
Route::get('/cart',[CartController::class,'viewCart']);
Route::get('/cart/add/{id}',[CartController::class,'addCart']);
Route::get('/cart/delete/{id}',[CartController::class,'deleteCartItem']);
Route::get('/cart/getTotalCartPrice',[CartController::class,'getTotalCartPrice']);
Route::post('/cart/update',[CartController::class,'updateCartItems'])->name('updateCart');
//CHECKOUT PAGE
Route::get('/checkout',function(){
    return view('checkout');
});


Route::get('/myorders', function (){
    if(Auth::check() && Auth::user()->account_type == 'customer'){
        return view('myorders'); 
    }
    return view('auth/login');
});

Route::get('/myprofile', [UserController::class, 'viewUserProfile'])->name('myprofile');


//HELP CENTER
Route::get('/faq', function (){
    return view('faq');
});

Route::get('/termsofservice', function (){
    return view('termsofservice');
});

Route::get('/privacypolicy', function (){
    return view('privacypolicy');
});

// ADMIN SIDE--------------------------------------------------------------
Route::get('/admin-home', function () {
    if(Auth::check() && Auth::user()->account_type == 'admin'){
        return view('admin/admin-home');
    }else{
        return view('auth/login');
    }
});

//Manage Announcements
Route::get('/admin-manageAnnouncements',[AnnouncementController::class,'viewAnnouncements'])->name('admin-manageAnnouncements');

Route::get('/admin-addAnnouncement', function () {
    if(Auth::check() && Auth::user()->account_type == 'admin'){
        return view('admin/admin-addAnnouncement');
    }else{
        return view('auth/login');
    }
});

Route::get('/admin-editAnnouncement',[AnnouncementController::class, 'editAnnouncement'])->name('admin-editAnnouncement');

Route::post('/admin-manageAnnouncements/add',[AnnouncementController::class, 'createAnnouncement'])->name('addAnnouncement');
Route::post('/admin-manageAnnouncements/edit',[AnnouncementController::class, 'updateAnnouncement'])->name('updateAnnouncement');
Route::post('/admin-manageAnnouncements/delete',[AnnouncementController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');

//Manage Products
Route::get('/admin-addProduct',function(){
    return view("admin/admin-addProduct");
})->name('admin-addProduct');


Route::get('/admin-editProduct/{id}',[ProductController::class,'editProduct']);
Route::post('/admin-editProduct/update/{id}',[ProductController::class,'updateProduct']);


Route::get('/admin-manageProducts',[ProductController::class,'displayAllProducts'])->name('admin-manageProducts');

Route::post('/admin-manageProducts/add',[ProductController::class, 'createProduct'])->name('addProduct');

Route::get('/admin-viewProduct/{id}', [ProductController::class, 'viewProduct'])->name('admin-viewproduct');
//Manage Customers

//Manage Orders

//Manage Sales Report