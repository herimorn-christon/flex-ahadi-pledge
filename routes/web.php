<?php

use App\Http\Controllers\addAnnouncementController;
use App\Http\Controllers\Member\adminProfilesStores;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CardRequest;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\PaymentRequest;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\EventController;
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
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\MyProbemsController;
use App\Http\Controllers\Admin\CardPaymentController;
use App\Http\Controllers\Member\MyPaymentsController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\adminAddDependantController;
use App\Http\Controllers\AdminDependancyController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\companySettingController;
use App\Http\Controllers\editUserProfile;
use App\Http\Controllers\Member\MyAnnouncementController;
use App\Http\Controllers\Member\MyNotificationsController;
use App\Http\Controllers\Member\SuccessProfile;
use App\Http\Controllers\memberDependantController;
use App\Http\Controllers\PDFViewController;
use App\Http\Controllers\reportProblemController;
use App\Http\Controllers\spiritualController;
use App\Http\Controllers\userGuideController;

Auth::routes();
// Home route
//Route::get('/home', [App\Http\Controllers

Route::post('add-remove-multiple-input-fields',  [App\Http\Controllers\Admin\TodoController::class, 'store']);


Route::get('/', function () {
   return view('auth.login');
});


Route::get('/jumuiya/search', [JumuiyaController::class, 'search']);

Route::get('/member/search', [MemberController::class, 'search']);

Route::get('/purpose/search', [PurposeController::class, 'search']);

Route::get('/pledge-types/search', [TypeController::class, 'search']);


Route::get('/pledges/search', [PledgeController::class, 'search']);

Route::get('/methods/search', [MethodController::class, 'search']);

// Start of all admin user routes

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function()
{
 // admin dashboard route
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class,'index']);
 //  View All Members route
    Route::get('/all-members', function () {
      return view('admin.members.index');
      });
    //Manage Members API route
    Route::apiResource('members', MemberController::class);

    // Jumuiya Auto search route
    Route::get('autocomplete', [MemberController::class,'selectSearch'])->name('autocomplete');;
    // Route::get('autocomplete', [SearchController::class, 'autocomplete'])

// view single member route
    Route::get('view-member/{id}', [App\Http\Controllers\Admin\MemberController::class, 'show'])->name('users.show');

 // view all communities route
    Route::get('/all-communities', function () {
      return view('admin.jumuiya.index');
      });

  // Community API route
  Route::apiResource('communities', JumuiyaController::class);
// view single Community route
   Route::get('view-community/{id}', [App\Http\Controllers\Admin\JumuiyaController::class, 'show'])->name('community.show');

// all pledges route (Manage Pledges)
  Route::get('/all-pledges', function () { return view('admin.pledges.index'); });

// Manage purposes route
  Route::get('/all-purposes', function () {
    return view('admin.purposes.index');
    });

//Manage Purposes API route
  Route::apiResource('purposes', PurposeController::class);




  //Manage Pledges API route
  Route::apiResource('pledges', PledgeController::class);
   // Pledge Pledge Types API route
  Route::apiResource('types', TypeController::class);



// all payments route
  Route::get('/all-payments', function () {
    return view('admin.payments.index');
    });
  // Payments API route
  Route::apiResource('payments', PaymentController::class);
  // Payments requests API
  Route::apiResource('prequests', PaymentRequest::class);
  // Payment Methods API route
  Route::apiResource('methods', MethodController::class);


// all cards route
  Route::get('/all-cards', function () {
    return view('admin.cards.index');
    });
  // Cards API route
  Route::apiResource('cards', CardController::class);
  // CardMember API route
  Route::apiResource('card-member', CardMemberController::class);
    // CardPayment API route
  Route::apiResource('card-payments', CardPaymentController::class);
  // Cards Requests API route
  Route::apiResource('crequests', CardRequest::class);


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
// Route::get('/settings', function () {
//   return view('admin.settings');
//   });


  // all settings route
  Route::get('settings', [App\Http\Controllers\Admin\SettingController::class,'index']);
  // saving settings using post method
  Route::post('settings', [App\Http\Controllers\Admin\SettingController::class,'save']);


// all announcements route
  Route::get('/all-announcements', function () {
    return view('admin.announcements.index');
    });

// Payments API route
  Route::apiResource('announcements', AnnouncementController::class);


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

  // admin change password route
  Route::post('change-password', [App\Http\Controllers\Admin\ProfileController::class,'store']);

// my-profile API
  Route::apiResource('profile', ProfileController::class);

  // update profile image
  Route::post('profile-image',[App\Http\Controllers\Admin\ProfileController::class, 'updateImg']);


  Route::get('/getEmployees/{id}',  [App\Http\Controllers\Admin\PaymentController::class, 'getEmployees']);

  Route::get('ajax-autocomplete-search', [Select2SearchController::class,'selectSearch']);

  // all supports route
  Route::get('support', function () {
    return view('admin.support.index');
    });
});





// for Member Routes
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


 // my-payments

  Route::get('/my-payments', function () {
  return view('member.payments.index');
  });
// my-pledges API
  Route::apiResource('payments', MyPaymentsController::class);
  // Payment Methods API route
  Route::apiResource('methods', MethodsController::class);
  // my-cards
 
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

  //For announcements 

  Route::get('my-announcements', function () {
    return view('member.announcements.index');
    });
