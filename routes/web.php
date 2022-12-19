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

 // view all communities route
   Route::get('/all-communities', [App\Http\Controllers\Admin\JumuiyaController::class,'index']);
 //Create Commmunity route  
    Route::post('add-community', [App\Http\Controllers\Admin\JumuiyaController::class,'save']);
 //Edit Commmunity page route  
    Route::get('edit-community/{jumuiya_id}', [App\Http\Controllers\Admin\JumuiyaController::class,'edit']);
 //Update Commmunity route  
   Route::put('edit-community/{jumuiya_id}', [App\Http\Controllers\Admin\JumuiyaController::class,'update']);
 // delete community route
   Route::get('delete-community/{jumuiya_id}', [App\Http\Controllers\Admin\JumuiyaController::class,'destroy']);

 // all pledges route
   Route::get('/all-pledges', [App\Http\Controllers\Admin\PledgeController::class,'index']);
 //Create Pledge type route  
   Route::post('add-type', [App\Http\Controllers\Admin\PledgeController::class,'saveType']);
 //Edit Pledge type page route  
   Route::get('edit-type/{type_id}', [App\Http\Controllers\Admin\PledgeController::class,'editType']);

 //Update Commmunity route  
   Route::put('edit-type/{type_id}', [App\Http\Controllers\Admin\PledgeController::class,'updateType']);

});
// for Member
Route::prefix('member')->middleware(['auth','isMember'])->group(function()
{
 // setting dashboard route
    Route::get('/dashboard', [App\Http\Controllers\Member\DashboardController::class,'index']);
});
