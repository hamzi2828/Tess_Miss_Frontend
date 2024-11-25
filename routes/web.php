<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\MerchantCategoriesController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MerchantsController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckUserStage;

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

    return view('pages.dashboard.index');
})->middleware('auth');


// Login and Logout routes (these should be outside the auth middleware)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {


    Route::resource('users', UserController::class);
    Route::get('/usersEdit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/usersCreate', [UserController::class, 'create'])->name('users.create');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/activity-logs', [UserController::class, 'activityLogs'])->name('activity.logs');
    Route::get('/activity-my_logs', [UserController::class, 'activityMyLogs'])->name('activity.my_logs');

    Route::get('/notifications/read/{id}', [UserController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/mark-all', [UserController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications/latest', [UserController::class, 'getLatestNotifications'])->name('notifications.latest');




    // Departments, Documents, Services
    Route::resource('departments', DepartmentController::class);
    Route::resource('documents', DocumentsController::class);
    route::get('/alldocuments',[DocumentsController::class, 'index'] )->name('alldocuments.index');

    Route::resource('services', ServicesController::class);

    // Merchant Categories, Countries, Merchants
    Route::resource('merchant-categories', MerchantCategoriesController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('merchants', MerchantsController::class);
    // Add a new route for preview functionality for merchants
    Route::get('/merchantsPreview}', [MerchantsController::class, 'preview'])->name('merchants.preview');
    Route::post('/merchants/{id}/approve', [MerchantsController::class, 'approve_merchants'])->name('merchants.approve');
    Route::post('/merchants/{id}/decline', [MerchantsController::class, 'decline_merchants'])->name('merchants.decline');


});


    // Merchant-specific KYC, Documents, Sales, Services

    Route::middleware(['auth', 'checkStage:1'])->group(function () {
        Route::get('/merchantskyc', [MerchantsController::class, 'create_merchants_kfc'])->name('create.merchants.kfc');
        Route::post('/store/merchantskyc', [MerchantsController::class, 'store_merchants_kyc'])->name('store.merchants.kyc');
        Route::get('/editMechnatKyc', [MerchantsController::class, 'edit_merchants_kyc'])->name('edit.merchants.kyc');
        Route::post('/updateMerchantsKyc', [MerchantsController::class, 'update_merchants_kyc'])->name('update.merchants.kyc');
        route::get('/approveKyc',[ MerchantsController::class, 'approveKYC'])->name('approve.merchants.kyc');
        Route::get('/merchants/decline/kyc', [MerchantsController::class, 'declineKYC'])->name('decline.merchants.kyc');
    });

    Route::middleware(['auth', 'checkStage:2'])->group(function () {
        Route::get('/createMerchantsDocuments', [MerchantsController::class, 'create_merchants_documents'])->name('create.merchants.documents');
        Route::post('/storeMerchantsDocuments', [MerchantsController::class, 'store_merchants_documents'])->name('store.merchants.documents');
        Route::get('/editMechnatDocuments', [MerchantsController::class, 'edit_merchants_documents'])->name('edit.merchants.documents');
        Route::post('/updateMerchantsDocuments', [MerchantsController::class, 'update_merchants_documents'])->name('update.merchants.documents');
        Route::get('/approveMerchantsDocuments', [MerchantsController::class, 'approve_merchants_documents'])->name('approve.merchants.documents');
        Route::get('/merchants/decline/documents', [MerchantsController::class, 'decline_merchants_documents'])->name('decline.merchants.documents');
    });

    Route::middleware(['auth', 'checkStage:3'])->group(function () {
        Route::get('/CreateMerchantsSales', [MerchantsController::class, 'create_merchants_sales'])->name('create.merchants.sales');
        Route::post('/store/merchantsSales', [MerchantsController::class, 'store_merchants_sales'])->name('store.merchants.sales');
        Route::get('/editMechnatSales', [MerchantsController::class, 'edit_merchants_sales'])->name('edit.merchants.sales');
        Route::post('/updateMerchantsSales', [MerchantsController::class, 'update_merchants_sales'])->name('update.merchants.sales');
        Route::get('/approveMerchantsSales', [MerchantsController::class, 'approve_merchants_sales'])->name('approve.merchants.sales');
        Route::get('/merchants/decline/sales', [MerchantsController::class, 'decline_merchants_sales'])->name('decline.merchants.sales');
    });
    Route::middleware(['auth', 'checkStage:4'])->group(function () {
        Route::get('/CreateMerchantService', [MerchantsController::class, 'create_merchants_services'])->name('create.merchants.services');
        Route::post('/storeMerchantService', [MerchantsController::class, 'store_merchants_services'])->name('store.merchants.services');
        Route::get('/editMerchantService', [MerchantsController::class, 'edit_merchants_services'])->name('edit.merchants.services');
        Route::post('/updateMerchantService', [MerchantsController::class, 'update_merchants_services'])->name('update.merchants.services');
        Route::get('/approveMerchantService',[ MerchantsController::class, 'approve_merchants_services'])->name('approve.merchants.services');
        Route::get('/merchants/decline/services', [MerchantsController::class, 'decline_merchants_services'])->name('decline.merchants.services');

    });

