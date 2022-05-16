<?php

use App\Http\Controllers\Admin\ClientManagementController as AdminClientManagement;
use App\Http\Controllers\Admin\UserManagementController;

use App\Http\Controllers\Client\ManageStore;
use App\Http\Controllers\Client\ManageService;
use App\Http\Controllers\Client\ManageInventory;

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

//Route::get('/usermanagement', [AdminUserManagement::class, 'index'])->name('admin.usermanagement.index');
