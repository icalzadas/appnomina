<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\CalculoController;

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
    return redirect()->route('empleados.index');
});

Route::resource('empleados', EmpleadoController::class);

Route::get('/empleados/{empleado}/movimientos/create', [MovimientoController::class, 'create'])->name('empleados.movimientos.create');
Route::post('/empleados/{empleado}/movimientos/store', [MovimientoController::class, 'store'])->name('empleados.movimientos.store');
Route::get('/empleados/{empleado}/movimientos', [MovimientoController::class, 'index'])->name('empleados.movimientos.index');
Route::delete('/empleados/{empleado}/movimientos/{movimiento}', [MovimientoController::class, 'destroy'])->name('empleados.movimientos.destroy');

Route::get('/calculos/create', [CalculoController::class, 'create'])->name('calculos.create');
Route::post('/calculos/store', [CalculoController::class, 'store'])->name('calculos.store');
Route::get('/calculos', [CalculoController::class, 'index'])->name('calculos.index');