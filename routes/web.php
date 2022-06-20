<?php

use App\Http\Controllers\Admin\ClientManagementController as AdminClientManagement;
use App\Http\Controllers\Admin\UserManagementController;

use App\Http\Controllers\Client\ManageStore;
use App\Http\Controllers\Client\ManageService;
use App\Http\Controllers\Client\ManageInventory;
use App\Http\Controllers\Client\ManageOrder;
use App\Http\Controllers\Client\ManageMachine;
use App\Http\Controllers\Client\ManageSales;
use App\Http\Controllers\Client\ManageRiders;
use App\Http\Controllers\Customer\CustomerOrdering;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/clientmanagement', [AdminClientManagement::class, 'index'])->name('admin.clientmanagement.index');
Route::get('/clientmanagement/{id}', [AdminClientManagement::class, 'show'])->name('admin.clientmanagement.show');
Route::post('/clientmanagement/{id}/accept', [AdminClientManagement::class, 'accept'])->name('admin.clientmanagement.accept');
Route::post('/clientmanagement/{id}/decline', [AdminClientManagement::class, 'decline'])->name('admin.clientmanagement.decline');

Route::get('/managestore', [ManageStore::class, 'index'])->name('client.managestore');
Route::post('/storelaundry', [ManageStore::class, 'store'])->name('client.storelaundry');

Route::get('/manageservices', [ManageService::class, 'index'])->name('client.manageservices');
Route::get('/addservtable', [ManageService::class, 'addServTable'])->name('client.addservice.table'); //used just for retrieving data on datatables
Route::get('/addprodtable', [ManageService::class, 'addProdTable'])->name('client.addproduct.table'); //used just for retrieving data on datatables
Route::post('/addservice', [ManageService::class, 'addService'])->name('client.addservice');
Route::post('/addadditionalservice', [ManageService::class, 'addAdditionalService'])->name('client.addadditionalservice');
Route::post('/addadditionalproduct', [ManageService::class, 'addAdditionalProduct'])->name('client.addadditionalproduct');

Route::get('/manageinventory', [ManageInventory::class, 'index'])->name('client.manageinventory');
Route::post('/additem', [ManageInventory::class, 'addItem'])->name('client.addinventory');
Route::post('/confirmquantity', [ManageInventory::class, 'confirmQuantity']);
Route::post('/deleteitem', [ManageInventory::class, 'deleteItem'])->name('client.deleteinventory');

Route::get('/managemachine', [ManageMachine::class, 'index'])->name('client.managemachine');
Route::get('/managemachine/{id}', [ManageMachine::class, 'individualMachine'])->name('client.individualmachine');
Route::post('/addmachine', [ManageMachine::class, 'addMachine'])->name('client.addmachine');
Route::post('/editmachine', [ManageMachine::class, 'editMachine'])->name('client.editmachine');
Route::post('/deletemachine', [ManageMachine::class, 'deleteMachine'])->name('client.deletemachine');
Route::post('/addmachinemaintenance', [ManageMachine::class, 'addMaintenance'])->name('client.addmaintenance');

Route::get('/manageorder', [ManageOrder::class, 'index'])->name('client.manageorder');
Route::get('/manageorder/{id}', [ManageOrder::class, 'individualLaundry'])->name('client.manageindividual');
Route::get('/manageorder/{id}/order', [ManageOrder::class, 'viewOrder'])->name('client.vieworder');
Route::post("/changemachinestate", [ManageOrder::class, 'updateMachineState'])->name('client.changemachinestate');
Route::post("/closemachinestate", [ManageOrder::class, 'closeMachineState'])->name('client.closemachinestate');
Route::post("/updatedrymachinetime", [ManageOrder::class, 'updateDryMachineTime'])->name('client.updatedrymachinetime');
Route::post('/submitorder', [ManageOrder::class, 'submitOrder'])->name('client.submitorder');
Route::post('/updatepaymentstatus', [ManageOrder::class, 'updatePaymentStatus']);
Route::post('/updatelaundrystatus', [ManageOrder::class, 'updateLaundryStatus']);
Route::post('/updateQueuedWashStatus', [ManageOrder::class, 'updateQueuedWashStatus']);

Route::get('/managesales', [ManageSales::class, 'index'])->name('client.managesales');

Route::get('/manageriders', [ManageRiders::class, 'index'])->name('client.manageriders');
Route::post('/addriders', [ManageRiders::class, 'addRiders'])->name('client.addrider');

Route::get('/sendnotification', [CustomerOrdering::class, 'sendNotification']);

//Route::get('/usermanagement', [AdminUserManagement::class, 'index'])->name('admin.usermanagement.index');
