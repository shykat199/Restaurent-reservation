<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Catagory;
use App\Models\Table;
use App\Models\Reservation;
use App\Models\Menu;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;

Route::get('/',[WelcomeController::class,'index']);

Route::get('/categories', [FrontendCategoryController::class,'index'])->name('categories.index');
Route::get('/categories/{category}', [FrontendCategoryController::class,'show'])->name('categories.show');

Route::get('/menus', [FrontendMenuController::class,'index'])->name('menus.index');

Route::get('/reservations/step_one', [FrontendReservationController::class,'stepOne'])->name('reservations.step.one');
Route::post('/reservations/step_one', [FrontendReservationController::class,'storeStepOne'])->name('reservations.store.step.one');

Route::get('/reservations/step_tow', [FrontendReservationController::class,'stepTow'])->name('reservations.step.tow');
Route::post('/reservations/step_tow', [FrontendReservationController::class,'storeStepTow'])->name('reservations.store.step.tow');

Route::get('/thankyou',[WelcomeController::class,'thankYou'])->name('thankyou');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'admin'])->name('admin.')
    ->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::resource('/categories', CategoryController::class);
        Route::resource('/menus', MenuController::class);
        Route::resource('/tables', TableController::class);
        Route::resource('/reservations', ReservationController::class);
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
