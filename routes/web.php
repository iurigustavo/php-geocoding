<?php

    use App\Http\Controllers\AddressesController;
    use App\Http\Controllers\ClientsAddressesController;
    use App\Http\Controllers\ClientsController;
    use App\Http\Controllers\ImportsController;
    use App\Http\Controllers\PagesController;
    use App\Http\Controllers\RoutesController;
    use App\Http\Controllers\Sys\AuditsController;
    use App\Http\Controllers\Sys\UsersController;
    use App\Http\Controllers\Sys\UsersProfileController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('', [PagesController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/home', [PagesController::class, 'index'])->name('home')->middleware('auth')->name('home');
    Auth::routes([
        'login'    => TRUE,
        'logout'   => TRUE,
        'register' => FALSE,
        'reset'    => TRUE,   // for resetting passwords
        'confirm'  => FALSE,  // for additional password confirmations
        'verify'   => FALSE,  // for email verification
    ]);
    Route::group(['middleware' => ['auth', 'role:admin']], function () {
        Route::get('users/profile', [UsersProfileController::class, 'show'])->name('users.profile.show');
        Route::put('users/profile', [UsersProfileController::class, 'update'])->name('users.profile.update');
        Route::get('users/change-role/{id}', [UsersProfileController::class, 'changeRole'])->name('users.changeRole');
        Route::resource('audits', AuditsController::class)->only('index');

        Route::resource('users', UsersController::class)->except('edit');
        Route::resource('clients', ClientsController::class)->except('edit');
        Route::get('addresses', AddressesController::class)->name('addresses');

        Route::get('routes/map/{uuid}', [RoutesController::class,'map'])->name('routes.map');
        Route::resource('routes', RoutesController::class)->except('edit');

        Route::get('imports/download-file/{import}', [ImportsController::class, 'downloadFile'])->name('imports.downloadFile');
        Route::resource('imports', ImportsController::class)->except('edit', 'destroy');



    });