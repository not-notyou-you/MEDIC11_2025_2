<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DatabaseManagerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Inspiring;
use App\Models\Service;

##====================== P U B L I C ======================##

Route::get('/', function () {
    return view('pages.home', [
        'title' => 'Home'
    ]);
})->name('home');

Route::get('homes', function () {
    return view('pages.homes', [
        'title' => 'Homes'
    ]);
})->name('homes');

Route::get('/about', function () {
    return view('pages.about', [
        'title' => 'About'
    ]);
})->name('about');

Route::get('/program', function () {
    return view('pages.program', [
        'title' => 'Program'
    ]);
})->name('program');

Route::get('/organigram', function () {
    return view('pages.organigram', [
        'title' => 'Organigram'
    ]);
})->name('organigram');

Route::get('/quiz', function () {
    return view('pages.quiz', [
        'title' => 'Quiz'
    ]);
})->name('quiz');

Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/form', [ServiceController::class, 'create'])->name('service.create');
Route::post('/service/form', [ServiceController::class, 'store'])->name('service.store');
Route::get('/service/confirm', [ServiceController::class, 'confirm'])->name('service.confirm');


Route::get('/gallery', [GalleryController::class, 'user_index'])->name('gallery.user_index');
Route::get('/gallery/{category:slug}', [GalleryController::class, 'user_show'])->name('gallery.user_show');
Route::get('/gallery/{category}/{image}', [GalleryController::class, 'showImage'])->name('gallery.show_image');

##====================== A D M I N ======================##

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/database-manager', function () {
        return view('pages.database-manager.index', [
            'title' => 'Database Manager',
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
        ]);
    })->name('database.manager');
    
    Route::get('dashboard/account', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('dashboard/account/create', [ProfileController::class, 'create'])->name('profile.create_admin');
    Route::post('dashboard/account/store', [ProfileController::class, 'store'])->name('profile.store_admin');
    Route::get('dashboard/account/{id}/edit', [ProfileController::class, 'edit_admin'])->name('profile.edit_admin');
    Route::put('dashboard/account/{id}', [ProfileController::class, 'update_admin'])->name('profile.update_admin');
    Route::delete('dashboard/account/{id}', [ProfileController::class, 'destroy_admin'])->name('profile.destroy_admin');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'quote' => Inspiring::quote(),
            'pengajuans' => Service::limit(10)->orderByDesc('id')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
            'notification' => Service::where('status', 'Pending')->get(),
        ]);
    })->name('dashboard');

    Route::get('/dashboard/services', [ServiceController::class, 'show'])->name('service.show');
    Route::get('/dashboard/services/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/dashboard/services/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/dashboard/services/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::put('service/{id}', [ServiceController::class, 'update'])->name('service.update');

    Route::post('/service/{id}/send-email', [ServiceController::class, 'sendEmail'])->name('service.send-email');
    
    Route::resource('/dashboard/category', CategoryController::class);

    Route::resource('/dashboard/gallery', GalleryController::class);
    Route::post('/dashboard/gallery/upload', [GalleryController::class, 'upload'])->name('gallery.upload');

    Route::get('/service/download-word/{id}', [ServiceController::class, 'downloadWord'])->name('service.download-word');

    Route::get('/services/export', [ServiceController::class, 'export'])->name('services.export');
    Route::delete('/services/clear', [ServiceController::class, 'clear'])->name('services.clear');
    Route::post('/services/import', [ServiceController::class, 'import'])->name('services.import');
});

require __DIR__ . '/auth.php';