<?php

use App\Livewire\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/auth/login');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', Auth\Login::class)->name('login');
    Route::get('/register', Auth\Register::class)->name('register');
    Route::get('/logout', Auth\Logout::class)->name('auth.logout');
});

Route::fallback(function () {
    return view('404');
});

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Cache berhasil dibersihkan!';
});

Route::get('/generate', function () {
    Artisan::call('storage:link');
    echo 'ok';
});

// Route redirect
require __DIR__ . '/superadmin.php';

require __DIR__ . '/e-spp.php';

require __DIR__ . '/e-santri.php';

require __DIR__ . '/e-cashless/petugas-e-cashless.php';

require __DIR__ . '/e-cashless/petugas-laundry.php';

require __DIR__ . '/e-cashless/petugas-warung.php';
