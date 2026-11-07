<?php

use App\Http\Controllers\AcademicInfoController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReferralCodeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route School Profile
Route::get('/profil-sekolah', [HomeController::class, 'profile'])
    ->name('school-profile');

// Route Facilities
Route::get('/fasilitas', [HomeController::class, 'facilities'])
    ->name('facilities');

// Route Extracurriculars
Route::get('/kegiatan/ekstrakurikuler', [HomeController::class, 'extracurriculars'])
    ->name('extracurriculars');
// Route School Activity
Route::get('/kegiatan/aktivitas-sekolah', [HomeController::class, 'events'])
    ->name('events');

// Route Academic Info
Route::get('/informasi/akademik', [HomeController::class, 'academic_infos'])->name('academic-infos');
// Route News
Route::get('/informasi/berita', [HomeController::class, 'newsIndex'])
    ->name('home-news.index');
// Route News Detail
Route::get('/informasi/berita/{id}', [HomeController::class, 'newsDetail'])
    ->name('home-news.detail');

// Route Complaint User
Route::get('/layanan-pengunjung', [ComplaintController::class, 'faqs'])
    ->name('faqs.index');
// Route Complaints
Route::post('/layanan-pengunjung', [ComplaintController::class, 'store'])
    ->name('complaints.store');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Route Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Route Banner
    Route::resource('banners', BannerController::class);
    Route::delete('banners/photo/{id}', [BannerController::class, 'destroyPhoto'])
        ->name('banners.photo.destroy');

    // Route Referral Code
    Route::resource('referrals', ReferralCodeController::class);

    // Route Data Teacher
    Route::resource('teachers', TeacherController::class);

    // Route Data Student
    Route::resource('students', StudentController::class);

    // Route Greetings
    Route::resource('greetings', GreetingController::class);

    // Route Data Extracurricular
    Route::middleware(['role:admin,pic_ekskul'])->group(function () {
        Route::resource('extracurriculars', ExtracurricularController::class);
        Route::delete('extracurriculars/photo/{id}', [ExtracurricularController::class, 'destroyPhoto'])
            ->name('extracurriculars.photo.destroy');
    });

    // Route Data Event
    Route::resource('events', EventController::class);
    Route::delete('events/photo/{id}', [EventController::class, 'destroyPhoto'])
        ->name('events.photo.destroy');

    // Route Data Facilities
    Route::resource('facilities', FacilityController::class);
    Route::delete('facilities/photo/{id}', [FacilityController::class, 'destroyPhoto'])
        ->name('facilities.photo.destroy');

    // Route Data Academic Info
    Route::resource('academic_infos', AcademicInfoController::class);

    // Route News
    Route::resource('news', NewsController::class);

    // Route Complaint
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.update-status');
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');

    // Route Data User
    Route::resource('users', UserController::class);

    // Profile Admin
    Route::get('profile', [AdminProfileController::class, 'edit'])
        ->name('admin.profile.edit');
    Route::patch('profile', [AdminProfileController::class, 'update'])
        ->name('admin.profile.update');
    Route::patch('profile/password', [AdminProfileController::class, 'updatePassword'])
        ->name('admin.profile.password');
});

require __DIR__.'/auth.php';
