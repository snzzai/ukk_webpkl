<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Siswa\Form;
use App\Livewire\Siswa\View;
use App\Livewire\Guru\Form as GuruForm;
use App\Livewire\Guru\View as GuruView;
use App\Livewire\Industri\Form as IndustriForm;
use App\Livewire\Industri\View as IndustriView;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pkl\Form as PKLForm;
use App\Livewire\Pkl\View as PKLView;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'check.roles'])
    ->name('dashboard');

Route::view('siswa', 'siswa')
    ->middleware(['auth', 'verified', 'check.roles'])
    ->name('siswa');

Route::view('guru', 'guru')
    ->middleware(['auth', 'verified', 'check.roles'])
    ->name('guru');

Route::view('industri', 'industri')
    ->middleware(['auth', 'verified', 'check.roles'])
    ->name('industri');

Route::view('pkl', 'pkl')
    ->middleware(['auth', 'verified', 'check.roles'])
    ->name('pkl');

Route::middleware(['auth', 'verified', 'check.roles'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/siswa/show/{id}', View::class)->name('siswa.show');
    Route::get('/siswa/create', Form::class)->name('siswa.create');
    Route::get('/siswa/edit/{id}', Form::class)->name('siswa.edit');
    
    Route::get('/guru/show/{id}', GuruView::class)->name('guru.show');
    Route::get('/guru/create', GuruForm::class)->name('guru.create');
    Route::get('/guru/edit/{id}', GuruForm::class)->name('guru.edit');
    
    Route::get('/industri/show/{id}', IndustriView::class)->name('industri.show');
    Route::get('/industri/create', IndustriForm::class)->name('industri.create');
    Route::get('/industri/edit/{id}', IndustriForm::class)->name('industri.edit');
    
    // PKL Routes - TANPA middleware khusus
    Route::get('/pkl/show/{id}', PklView::class)->name('pkl.show');
    Route::get('/pkl/create', PklForm::class)->name('pkl.create');
    Route::get('/pkl/edit/{id}', PklForm::class)->name('pkl.edit');
});

require __DIR__.'/auth.php';