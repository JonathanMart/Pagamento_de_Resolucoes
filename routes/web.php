<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\SearchController::class, 'index'])->name('guest.index');
Route::post('/', [App\Http\Controllers\SearchController::class, 'search'])->name('guest.search');
Route::get('/{tipo}', [App\Http\Controllers\SearchController::class, 'tipoConsulta'])->name('guest.tipoConsulta');
Route::get('/show/{id}', [App\Http\Controllers\SearchController::class, 'show'])->name('guest.show');


Route::get('/admin', function(){
    return view('admin.index');
});

Route::get('/admin', [App\Http\Controllers\SheetsImportController::class, 'index'])->name('admin.index');
Route::post('/admin', [App\Http\Controllers\SheetsImportController::class, 'store'])->name('admin.store');

Route::get('/admin/table/pagamentos_orcamentarios', [App\Http\Controllers\SheetsImportController::class, 'tablePagamentosOrcamentarios'])->name('admin.tablePO');



Route::post('/consulta', [App\Http\Controllers\ConsultaController::class, 'tipoConstulta'])->name('tipoConsulta');
