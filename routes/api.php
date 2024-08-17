<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TbllivrosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/livros',[TbllivrosController::class,'index']);
//falta testa-> busca id, deletar e o alterar.
Route::get('/livros/{codigo}',[TbllivrosController::class,'show']);
Route::post('/livros',[TbllivrosController::class,'store']);
Route::put('/livros/{codigo}',[TbllivrosController::class,'update']);
Route::delete('/livros/{id}',[TbllivrosController::class,'destroy']);