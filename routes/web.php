<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MethodController;
use App\Http\Controllers\Admin\PledgeController;
use App\Http\Controllers\Admin\JumuiyaController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PurposeController;
use App\Http\Controllers\Member\MyCardController;
use App\Http\Controllers\Select2SearchController;
use App\Http\Controllers\Member\MethodsController;
use App\Http\Controllers\Member\MyPledgeController;
use App\Http\Controllers\Admin\CardMemberController;
use App\Http\Controllers\Admin\CardPaymentController;
use App\Http\Controllers\Member\MyPaymentsController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Member\MyNotificationsController;



Auth::routes();
// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', function () {
   return view('welcome');
});


// Start of all admin user routes

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function()
{
 // admin dashboard route
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class,'index']);
 //  View All Members route
    Route::get('/all-members', function () {
      return view('admin.members.index');
      });
// Members API route
    Route::apiResource('members', MemberController::class);

// Jumuiya Auto search route
    Route::get('autocomplete', [MemberController::class,'selectSearch'])->name('autocomplete');;
    // Route::get('autocomplete', [SearchController::class, 'autocomplete'])

// view single member route
    Route::get('view-member/{id}', [App\Http\Controllers\Admin\MemberController::class, 'show'])->name('users.show');

 // view all communities route
    // Route::get('/all-communities', [App\Http\Controllers\Admin\JumuiyaController::class,'index']);
    Route::get('/all-communities', function () {
      return view('admin.jumuiya.index');
      });

  // Community API route
  Route::apiResource('communities', JumuiyaController::class);
// view single Community route
   Route::get('view-community/{id}', [App\Http\Controllers\Admin\JumuiyaController::class, 'show'])->name('community.show');

 // all pledges route
  //  Route::get('/all-pledges', [App\Http\Controllers\Admin\PledgeController::class,'index']);
  Route::get('/all-pledges', function () { return view('admin.pledges.index'); });

  // Pledges API route
  Route::apiResource('pledges', PledgeController::class);
   // Pledge Types API route
  Route::apiResource('types', TypeController::class);
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
 // Delete Pledge method route  
    Route::get('delete-pledge/{id}', [App\Http\Controllers\Admin\PledgeController::class,'destroy']);
   // view all purposes route
    Route::get('/all-purposes', function () {
      return view('admin.purposes.index');
      });
  
  // Purposes API route
  Route::apiResource('purposes', PurposeController::class);
 //Create Purpose route  
   Route::post('add-purpose', [App\Http\Controllers\Admin\PurposeController::class,'save']);
 // Delete Purpose method route  
    Route::get('delete-purpose/{id}', [App\Http\Controllers\Admin\PurposeController::class,'destroy']);
    Route::get('edit-purpose/{id}', [App\Http\Controllers\Admin\PurposeController::class,'edit']);
 //Update Purpose route  
    Route::put('edit-purpose/{id}', [App\Http\Controllers\Admin\PurposeController::class,'update']);

// all payments route
  //  Route::get('/all-payments', [App\Http\Controllers\Admin\PaymentController::class,'index']);
  Route::get('/all-payments', function () {
    return view('admin.payments.index');
    });
  // Payments API route
  Route::apiResource('payments', PaymentController::class);
  // Payment Methods API route
  Route::apiResource('methods', MethodController::class);
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
  // Route::get('/all-cards', [App\Http\Controllers\Admin\CardController::class,'index']);
  Route::get('/all-cards', function () {
    return view('admin.cards.index');
    });
  // Cards API route
  Route::apiResource('cards', CardController::class);
  // CardMember API route
  Route::apiResource('card-member', CardMemberController::class);
    // CardPayment API route
  Route::apiResource('card-payments', CardPaymentController::class);

//Create Card method route  
  Route::post('add-card', [App\Http\Controllers\Admin\CardController::class,'save']);
//Edit Card Method page route  
  Route::get('edit-card/{card_id}', [App\Http\Controllers\Admin\CardController::class,'edit']);
//Update Card Method route  
  Route::put('edit-card/{card_id}', [App\Http\Controllers\Admin\CardController::class,'update']);
//Delete Card method Route  
  Route::get('delete-card/{card_id}', [App\Http\Controllers\Admin\CardController::class,'destroy']);



