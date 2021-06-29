<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\SearchController::class, 'index'])->name('guest.index');
Route::get('/consulta/{tipo}', [App\Http\Controllers\SearchController::class, 'tipoConsulta'])->name('guest.tipoConsulta');
Route::post('/consulta/resultado', [App\Http\Controllers\SearchController::class, 'search'])->name('guest.search');
Route::get('/show/{id}', [App\Http\Controllers\SearchController::class, 'show'])->name('guest.show');

Route::get('/admin', [App\Http\Controllers\SheetsImportController::class, 'index'])->name('admin.index');
Route::post('/admin', [App\Http\Controllers\SheetsImportController::class, 'store'])->name('admin.store');

Route::get('/admin/table/pagamentos_orcamentarios', [App\Http\Controllers\SheetsImportController::class, 'tablePagamentosOrcamentarios'])->name('admin.tablePO');



//Route::post('/consulta', [App\Http\Controllers\ConsultaController::class, 'tipoConsulta'])->name('tipoConsulta');
