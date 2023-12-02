<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProductController;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Product;

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

//GUEST AND CUSTOMER SIDE
// Route::get('/', function () {
//     if(Auth::check() && Auth::user()->account_type == 'customer'){
//         return view('home'); 
//     }
//     return view('guest-home');
// });

Route::get('/',[AnnouncementController::class,'viewAnnouncements']);
Route::get('/home',[AnnouncementController::class,'viewAnnouncements']);

// Route::get('/home', function () {
//     if(Auth::check() && Auth::user()->account_type == 'customer'){
//         return view('home'); 
//     }else if (Auth::check() && Auth::user()->account_type == 'admin'){
//         return view('admin/admin-home');
//     }else{
//         return view('guest-home');
//     }
// });

Route::get('/menu', function () {
    if(Auth::check() && Auth::user()->account_type == 'customer'){
        return view('menu'); 
    }
    return view('guest-menu');
});

Route::get('/cart', function () {
    if(Auth::check() && Auth::user()->account_type == 'customer'){
        return view('cart'); 
    }
    return view('auth/login');
});

Route::get('/about', function (){
    if(Auth::check() && Auth::user()->account_type == 'customer'){
        return view('about'); 
    }
    return view('guest-about');
});

Route::get('/myorders', function (){
    if(Auth::check() && Auth::user()->account_type == 'customer'){
        return view('myorders'); 
    }
    return view('auth/login');
});

Route::get('/myprofile', [UserController::class, 'viewUserProfile'])->name('myprofile');

Route::get('/faq', function (){
    return view('faq');
});

Route::get('/termsofservice', function (){
    return view('termsofservice');
});

Route::get('/privacypolicy', function (){
    return view('privacypolicy');
});

// ADMIN SIDE....
Route::get('/admin-home', function () {
    if(Auth::check() && Auth::user()->account_type == 'admin'){
        $user=User::find(Auth::user()->id);
        return view('admin/admin-home',compact('user'));
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


Route::get('/admin-manageProducts',function(){
    $products = Product::latest()->paginate('5');
    if(Auth::check() && Auth::user()->account_type == 'admin'){
        $user=User::find(Auth::user()->id);
        return view('admin/admin-manageProducts',compact('user','products'));
    }else{
        return view('auth/login');
    }
})->name('admin-manageProducts');

Route::post('/admin-manageProducts/add',[ProductController::class, 'createProduct'])->name('addProduct');


//Manage Customers

//Manage Orders

//Manage Sales Report