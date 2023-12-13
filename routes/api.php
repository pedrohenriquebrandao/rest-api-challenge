<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BatchController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProducerController;
use App\Http\Controllers\Api\SectorController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('admins', [AdminController::class, 'index']);
Route::post('admins', [AdminController::class, 'store']);
Route::get('admins/{admin}', [AdminController::class, 'show']);
Route::put('admins/{admin}', [AdminController::class, 'update']);
Route::delete('admins/{admin}', [AdminController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
*/

Route::get('clients', [ClientController::class, 'index']);
Route::post('clients', [ClientController::class, 'store']);
Route::get('clients/{client}', [ClientController::class, 'show']);
Route::put('clients/{client}', [ClientController::class, 'update']);
Route::delete('clients/{client}', [ClientController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Producer Routes
|--------------------------------------------------------------------------
*/

Route::get('producers', [ProducerController::class, 'index']);
Route::post('producers', [ProducerController::class, 'store']);
Route::get('producers/{producer}', [ProducerController::class, 'show']);
Route::put('producers/{producer}', [ProducerController::class, 'update']);
Route::delete('producers/{producer}', [ProducerController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Event Routes
|--------------------------------------------------------------------------
*/

Route::get('events', [EventController::class, 'index']);
Route::post('events', [EventController::class, 'store']);
Route::get('events/{event}', [EventController::class, 'show']);
Route::put('events/{event}', [EventController::class, 'update']);
Route::delete('events/{event}', [EventController::class, 'destroy']);
Route::get('events/producer/{event}', [EventController::class, 'getProducerName']);


/*
|--------------------------------------------------------------------------
| Sector Routes
|--------------------------------------------------------------------------
*/

Route::get('sectors', [SectorController::class, 'index']);
Route::post('sectors', [SectorController::class, 'store']);
Route::get('sectors/{sector}', [SectorController::class, 'show']);
Route::put('sectors/{sector}', [SectorController::class, 'update']);
Route::delete('sectors/{sector}', [SectorController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Batch Routes
|--------------------------------------------------------------------------
*/

Route::get('batches', [BatchController::class, 'index']);
Route::post('batches', [BatchController::class, 'store']);
Route::get('batches/{batch}', [BatchController::class, 'show']);
Route::put('batches/{batch}', [BatchController::class, 'update']);
Route::delete('batches/{batch}', [BatchController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Coupon Routes
|--------------------------------------------------------------------------
*/

Route::get('coupons', [CouponController::class, 'index']);
Route::post('coupons', [CouponController::class, 'store']);
Route::get('coupons/{coupon}', [CouponController::class, 'show']);
Route::put('coupons/{coupon}', [CouponController::class, 'update']);
Route::delete('coupons/{coupon}', [CouponController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Ticket Routes
|--------------------------------------------------------------------------
*/

Route::get('tickets', [TicketController::class, 'index']);
Route::post('tickets', [TicketController::class, 'store']);
Route::get('tickets/{ticket}', [TicketController::class, 'show']);
Route::put('tickets/{ticket}', [TicketController::class, 'update']);
Route::delete('tickets/{ticket}', [TicketController::class, 'destroy']);
