<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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
    return view('auth.login');
});

// Route::get('/empleado', function () {
//     return view('empleado.index');
// });

//Route::get('/empleado/create', [EmpleadoController::class, 'create']);

//we put the auth condition for access to the views
Route::resource('empleado', EmpleadoController::class)->middleware('auth');

//to hide the options of reset password and register
Auth::routes(['register'=>false, 'reset'=>false]);

// if I want the options come back only discomment the next line
//Auth::routes();

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    //we want to show the EmpleadoController as a main directory
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});