<?php

use App\Models\User;
use App\Models\Reminder;
use App\Services\FCMService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PledgeReminder;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\PledgeController;
use App\Http\Controllers\Admin\JumuiyaController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PurposeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Member\MyCardController;
use App\Http\Controllers\Admin\CardPaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/notification', function (Request $request) {
    FCMService::send(
        $request->user()->fcm_token,
        [
            'title' => 'UJENZI WA KANISA',
            'body' => 'reminder to complete pledge goal.',
        ]
    );
 return response()->json(['success' => "Notification Sent"], 200);
});


Route::middleware('auth:sanctum')->post('/user/update', function (Request $request) {
    $user = $request->user();
    $user->update($request->all());
    return $user;
});

Route::middleware('auth:sanctum')->post('/change-password', function (Request $request) {
    $request->validate([
        'oldPassword' => 'required',
        'newPassword' => 'required',
    ]);
    


    if(!Hash::check($request->oldPassword, $request->user()->password)){
       return response()->json(['error' => "Old Password Doesn't match!"], 500);
    }

    User::whereId($request->user()->id)->update([
        'password' => Hash::make($request->newPassword)
    ]);

    return response()->json(['status' => "Password changed successfully!"], 200);
});


Route::post('token', [AuthController::class, 'requestToken']);


//USER ROUTES


Route::post('/register', [RegisterController::class, 'apistore']);

//CARD PAYMENTS
Route::middleware('auth:sanctum')->get('/cardpayments', [CardPaymentController::class, 'index']);


//JUMUIYA ROUTES

Route::get('/jumuiya', [JumuiyaController::class, 'index']);
Route::middleware('auth:sanctum')->get('/jumuiya/{id}', [JumuiyaController::class, 'show']);
Route::middleware('auth:sanctum')->post('/jumuiya', [JumuiyaController::class, 'store']);
Route::middleware('auth:sanctum')->patch('/jumuiya/{id}', [JumuiyaController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/jumuiya/{id}', [JumuiyaController::class, 'destroy']);

//ROLE ROUTES
// Route::get('/role', [RoleController::class, 'index']);
// Route::get('/role/{id}', [JumuiyaCRoleControllerontroller::class, 'show']);
// Route::post('/role', [RoleController::class, 'store']);
// Route::patch('/role/{id}', [RoleController::class, 'update']);
// Route::delete('/role/{id}', [RoleController::class, 'destroy']);

//PLEDGE ROUTES
Route::middleware('auth:sanctum')->get('/pledge', [PledgeController::class, 'index']);
Route::middleware('auth:sanctum')->get('/pledge/user', [PledgeController::class, 'users']);
Route::middleware('auth:sanctum')->get('/pledge/{id}', [PledgeController::class, 'show']);
Route::middleware('auth:sanctum')->post('/pledge', [PledgeController::class, 'apistore']);
Route::middleware('auth:sanctum')->patch('/pledge/{id}', [PledgeController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/pledge/{id}', [PledgeController::class, 'destroy']);
Route::middleware('auth:sanctum')->post('/pledge/reminder', [PledgeController::class, 'reminder']);


//PLEDGETYPE ROUTES

Route::middleware('auth:sanctum')->get('/pledgetype', [TypeController::class, 'index']);
Route::middleware('auth:sanctum')->get('/pledgetype/{id}', [TypeController::class, 'show']);
Route::middleware('auth:sanctum')->post('/pledgetype', [TypeController::class, 'store']);
Route::middleware('auth:sanctum')->patch('/pledgetype/{id}', [TypeController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/pledgetype/{id}', [TypeController::class, 'destroy']);

//Pledge Purposes
Route::middleware('auth:sanctum')->get('/pledgepurposes', [PurposeController::class, 'index']);



//PAYMENT METHODS ROUTES
// Route::get('/paymentmethod', [PaymentMethodController::class, 'index']);
// Route::get('/paymentmethod/{id}', [PaymentMethodController::class, 'show']);
// Route::post('/paymentmethod', [PaymentMethodController::class, 'store']);
// Route::patch('/paymentmethod/{id}', [PaymentMethodController::class, 'update']);
// Route::delete('/paymentmethod/{id}', [PaymentMethodController::class, 'destroy']);

//PAYMENT ROUTES
// Route::get('/payment', [PaymentController::class, 'index']);
Route::middleware('auth:sanctum')->get('/payment/user', [PaymentController::class, 'users']);
// Route::get('/payment/pledge/{id}', [PaymentController::class, 'pledge']);
// Route::get('/payment/{id}', [PaymentController::class, 'show']);
Route::middleware('auth:sanctum')->post('/payment', [PaymentController::class, 'apistore']);

//CARD ROUTES
Route::middleware('auth:sanctum')->get('/request-card', [MyCardController::class,'apistore']);  

// Route::get('/card', [JumuiyaController::class, 'index']);
// Route::get('/card/{id}', [JumuiyaController::class, 'show']);
// Route::post('/card', [JumuiyaController::class, 'store']);
// Route::patch('/card/{id}', [JumuiyaController::class, 'update']);
// Route::delete('/card/{id}', [JumuiyaController::class, 'destroy']);