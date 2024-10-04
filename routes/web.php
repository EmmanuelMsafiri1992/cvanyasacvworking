<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\RBController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\SettingsController;

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

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);

// Localization
Route::get('lang/{locale}', [RBController::class, 'localize'])->name('localize');

// Landing
if (config('rb.DISABLE_LANDING')) {
    Route::get('/', function () {
        return redirect()->route('resume.index');
    })->name('landing');
} else {
    Route::get('/', [RBController::class, 'landing'])->name('landing');
}
Route::get('templates/{id?}', [RBController::class, 'templates'])->name('templates');

// Install
Route::middleware('installable')->group(function () {
    Route::get('install', [InstallController::class, 'installCheck'])->name('install.check');
    Route::get('installDB/{passed}', [InstallController::class, 'installDB'])->name('install.passed');
    Route::post('installDBPost', [InstallController::class, 'installDBPost'])->name('install.db');
    Route::get('install/setup', [InstallController::class, 'setup'])->name('install.setup');
    Route::get('install/administrator', [InstallController::class, 'install_administrator'])->name('install.administrator');
    Route::post('install/administrator', [InstallController::class, 'install_finish'])->name('install.finish');
});

// Pages
Route::get('terms-and-conditions', [RBController::class, 'terms'])->name('terms');
Route::get('privacy', [RBController::class, 'privacy'])->name('privacy');

// Login with social accounts
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('login.social');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('login.callback');
Route::get('logout', [LoginController::class, 'logout']);

// Authorized users
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('profile', [UsersController::class, 'profile'])->name('profile.index');
    Route::put('profile', [UsersController::class, 'profile_update'])->name('profile.update');

    // Billing
    Route::get('billing', [BillingController::class, 'index'])->name('billing.index');
    Route::delete('billing', [BillingController::class, 'cancel'])->name('billing.cancel');
    Route::get('billing/{package}', [BillingController::class, 'package'])->name('billing.package');

    // Payment gateway
    Route::post('billing/{package}/{gateway}', [BillingController::class, 'gateway_purchase'])->name('gateway.purchase');
    Route::get('billing/{payment}/return', [BillingController::class, 'gateway_return'])->name('gateway.return');
    Route::get('billing/{payment}/cancel', [BillingController::class, 'gateway_cancel'])->name('gateway.cancel');
    Route::get('billing/{payment}/notify', [BillingController::class, 'gateway_notify'])->name('gateway.notify');

    // Resume
    Route::prefix('resume')->group(function () {
        Route::get('/', [ResumeController::class, 'index'])->name('resume.index');
        Route::get('template/{id?}', [ResumeController::class, 'getAllTemplate'])->name('resume.template');

        // Only users on subscription
        Route::middleware('billing')->group(function () {
            Route::get('exportpdf/{resume}', [ResumeController::class, 'exportPDF'])->name('resume.exportpdf');
            Route::get('createresume/{template?}', [ResumeController::class, 'getCreateResume']);
        });

        Route::post('create', [ResumeController::class, 'postCreateResume'])->name('resume.save');
        Route::post('delete/{resume}', [ResumeController::class, 'delete'])->name('resume.delete');
        Route::get('edit/{resume}', [ResumeController::class, 'getEditResume'])->name('resume.edit');
        Route::post('edit', [ResumeController::class, 'postEditResume'])->name('resume.update');
    });

    // Administrator
    Route::middleware('can:admin')->prefix('settings')->name('settings.')->group(function () {

        // Settings
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::get('localization', [SettingsController::class, 'localization'])->name('localization');
        Route::get('email', [SettingsController::class, 'email'])->name('email');
        Route::get('integrations', [SettingsController::class, 'integrations'])->name('integrations');

        // Save settings
        Route::put('{group?}', [SettingsController::class, 'update'])->name('update');

        Route::resource('resumetemplate', 'ResumetemplateController')->except('show');
        Route::resource('resumetemplatecategories', 'ResumetemplatecategoriesController')->except('show');
        Route::resource('packages', 'PackagesController')->except('show');
        Route::resource('users', 'UsersController')->except('show');
        Route::get('payments', [BillingController::class, 'payments'])->name('payments');

        // Update
        Route::middleware('updateable')->group(function () {
            Route::get('update', [SettingsController::class, 'update_check'])->name('update_check');
            Route::post('update', [SettingsController::class, 'update_finish'])->name('updatefinish');
        });
    });
});

// Home route
Route::get('/home', 'HomeController@index')->name('home');
