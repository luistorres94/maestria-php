<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\sensoresController;
use App\Http\Controllers\usuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () 
{
    Route::get('/user', function (Request $request) {

        return $request->user();
    });
    Route::get('/usuario',[usuariosController::class, 'authUser']);
    Route::get('/usuarios-busqueda',[usuariosController::class, 'muestraUsuarios']);
    Route::get('/roles',[usuariosController::class, 'muestraRoles']);
    Route::get('/usuario/{id}',[usuariosController::class, 'muestraUsuario']);
    Route::post('/nuevo-usuario',[usuariosController::class, 'nuevoUsuario']);
    Route::post('/edita-usuario/{id}',[usuariosController::class, 'editaUsuario']);
    Route::post('/elimina-usuario/{id}',[usuariosController::class, 'eliminaUsuario']);
    Route::get('/datos-temperatura',[sensoresController::class, 'muestraDatosTemperatura']);
    Route::get('datos-fecha-temperatura',[sensoresController::class, 'muestraFechasTemperatura']);
    Route::get('/datos-humedad',[sensoresController::class, 'muestraDatosHumedad']);
    Route::get('/datos-fecha-humedad',[sensoresController::class, 'muestraFechasHumedad']);
    Route::post('/cierrasesion',[usuariosController::class, 'cierraSesion']);
    Route::get('/dato-actual-temperatura',[sensoresController::class, 'temperaturaActual']);
    Route::get('/dato-actual-humedad',[sensoresController::class, 'humedadActual']);
    Route::post('/cambia-contrasena',[usuariosController::class, 'cambiaContrasena']);
});


Route::post('/login',[loginController::class, 'login']);
Route::get('/datosSensor',[sensoresController::class, 'recibeDatos']);