// my-notifications API
  Route::apiResource('announcements', MyAnnouncementController::class);

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
  //Report problem route
  Route::get('/support', function () {
    return view('member.support.index');
    });
  // my-problems API
  Route::apiResource('problems', MyProbemsController::class);
    
  // member change password route
    Route::post('change-password', [App\Http\Controllers\Member\ProfileController::class,'store']);
  // my-profile
    Route::get('/my-profile', [App\Http\Controllers\Member\ProfileController::class,'index'])->name('myprofile');
    // for event remainder

//Manage Purposes API route
Route::apiResource('purposes', PurposeController::class);

 
});
Route::put("admin/addAnouncement",[addAnnouncementController::class,'addAnouncement'])->name('myanouncement');
Route::get("member/spiritual/",[spiritualController::class,'index']);
Route::put("member/spiritual/{id}",[spiritualController::class,'update'])->name("spiritual.update");
//Route::get("/humuiya",[RegisterController::class,'viewJumuiya']);
//lets work on how to edit the profile of the user
Route::put('member/depandant/update/{id}',[memberDependantController::class,'update'])->name('member_dependant_update');
Route::post('member/dependant/weka',[memberDependantController::class,'weka'])->name('member_dependant.weka');
Route::get('member/my-profile/edit/{id}',[editUserProfile::class,'index']);
Route::put('member/my-profile/update/{id}',[editUserProfile::class,'updateProfile'])->name("member_profile.update");
route::get('member/depandant/',[memberDependantController::class,'index'])->name('member_dependant.show');
route::get('member/depandant/edit/{id}',[memberDependantController::class,'edit'])->name('member_dependant.edit');
route::post('member/depandant/destroy/{id}',[memberDependantController::class,'destroy'])->name('member_dependant.destroy');
Route::get('member/dependant/trash',[memberDependantController::class,'trash'])->name('trash');
Route::get('member/dependant/{id}/restore',[memberDependantController::class,'restore'])->name('member.restore');
//specifying the route for completely delete values from the database
Route::delete("member/{id}/force-delete",[memberDependantController::class,'forceDelete'])->name("member.force-delete");
//Route::post('member/depandant/store/{id}',[memberDependantController::class,'store'])->name('member_dependant.store');

//handling the admin controller to view all the dependancy
Route::get("admin/dependants",[AdminDependancyController::class,'index']);
Route::get("admin/dependants/{id}",[AdminDependancyController::class,'show'])->name("show_dependant");

//the route for exporting the data to pdf
Route::get("admin/download_purpouse",[PurposeController::class,'MemberpdfExport'])->name("memberPdf");
//route for pdf export for admin
Route::get("admin/download_communiy",[PDFViewController::class,'purpousePdf'])->name("purpousePdf");
Route::get("admin/download_communiy1",[PDFViewController::class,'communityPdf'])->name("communityPdf");

//the report plinting to show all pledge
Route::get("admin/show_pledge_report",[PDFViewController::class,'pledgesReport'])->name("pledgeReport");



//Route for generating pdf on the members sides
Route::get("member/show_my_plidge",[PDFViewController::class,'memberPleadgeReport'])->name('memberPleadgeReport');

//the user guide implimentation using laravel
Route::get("member/user-manual",[userGuideController::class,'index'])->name('download-manual');
Route::get("member/user-manual/download",[userGuideController::class,'downloadLogic'])->name('downloadLogic');


//the implimentation of reporting the problem logic
Route::post("member/report-problem",[reportProblemController::class,'InterProblems']);
Route::delete("member/delete-problem/{id}",[reportProblemController::class,'deleteProblem'])->name('delete-problem');

Route::get("admin/company_settings",[companySettingController::class,'index'])->name('company_settings');
//handling the post methods to store the data into database
Route::post("admin/company_settings",[companySettingController::class,'store'])->name('admin_store.company_setting');
Route::put("admin/company_settings/{id}",[companySettingController::class,'update'])->name('admin_update_companySettings');

//generating route for showing the report of users
Route::get("admin/show_all_report",[PDFViewController::class,"admin_user_report"])->name("admin_user_report");

//handles the post request to submit to the data base
Route::post("admin/all-members",[adminAddDependantController::class,'store'])->name("adminAddDependant.store");


//generate the reports for the payments
Route::get("admin/member/myPayment",[PDFViewController::class,'view_payment'])->name("view_payment");
//generate the reports for the cards payments
Route::get("admin/member/my-cards",[PDFViewController::class,'showCards'])->name("show_cards");
Route::POST("admin/my-members/member",[MemberController::class,'storeValue'])->name("store_value");

//handles the 
Route::get("admin/pledge_report",[PDFViewController::class,'myadmin_pledge'])->name('myadmin_pledge');
Route::get("admin/payment_report",[PDFViewController::class,'myadmin_payment'])->name("myadmin_payment");
Route::get("admin/card_report",[PDFViewController::class,'myadmin_card'])->name("myadmin_card");

Route::post("member/ProfileStores",[SuccessProfile::class,'adminProfilesStores'])->name("admin.profile.stores");
