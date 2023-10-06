<?php

use Illuminate\Support\Facades\Route;
use Webkul\Installer\Http\Controllers\InstallerController;

Route::group(['middleware' => ['web']], function () {
    Route::get('install', [InstallerController::class ,'index'])->withoutMiddleware([CanInstall::class])->name('installer.index');
});