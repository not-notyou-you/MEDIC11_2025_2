<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AspirasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Inspiring;
use App\Models\Service;

use App\Http\Controllers\ObatLuarController;
use App\Http\Controllers\ObatMinumController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PeminjamanAlatController;

use App\Http\Controllers\Quiz\PublicQuizController;
use App\Http\Controllers\Quiz\QuizController;
use App\Http\Controllers\Quiz\AdminQuizController;
use App\Http\Controllers\Quiz\QuestionController;
use App\Http\Controllers\EmailBlastController;

##====================== A L I V E ======================##

Route::get('/alive', function () {
    return response()->file(public_path('alive/index.html'));
});

Route::get('/alive/{any}', function ($any) {
    $file = public_path("alive/{$any}");

    if (file_exists($file) && !is_dir($file)) {
        return response()->file($file);
    }

    return response()->file(public_path('alive/index.html'));
})->where('any', '.*');

Route::get('/test-alive', function () {
    return 'Laravel OK';
});

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

// Route untuk Alive
Route::prefix('alive')->group(function () {
    Route::get('/', function () {return view('pages.alive.index');})->name('alive.index');
});

// Route untuk User Aspirasi
Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');

// Route untuk Alive
Route::prefix('alive')->group(function () {
    Route::get('/', function () {return view('pages.alive.index');})->name('alive.index');
});

// Route untuk Aspirasi
Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');

// Route untuk Quiz
Route::prefix('quiz')->name('public.quiz.')->group(function () {
    Route::get('/', [PublicQuizController::class, 'index'])->name('index');
    Route::get('/{quiz}/play', [PublicQuizController::class, 'show'])->name('play');
    Route::post('/{quiz}/save-attempt', [PublicQuizController::class, 'saveAttempt'])->name('saveAttempt');
    Route::get('/{quiz}/score', [PublicQuizController::class, 'score'])->name('score');
});

Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/form', [ServiceController::class, 'create'])->name('service.create');
Route::post('/service/form', [ServiceController::class, 'store'])->name('service.store');
Route::get('/service/confirm', [ServiceController::class, 'confirm'])->name('service.confirm');

Route::get('/gallery', [GalleryController::class, 'user_index'])->name('gallery.user_index');
Route::get('/gallery/{id}/download', [GalleryController::class, 'download'])->name('gallery.download');
Route::get('/gallery/{category:slug}', [GalleryController::class, 'user_show'])->name('gallery.user_show');
Route::get('/gallery/{category}/{image}', [GalleryController::class, 'showImage'])->name('gallery.show_image');


Route::get('surat2', function () {
    return view('pages.surat2', [
        'title' => 'surat2'
    ]);
})->name('surat2');

Route::get('surat4', function () {
    return view('pages.surat4', [
        'title' => 'surat4'
    ]);
})->name('surat4');

Route::get('/service/{id}/surat', [ServiceController::class, 'surat'])->name('service.surat');

##====================== A U T H (admin and user) ======================##

Route::middleware(['auth'])->group(function () {

    // Route untuk Obat Luar (Page 1)
    Route::prefix('obat-luar')->name('obat-luar.')->group(function () {
        Route::get('/', [ObatLuarController::class, 'index'])->name('index');
        Route::post('/', [ObatLuarController::class, 'store'])->name('store');
        Route::get('/{obatLuar}/edit', [ObatLuarController::class, 'edit'])->name('edit');
        Route::put('/{obatLuar}', [ObatLuarController::class, 'update'])->name('update');
        Route::delete('/{obatLuar}', [ObatLuarController::class, 'destroy'])->name('destroy');
    });

    // Route untuk Obat Minum (Page 2)
    Route::prefix('obat-minum')->name('obat-minum.')->group(function () {
        Route::get('/', [ObatMinumController::class, 'index'])->name('index');
        Route::post('/', [ObatMinumController::class, 'store'])->name('store');
        Route::get('/{obatMinum}/edit', [ObatMinumController::class, 'edit'])->name('edit');
        Route::put('/{obatMinum}', [ObatMinumController::class, 'update'])->name('update');
        Route::delete('/{obatMinum}', [ObatMinumController::class, 'destroy'])->name('destroy');
    });

    // Route untuk Pasien (Page 3 & 5)
    Route::prefix('pasien')->name('pasien.')->group(function () {
        // Form pendataan pasien (Page 3)
        Route::get('/create', [PasienController::class, 'create'])->name('create');
        Route::post('/', [PasienController::class, 'store'])->name('store');

        // Excel routes untuk pasien
        Route::get('/export', [PasienController::class, 'export'])->name('export');
        Route::post('/import', [PasienController::class, 'import'])->name('import');
        Route::delete('/clear', [PasienController::class, 'clear'])->name('clear');

        // Data penanganan pasien (Page 5)
        Route::get('/', [PasienController::class, 'index'])->name('index');
        Route::get('/{pasien}', [PasienController::class, 'show'])->name('show');
        Route::get('/{pasien}/edit', [PasienController::class, 'edit'])->name('edit');
        Route::put('/{pasien}', [PasienController::class, 'update'])->name('update');
        Route::delete('/{pasien}', [PasienController::class, 'destroy'])->name('destroy');

    });

    // Route untuk Peminjaman Alat Kesehatan (Page 4)
    Route::prefix('peminjaman-alat')->name('peminjaman-alat.')->group(function () {
        Route::get('/', [PeminjamanAlatController::class, 'index'])->name('index');
        Route::post('/', [PeminjamanAlatController::class, 'store'])->name('store');

        // Excel routes
        Route::get('/export', [PeminjamanAlatController::class, 'export'])->name('export');
        Route::post('/import', [PeminjamanAlatController::class, 'import'])->name('import');
        Route::delete('/clear', [PeminjamanAlatController::class, 'clear'])->name('clear');

        Route::get('/{peminjamanAlat}/edit', [PeminjamanAlatController::class, 'edit'])->name('edit');
        Route::put('/{peminjamanAlat}', [PeminjamanAlatController::class, 'update'])->name('update');
        Route::delete('/{peminjamanAlat}', [PeminjamanAlatController::class, 'destroy'])->name('destroy');
    });

    Route::get('/dashboard/database-manager', function () {
        return view('pages.database-manager.index', [
            'title' => 'Database Manager',
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
        ]);
    })->name('database.manager');
    
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

    Route::post('/service/{id}/send-email', [ServiceController::class, 'sendEmail'])->name('service.send-email');
    
    Route::resource('/dashboard/category', CategoryController::class);

    Route::resource('/dashboard/gallery', GalleryController::class);
    Route::post('/dashboard/gallery/upload', [GalleryController::class, 'upload'])->name('gallery.upload');
});

