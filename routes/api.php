<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Decisor\ProjectController;

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

// Group route: User Auth
Route::middleware('auth.jwt')->group(function () {
    // Group route: v1
    Route::prefix('v1')->group(function () {
        // Group route: Decisor
        Route::group([
            'prefix'     => 'decisor',
            'middleware' => 'decisor',
        ], function () {
            // Project
            Route::get('projects', [ProjectController::class, 'index']);
            Route::post('project', [ProjectController::class, 'store']);
            Route::get('project/{id}', [ProjectController::class, 'show']);
            Route::put('project/{id}', [ProjectController::class, 'update']);
            Route::delete('project/{id}', [ProjectController::class, 'destroy']);
        });

        // Group route: Signatory
        Route::group([
            'prefix'     => 'signatory',
            'middleware' => 'signatory',
        ], function () {
            // code here
        });
    });
});
