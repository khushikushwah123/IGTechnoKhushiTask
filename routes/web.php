<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\{GenerateUrlController,AuthController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::match(['get','post'],'register-form',[AuthController::class,'register']);
Route::match(['get','post'],'login-form',[AuthController::class,'login']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::match(['GET','POST'],'dashboard-page',[AuthController::class,'dashboard_page']);
    Route::match(['GET','POST'],'dashboard-show/{url}',[AuthController::class,'dashboard_show'])->name('dashboard.show');
    Route::match(['GET','POST'],'dashboard-edit/{url}',[AuthController::class,'dashboard_edit'])->name('dashboard.edit');
    Route::match(['GET','POST'],'dashboard-delete/{url}',[AuthController::class,'dashboard_delete'])->name('dashboard.delete');


    Route::match(['GET','POST'],'generate-url',[GenerateUrlController::class,'create']);
    Route::match(["GET","POST"],'generate-url/success/{base_path}',[GenerateUrlController::class,'success'])->name('generate_url.success');
    Route::match(['get','post'],'exit-page/{base_path}',[GenerateUrlController::class,'exit'])->name('generate_url.exit');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
