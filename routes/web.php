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

// view single member route
    Route::get('users/{id}', [App\Http\Controllers\Admin\MemberController::class, 'show'])->name('users.show');

 // view all communities route
    Route::get('/all-communities', [App\Http\Controllers\Admin\JumuiyaController::class,'index']);
 //Create Commmunity route  
    Route::post('add-community', [App\Http\Controllers\Admin\JumuiyaController::class,'save'])->name('communities.store');
 //Edit Commmunity page route  
    Route::get('edit-community/{jumuiya_id}', [App\Http\Controllers\Admin\JumuiyaController::class,'edit']);
 //Update Commmunity route  
   Route::put('edit-community/{jumuiya_id}', [App\Http\Controllers\Admin\JumuiyaController::class,'update']);
 // delete community route
   Route::get('delete-community/{jumuiya_id}', [App\Http\Controllers\Admin\JumuiyaController::class,'destroy']);
// view single Community route
   Route::get('community/{id}', [App\Http\Controllers\Admin\JumuiyaController::class, 'show'])->name('community.show');

 // all pledges route
   Route::get('/all-pledges', [App\Http\Controllers\Admin\PledgeController::class,'index']);
 //Create Pledge type route  
   Route::post('add-type', [App\Http\Controllers\Admin\PledgeController::class,'saveType']);
 //Edit Pledge type page route  
   Route::get('edit-type/{type_id}', [App\Http\Controllers\Admin\PledgeController::class,'editType']);
 //Update Pledge type route  
   Route::put('edit-type/{type_id}', [App\Http\Controllers\Admin\PledgeController::class,'updateType']);
 //Delete Pledge Type Route  
   Route::get('delete-type/{type_id}', [App\Http\Controllers\Admin\PledgeController::class,'destroyType']);
 //Create Pledge Route
   Route::post('save-pledge', [App\Http\Controllers\Admin\PledgeController::class,'save']);
// edit pledge page
   Route::get('edit-pledge/{type_id}', [App\Http\Controllers\Admin\PledgeController::class,'edit']);
 //Update Pledge type route  
   Route::put('edit-pledge/{type_id}', [App\Http\Controllers\Admin\PledgeController::class,'update']);
 //Create Purpose route  
   Route::post('add-purpose', [App\Http\Controllers\Admin\PurposeController::class,'save']);


// all payments route
   Route::get('/all-payments', [App\Http\Controllers\Admin\PaymentController::class,'index']);
 //Create Payment method route  
   Route::post('add-method', [App\Http\Controllers\Admin\PaymentController::class,'saveMethod']);
 //Edit Payment Method page route  
   Route::get('edit-method/{method_id}', [App\Http\Controllers\Admin\PaymentController::class,'editMethod']);
 //Update Payment Method route  
   Route::put('edit-method/{method_id}', [App\Http\Controllers\Admin\PaymentController::class,'updateMethod']);
 //Delete Payment method Route  
   Route::get('delete-method/{method_id}', [App\Http\Controllers\Admin\PaymentController::class,'destroyMethod']);
 //Create Payment Route
   Route::post('add-payment', [App\Http\Controllers\Admin\PaymentController::class,'save']);
 //Delete Payment method Route  
 Route::get('delete-payment/{method_id}', [App\Http\Controllers\Admin\PaymentController::class,'destroy']);

// all cards route
  Route::get('/all-cards', [App\Http\Controllers\Admin\CardController::class,'index']);
//Create Card method route  
  Route::post('add-card', [App\Http\Controllers\Admin\CardController::class,'save']);
//Edit Card Method page route  
  Route::get('edit-card/{card_id}', [App\Http\Controllers\Admin\CardController::class,'edit']);
//Update Card Method route  
  Route::put('edit-card/{card_id}', [App\Http\Controllers\Admin\CardController::class,'update']);
//Delete Card method Route  
  Route::get('delete-card/{card_id}', [App\Http\Controllers\Admin\CardController::class,'destroy']);
});
// for Member
Route::prefix('member')->middleware(['auth','isMember'])->group(function()
{
 // setting dashboard route
    Route::get('/dashboard', [App\Http\Controllers\Member\DashboardController::class,'index']);

 // my-pledges route
 Route::get('/my-pledges', [App\Http\Controllers\Member\PledgeController::class,'index']);

 // my-payments
 Route::get('/my-payments', [App\Http\Controllers\Member\PaymentController::class,'index']);
});
