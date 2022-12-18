<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Controller\DashboardController;



Auth::routes();
// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', function () {
   return view('welcome');
});


// for Admin

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function()
{
 // admin dashboard route
   Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class,'index']);
//  View All Members route
   Route::get('/all-members', [App\Http\Controllers\Admin\MemberController::class,'index']);

});
// for Member
Route::prefix('member')->middleware(['auth','isMember'])->group(function()
{
 // setting dashboard route
    Route::get('/dashboard', [App\Http\Controllers\Member\DashboardController::class,'index']);
});
