<?php

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
        'prefix' => 'api',
    ],
    function () {
        Route::get('/show', function () {
            return response([
                'message' => 'Dear nerd, you have landed on citydrop express API. You shouldn\'t be here but... ',
                'statusCode' => 200
            ], 200);
        });

        Route::group(
            ['prefix' => 'coffee'],
            function () {
               Route::get('/', [\App\Http\Controllers\CoffeeController::class, 'getCoffee']);
               Route::get('/{id}', [\App\Http\Controllers\CoffeeController::class, 'getCoffeeById']);
            }
        );
    }
);

