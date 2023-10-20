<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardRedirectController;
use App\Http\Controllers\Dashboard\RiderController;
use App\Http\Controllers\Dashboard\ShopController;
use App\Http\Controllers\GeneralController\SiteController;
use App\Http\Controllers\LoginVerify\LoginAccessController;
use App\Http\Controllers\LoginVerify\RegisterController;
use App\Http\Controllers\PageAuxController;
use App\Http\Controllers\PaymentGateway\StripeController;
use App\Http\Middleware\AuthVerifyAccess;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DashboardAccessVerify;
use App\Http\Middleware\LoginRedirection;
use App\Http\Middleware\StripTrxVerify;

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

Route::get('/',[SiteController::class,'Index'])->name('welcome');
Route::middleware([AuthVerifyAccess::class])->group(function(){
    Route::prefix('cart')->group(function(){
        Route::get('/', [SiteController::class, 'ViewCart'])->name('cart');
        Route::post('/remove', [SiteController::class, 'RemoveFromCart'])->name('remove.from_cart');
        Route::post('/payment', [SiteController::class, 'PostCartDetailsCheckout'])->name('post.cart_checkout');
        Route::get('/payment/gateway', [SiteController::class, 'OrderPaymentGateway'])->name('post.cart_payment_gateway');
        Route::middleware([StripTrxVerify::class])->group(function(){
            Route::get('/payment/gateway/card/stripe', [SiteController::class, 'StripePaymentView'])->name('payment_gateway.stripe');
            Route::post('/stripe/payment', [StripeController::class, 'MakePayment'])->name('procced_payment.stripe');
        });
    });
});
Route::prefix('search-list')->group(function(){
    Route::get('/',[SiteController::class,'SearchList'])->name('search.list');
    Route::prefix('details-shop')->group(function(){
        Route::get('/', [SiteController::class, 'SearchDetailsShop'])->name('search.shop_details');
        Route::get('/item/add', [SiteController::class, 'SearchDetailsItem'])->name('search.itemCart');
        Route::post('/item/add/cart', [SiteController::class, 'AddItemToCart'])->name('add.to_cart');
    });
});
Route::prefix('log')->group(function () {
    Route::middleware([LoginRedirection::class])->group(function(){
        Route::get('/in', [LoginAccessController::class, 'ViewLoginPage'])->name('log.in');
        Route::post('/in/verify', [LoginAccessController::class, 'VerifyUser'])->name('log.in_verify');
    });
    Route::get('/out', [LoginAccessController::class, 'Logout'])->name('log.out');
});

Route::prefix('aux-url')->group(function(){
    Route::get('choose-path',[SiteController::class,'ChooseRouteRegistration'])->name('route.choose');
    Route::get('choose-path-redirect-reg', [SiteController::class, 'ChooseRouteRegistrationRoute'])->name('route.redirect_reg');
});

Route::prefix('register')->group(function(){
    Route::prefix('shop')->group(function(){
        Route::get('/', [SiteController::class, 'ViewShopRegForm'])->name('register.shop');
        Route::post('register',[RegisterController::class,'SellerRegister'])->name('shop.register');
    });
    Route::prefix('client')->group(function () {
        Route::get('/', [SiteController::class, 'ViewClientRegForm'])->name('register.client');
        Route::post('register', [RegisterController::class, 'ClientRegister'])->name('client.register');
    });
    Route::prefix('rider')->group(function () {
        Route::get('/', [SiteController::class, 'ViewRiderRegForm'])->name('register.rider');
        Route::post('register', [RegisterController::class, 'RiderRegister'])->name('rider.register');
    });
});

Route::middleware([DashboardAccessVerify::class])->group(function(){
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardRedirectController::class, 'DashboardRender'])->name('dashboard');
        Route::prefix('pending-approval')->group(function(){
            Route::get('/', [DashboardRedirectController::class, 'ShopPendingApproval'])->name('get.pending_approval');
            Route::get('/update', [AdminController::class, 'UpdateShopPendingApproval'])->name('update.pending_approval');
        });
        Route::prefix('set-menu')->group(function(){
            Route::get('/', [DashboardRedirectController::class, 'SetMenue'])->name('set.menu');
            Route::post('/submit', [ShopController::class, 'StoreSetMenue'])->name('store.set_menu');
        });
        Route::prefix('shop')->group(function () {
            Route::get('/change-order/status', [ShopController::class, 'ChangeOrderStatusShop'])->name('change.order_status');
        });
        Route::prefix('rider')->group(function () {
            Route::get('/change-order/status', [RiderController::class, 'ChangeOrderStatusRider'])->name('rider_change.order_status');
            Route::get('/complete-order/status', [RiderController::class, 'CompleteOrderStatusRider'])->name('rider_complete.order_status');
        });
    });
});

Route::prefix('page/aux')->group(function () {
    Route::get('/search/suggestion', [PageAuxController::class, 'SearchSuggestion'])->name('search.suggestion');
    Route::get('/fetch-tracking-status', [PageAuxController::class, 'FetchTrackingStatus'])->name('fetch.trackinStatus');
});
