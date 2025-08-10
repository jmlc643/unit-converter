<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitConverterController;

Route::get('/', [UnitConverterController::class, 'index'])->name('converter.index');
Route::post('/convert', [UnitConverterController::class, 'convert'])->name('converter.convert');
