<?php
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use App\Models\OrderedProduct;
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
        if(Auth::user()->account_status == 'active'){
            return view('about');
        }else{
            Auth::logout();
            session()->flash('success','Your account has been blocked by the Administrator.');
            return view('auth/login');
        }
    }else{
        Auth::logout();
        return view('guest-about');
    }
});

//MANAGE CART
Route::get('/cart',[CartController::class,'viewCart'])->name('cart');
Route::get('/cart/add/{id}',[CartController::class,'addCart']);
Route::get('/cart/delete/{id}',[CartController::class,'deleteCartItem']);
Route::post('/cart/deleteAll',[CartController::class,'deleteAllCartItems']);
Route::get('/cart/getTotalCartPrice',[CartController::class,'getTotalCartPrice']);
Route::post('/cart/update',[CartController::class,'updateCartItems'])->name('updateCart');

//CHECKOUT PAGE
Route::get('/checkout',[CartController::class,'viewCheckoutItems']);

//MY ORDERS
Route::get('/myorders', [OrderController::class,'viewAllMyOrders'])->name('myorders');
Route::post('/myorders/placeorder',[OrderController::class,'addOrder'])->name('placeOrder');
Route::get('/vieworder/{orderid}', [OrderController::class,'viewSpecificOrder'])->name('vieworder');
Route::get('/vieworder/customercancelorder/{orderid}', [OrderController::class,'cancelOrder'])->name('vieworder'); //cancel order from customer side
Route::get('/myorders/viewreceipt/{id}', [OrderController::class,'viewReceipt'])->name('viewReceipt');

//MANAGE 'MY PROFILE' PAGE
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
        Auth::logout();
        return view('auth/login');
    }
});

Route::get('/admin-about', function () {
    if(Auth::check() && Auth::user()->account_type == 'admin'){
        return view('admin/admin-about');
    }else{
        Auth::logout();
        return view('auth/login');
    }
})->name('admin-about');

//Manage Announcements
Route::get('/admin-manageAnnouncements',[AnnouncementController::class,'adminViewAnnouncements'])->name('admin-manageAnnouncements');

Route::get('/admin-addAnnouncement', function () {
    if(Auth::check() && Auth::user()->account_type == 'admin'){
        return view('admin/admin-addAnnouncement');
    }else{
        Auth::logout();
        return view('auth/login');
    }
});

Route::get('/admin-editAnnouncement',[AnnouncementController::class, 'editAnnouncement'])->name('admin-editAnnouncement');

Route::post('/admin-manageAnnouncements/add',[AnnouncementController::class, 'createAnnouncement'])->name('addAnnouncement');
Route::post('/admin-manageAnnouncements/edit',[AnnouncementController::class, 'updateAnnouncement'])->name('updateAnnouncement');
Route::post('/admin-manageAnnouncements/delete',[AnnouncementController::class, 'deleteAnnouncement'])->name('deleteAnnouncement');

//Manage Products
Route::get('/admin-addProduct',function(){
    if(Auth::check() && Auth::user()->account_type == 'admin'){
        return view("admin/admin-addProduct");
    }else{
        Auth::logout();
        return view('auth/login');
    }
})->name('admin-addProduct');


Route::get('/admin-editProduct/{id}',[ProductController::class,'editProduct']);
Route::post('/admin-editProduct/update/{id}',[ProductController::class,'updateProduct']);


Route::get('/admin-manageProducts',[ProductController::class,'displayAllProducts'])->name('admin-manageProducts');

Route::post('/admin-manageProducts/add',[ProductController::class, 'createProduct'])->name('addProduct');

Route::get('/admin-viewProduct/{id}', [ProductController::class, 'viewProduct'])->name('admin-viewproduct');

//Manage Orders
Route::get('/admin-manageOrders',[OrderController::class,'viewAllCustomerOrders'])->name('admin-manageOrders');
Route::get('/admin-viewOrder/{orderid}',[OrderController::class,'viewSpecificOrder']);
Route::post('admin-viewOrder/deliveryfee',[OrderController::class,'setDeliveryFee'])->name('setdeliveryfee');//set order's delivery / shipping fee
Route::post('admin-viewOrder/deliverydate',[OrderController::class,'setDeliveryDate'])->name('setdeliverydate');//set order's delivery date
Route::post('admin-viewOrder/editdeliverydate',[OrderController::class,'editDeliveryDate'])->name('editdeliverydate');//edit order's delivery date

Route::get('/admin-viewOrder/pending/{id}',[OrderController::class,'setOrderStatusToPending']); //set order status back to "Pending"
Route::get('/admin-viewOrder/readyForOnsitePayment/{id}',[OrderController::class,'setOrderStatusToReadyForOnsitePayment']); //set order status to "Ready for Onsite Payment"
Route::get('/admin-viewOrder/processing/{id}',[OrderController::class,'setOrderStatusToProcessing']); //set order status to 'Processing'
Route::get('/admin-viewOrder/delivered/{id}',[OrderController::class,'setOrderStatusToDelivered']); //set order status to 'Delivered'
Route::get('/admin-viewOrder/shipped/{id}',[OrderController::class,'setOrderStatusToShipped']); //set order status to 'Shipped'
Route::get('/admin-viewOrder/cancelorder/{id}',[OrderController::class,'cancelOrder']); //Permanently Cancel an Order..
Route::get('/admin-viewOrder/viewreceipt/{id}', [OrderController::class,'viewReceipt'])->name('admin-viewReceipt');

//Manage Customers
Route::get('/admin-manageCustomers',[UserController::class,'viewAllCustomers'])->name('admin-manageCustomers');
Route::get('/admin-viewCustomer/{id}',[UserController::class,'viewCustomerProfile'])->name('admin-viewCustomer');

Route::get('/admin-viewCustomer/blockCustomer/{id}',[UserController::class,'blockUser'])->name('admin-blockCustomer'); //block a customer account
Route::get('/admin-viewCustomer/unblockCustomer/{id}',[UserController::class,'unblockUser'])->name('admin-unblockCustomer'); //unblock a customer account

//Manage Sales Report
Route::get('/admin-salesReport',[OrderController::class,'viewSalesReport'])->name('admin-viewSalesReport');


//CUSTOMER AND ADMIN SIDE....
Route::get('/searchmenu', [ProductController::class,'searchProduct'])->name('searchmenu');
Route::get('/searchorder', [OrderController::class,'searchOrder'])->name('searchorder');
Route::get('/searchcustomers', [UserController::class,'searchCustomer'])->name('searchcustomers');


//MANAGE FAQs
Route::get('/admin-managefaq',function(){
    return view('admin/admin-manageFAQ');
})->name('admin-manageFAQ');