// All reports page route
  Route::get('/all-reports', function () {
  return view('admin.reports.index');
  });
// Registered Members Reports
  Route::get('registered-members', [App\Http\Controllers\PDFViewController::class, 'displayReport']);
// Collected Payments Reports
  Route::get('collected-payments', [App\Http\Controllers\PDFViewController::class, 'paymentReport']);
  // Collected Payments Reports
  Route::get('pledges-purposes', [App\Http\Controllers\PDFViewController::class, 'pledgesReport']);
  // Cards Payments Report 
  Route::get('card-payments', [App\Http\Controllers\PDFViewController::class, 'cardPaymentReport']);
  // Member Pledges Report
  Route::get('member-pledges', [App\Http\Controllers\PDFViewController::class, 'memberPledgesReport']);

// settings page route
Route::get('/settings', function () {
  return view('admin.settings');
  });

 // my-profile
  Route::get('/my-profile', function () {
    return view('admin.profile.index');
    });

  //User Notifications 
  Route::get('user-notifications', function () {
    return view('admin.notifications.index');
  });

  // my-notifications API
   Route::apiResource('notifications', NotificationsController::class);

// my-profile API
  Route::apiResource('profile', ProfileController::class);

  // update profile image
  Route::post('profile-image',[App\Http\Controllers\Admin\ProfileController::class, 'updateImg']);


  Route::get('/getEmployees/{id}',  [App\Http\Controllers\Admin\PaymentController::class, 'getEmployees']);


  Route::get('ajax-autocomplete-search', [Select2SearchController::class,'selectSearch']);


});

// for Member
Route::prefix('member')->middleware(['auth','isMember'])->group(function()
{
 // setting dashboard route
    Route::get('/dashboard', [App\Http\Controllers\Member\DashboardController::class,'index']);

 // my-pledges route
    // Route::get('/my-pledges', [App\Http\Controllers\Member\PledgeController::class,'index']);
    Route::get('/my-pledges', function () {
      return view('member.pledges.index');
      });
// my-pledges API
    Route::apiResource('pledges', MyPledgeController::class);

  //Create Pledge Route
  Route::post('save-pledge', [App\Http\Controllers\Member\PledgeController::class,'save']);

 // my-payments
//  Route::get('/my-payments', [App\Http\Controllers\Member\PaymentController::class,'index']);
  Route::get('/my-payments', function () {
  return view('member.payments.index');
  });
// my-pledges API
  Route::apiResource('payments', MyPaymentsController::class);
  // Payment Methods API route
  Route::apiResource('methods', MethodsController::class);
  // my-cards
  // Route::get('/my-cards', [App\Http\Controllers\Member\CardController::class,'index']);
  
    Route::get('my-cards', function () {
    return view('member.cards.index');
    });
  // my-cards API
    Route::apiResource('cards', MyCardController::class);

  //Create Card method route  
   Route::post('request-card', [App\Http\Controllers\Member\MyCardController::class,'store']);  
      
    Route::get('my-notifications', function () {
      return view('member.notifications.index');
      });
  // my-notifications API
    Route::apiResource('notifications', MyNotificationsController::class);

 // All reports page route
    Route::get('my-reports', function () {
     return view('member.reports.index');
    });
  // Pledges Made  Reports
    Route::get('pledges-report', [App\Http\Controllers\Member\MyReportController::class,'pledgesReport']);
  // Pledges Payment  Reports
    Route::get('pledges-payment-report', [App\Http\Controllers\Member\MyReportController::class,'paymentReport']);
  // Pledges Payment  Reports
    Route::get('cards-payment-report', [App\Http\Controllers\Member\MyReportController::class,'cardReport']);
    // Pledges Payment  Reports
    Route::get('contributions-report', [App\Http\Controllers\Member\MyReportController::class,'purposeReport']);
  // For my settings
  // settings page route
    Route::get('/settings', function () {
      return view('member.settings');
      });

  // member change password route
    Route::post('change-password', [App\Http\Controllers\Member\ProfileController::class,'store']);
  // my-profile
    Route::get('/my-profile', [App\Http\Controllers\Member\ProfileController::class,'index']);
});