##====================== A D M I N (admin only) ======================##

Route::middleware(['auth','admin'])->group(function () {
    
    Route::get('/services/export', [ServiceController::class, 'export'])->name('services.export');
    Route::delete('/services/clear', [ServiceController::class, 'clear'])->name('services.clear');
    Route::post('/services/import', [ServiceController::class, 'import'])->name('services.import');

    // Route untuk Admin Aspirasi
    Route::get('/admin/aspirasi', [AspirasiController::class, 'indexAdmin'])->name('aspirasi.admin');
    Route::get('/admin/aspirasi/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
    Route::delete('/admin/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');

        Route::prefix('admin')->name('admin.')->group(function () {
            // Quiz Management
            Route::get('quizzes', [QuizController::class, 'index'])->name('quiz.index');
            Route::get('quizzes/create', [QuizController::class, 'create'])->name('quiz.create');
            Route::post('quizzes', [QuizController::class, 'store'])->name('quiz.store');
            Route::delete('quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');
            
            // Quiz Publish/Unpublish
            Route::post('quizzes/{quiz}/publish', [QuizController::class, 'togglePublish'])->name('quiz.publish');
            
            // Manage Questions
            Route::get('quizzes/{quiz}/manage', [QuizController::class, 'manage'])->name('quiz.manage');
            Route::post('quizzes/{quiz}/questions', [QuizController::class, 'storeQuestion'])->name('quiz.questions.store');
            
            // View Attempts
            Route::get('quizzes/{quiz}/attempts', [QuizController::class, 'showAttempts'])->name('quiz.attempts');
            // Hapus Attempts
            Route::delete('quiz-attempts/{attempt}', [QuizController::class, 'deleteAttempt'])->name('quiz.attempts.delete');
            
            // Question CRUD (additional routes)
            Route::get('/questions/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
            Route::put('/questions/{id}', [QuestionController::class, 'update'])->name('questions.update');
            Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
            Route::delete('questions/{question}', [QuizController::class, 'destroyQuestion'])->name('quiz.questions.destroy');

    });

});


Route::middleware(['auth', 'superadmin'])->group(function () {
    // Account Management
    Route::prefix('dashboard/account')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/create', [ProfileController::class, 'create'])->name('create_admin');
        Route::post('/store', [ProfileController::class, 'store'])->name('store_admin');
        Route::get('/{id}/edit', [ProfileController::class, 'edit_admin'])->name('edit_admin');
        Route::put('/{id}', [ProfileController::class, 'update_admin'])->name('update_admin');
        Route::delete('/{id}', [ProfileController::class, 'destroy_admin'])->name('destroy_admin');
    });

    // Email Blast System
    Route::prefix('email-blast')->name('email-blast.')->group(function () {
        Route::get('/', [EmailBlastController::class, 'index'])->name('index');
        Route::post('/send', [EmailBlastController::class, 'sendBlast'])->name('send');
        Route::post('/process', [EmailBlastController::class, 'processQueue'])->name('process');
        Route::post('/clear', [EmailBlastController::class, 'clearQueue'])->name('clear');
        Route::get('/status', [EmailBlastController::class, 'queueStatus'])->name('status');
    });
});

require __DIR__ . '/auth.php';