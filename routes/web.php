<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CakeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactusmessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\MasterChefController;
Route::get('/login', function (){
    return view("auth.login");
});


Route::get('/', [IndexController::class, 'index'])->name('frontend.index');
Route::get('/master-chefs', [IndexController::class, 'masterChefs'])->name('frontend.index');

Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware("auth");

// Backend Routes
Route::prefix('backend')->name('backend.')->group(function(){
    Route::resource('category', CategoryController::class);
    Route::resource('cake', CakeController::class);

    // CakeController specific routes
    Route::post('/cake-item/store', [CakeController::class, 'store'])->name('cake.store');
    Route::get('/cake', [CakeController::class, 'index'])->name('cake.index');
    Route::delete('/cake/{id}', [CakeController::class, 'destroy'])->name('cake.destroy');
    Route::get('/cake/{id}/edit', [CakeController::class, 'edit'])->name('cake.edit');
    Route::put('/cake/{id}', [CakeController::class, 'update'])->name('cake.update');

    Route::get('/contact-us-messages', [ContactusmessageController::class, 'index'])->name('contactusmessage.index');

    Route::delete('/contact-us-messages/{id}', [ContactusmessageController::class, 'destroy'])->name('contactusmessage.destroy');
    
    // Backend Routes of master chefs
    Route::post('/masterchefs/store', [MasterChefController::class, 'store'])->name('masterchefs.store');

    Route::get('/masterchefs', [MasterChefController::class, 'index'])->name('masterchefs.index');
    Route::delete('/masterchefs/{id}', [MasterChefController::class, 'destroy'])->name('masterchefs.destroy');
    Route::get('/masterchefs/{id}/edit', [MasterChefController::class, 'edit'])->name('masterchefs.edit');
    Route::put('/masterchefs/{id}', [MasterChefController::class, 'update'])->name('masterchefs.update');
    
  
});
// Contact Us Messages Routes
Route::post('/contact-us', [ContactusmessageController::class, 'store'])->name('contactus.store');
Route::get('/logout', [LoginController::class, 'userLogout'])->name('auth.logout');



