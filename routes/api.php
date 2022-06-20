<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerRegisterController;
use App\Http\Controllers\Customer\LaundryController;
use App\Http\Controllers\Customer\CustomerOrdering;

use App\Http\Controllers\Client\OwnerMobile;

use App\Http\Controllers\Rider\RiderLogin;
use App\Http\Controllers\Rider\RiderMobile;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/registercustomer', [CustomerRegisterController::class, 'registerUser']);
Route::post('/logincustomer', [CustomerRegisterController::class, 'loginUser']);
Route::post('/editcustomerprofile', [CustomerRegisterController::class, 'editProfile']);

Route::get('/getlaundries', [LaundryController::class, 'getLaundries']);
Route::get('/getindividuallaundry/{id}', [LaundryController::class, 'getIndividualLaundry']);
Route::get('/getmainservices/{id}', [LaundryController::class, 'getMainServices']);
Route::get('/getadditionalservices/{id}', [LaundryController::class, 'getAdditionalServices']);
Route::get('/getadditionalproducts/{id}', [LaundryController::class, 'getAdditionalProducts']);
Route::get('/getallmachines/{id}', [LaundryController::class, 'getMachines']);

Route::post('/updatetoken', [CustomerOrdering::class, 'updateToken']);
Route::post('/ordermobile', [CustomerOrdering::class, 'orderMobile']);
Route::post('/ordereditems', [CustomerOrdering::class, 'orderedItems']);
Route::get('/showcustomerorder/{id}', [CustomerOrdering::class, 'showCustomerOrder']);
Route::post('/updatepaymentstatus', [CustomerOrdering::class, 'updatePaymentStatus']);

//Rider functions
Route::post('/riderlogin', [RiderLogin::class, 'loginRider']);
Route::post('/getlaundryorders', [RiderMobile::class, 'getLaundryOrders']);
Route::post('/getspecificorder', [RiderMobile::class, 'getSpecificOrder']);
Route::post('/acceptorder', [RiderMobile::class, 'acceptOrder']);

//Owner functions
Route::post('/ownerlogin', [OwnerMobile::class, 'login']);
