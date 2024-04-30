<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\SettingGeneralController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


    Route::get('setting/general_setting', [SettingGeneralController::class,'generalSetting'])->name('setting.general');
	Route::post('setting/general_setting_store', [SettingGeneralController::class,'generalSettingStore'])->name('setting.generalStore');

    Route::resource('intermediary/permissions', PermissionController::class);
    Route::resource('intermediary/roles', RoleController::class);

    Route::resource('dashboard/user', UserController::class);        
    Route::get('dashboard/list_users', [UserController::class, 'listarUsuarios'])->name('list_users');

    Route::resource('proyect', ProyectController::class);
    Route::get('board/{proyect}', [ProyectController::class, 'board'])->name('proyect.board');    

    Route::get('boards/{proyect}', [ProyectController::class, 'downloadXML'])->name('downloadXML');    
    Route::post('boards/{proyect}', [ProyectController::class, 'uploadXML'])->name('uploadXML');    
    Route::post('boards/meeting/{proyect}', [ProyectController::class, 'uploadXML'])->name('chat.greet');
});


