<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\VideosController;
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

Route::prefix('usuario')->group(function(){
    Route::put('/crear',[UsuariosController::class,'crear']);
    Route::post('/desactivar/{id}',[UsuariosController::class,'desactivar']);
    Route::post('/editar/{id}',[UsuariosController::class,'editar']);
    Route::get('/listarCursosAdquiridos/{id}',[UsuariosController::class,'listarCursosAdquiridos']);
    Route::put('/adquirir_cursos/{usuarios_id}/{cursos_id}',[UsuariosController::class,'adquirir_cursos']);
    Route::get('/listar',[UsuariosController::class,'listar']);
});


Route::prefix('curso')->group(function(){
    Route::put('/crear',[CursosController::class,'crear']);
    Route::get('/listar',[CursosController::class,'listar']);
});

Route::prefix('video')->group(function(){
    Route::put('/crear',[VideosController::class,'crear']);
});