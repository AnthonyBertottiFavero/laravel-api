<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\PortfolioController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('portfolios', [PortfolioController::class, 'index'])->name('api.portfolios.index');
Route::get('portfolios/random', [PortfolioController::class, 'random'])->name('api.portfolios.random');
Route::get('portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('api.portfolios.show');

Route::get('types', [TypeController::class, 'index'])->name('api.types.index');

Route::post('leads/', [LeadController::class, 'store'])->name('api.leads.store');
