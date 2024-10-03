<?php

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
// Authorization
Auth::routes();

Route::get('lang/{locale}', 'RBController@localize')->name('localize');


// Landing
if (config('rb.DISABLE_LANDING')) {
    Route::get('/', function () {
        return redirect()->route('resume.index');
    })->name('landing');
} else {
    Route::get('/', 'RBController@landing')->name('landing');
}
Route::get('templates/{id?}', 'RBController@templates')->name('templates');

// Install
Route::middleware('installable')->group(function () {
    Route::get('install', 'InstallController@installCheck')->name('install.check');
    Route::get('installDB/{passed}', 'InstallController@installDB')->name('install.passed');
    Route::post('installDBPost', 'InstallController@installDBPost')->name('install.db');
    Route::get('install/setup', 'InstallController@setup')->name('install.setup');
    Route::get('install/administrator', 'InstallController@install_administrator')->name('install.administrator');
    Route::post('install/administrator', 'InstallController@install_finish')->name('install.finish');
});

// pages
Route::get('terms-and-conditions', 'RBController@terms')->name('terms');
Route::get('privacy', 'RBController@privacy')->name('privacy');

// Login with social accounts
Route::get('login/{provider}', '\App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback', '\App\Http\Controllers\Auth\LoginController@handleProviderCallback')->name('login.callback');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Authorized users
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('profile', 'UsersController@profile')->name('profile.index');
    Route::put('profile', 'UsersController@profile_update')->name('profile.update');

    // Billing
    Route::get('billing', 'BillingController@index')->name('billing.index');
    Route::delete('billing', 'BillingController@cancel')->name('billing.cancel');
    Route::get('billing/{package}', 'BillingController@package')->name('billing.package');

    // Payment gateway
    Route::post('billing/{package}/{gateway}', 'BillingController@gateway_purchase')->name('gateway.purchase');
    Route::get('billing/{payment}/return', 'BillingController@gateway_return')->name('gateway.return');
    Route::get('billing/{payment}/cancel', 'BillingController@gateway_cancel')->name('gateway.cancel');
    Route::get('billing/{payment}/notify', 'BillingController@gateway_notify')->name('gateway.notify');
    
    
    Route::prefix('resume')->group(function() {

        Route::get('/', 'ResumeController@index')->name('resume.index');
        Route::get('template/{id?}', 'ResumeController@getAllTemplate')->name('resume.template');
        
        
        // Only users on subscripion
        Route::middleware('billing')->group(function () {
            // Export
            Route::get('exportpdf/{resume}', 'ResumeController@exportPDF')->name('resume.exportpdf');
            // Create
            Route::get('createresume/{template?}', 'ResumeController@getCreateResume');

        });

      


        Route::post('create', 'ResumeController@postCreateResume')->name('resume.save');

        // Delete
        Route::post('delete/{resume}', 'ResumeController@delete')->name('resume.delete');
        
        // Update
        Route::get('edit/{resume}', 'ResumeController@getEditResume')->name('resume.edit');
        Route::post('edit', 'ResumeController@postEditResume')->name('resume.update'); 
       
    });

   

    // Administrator
    Route::middleware('can:admin')->prefix('settings')->name('settings.')->group(function () {

        // Settings
        Route::get('/', 'SettingsController@index')->name('index');
        Route::get('localization', 'SettingsController@localization')->name('localization');
        Route::get('email', 'SettingsController@email')->name('email');
        Route::get('integrations', 'SettingsController@integrations')->name('integrations');

         // Save settings
        Route::put('{group?}', 'SettingsController@update')->name('update');

        Route::resource('resumetemplate', 'ResumetemplateController')->except('show');
        Route::resource('resumetemplatecategories', 'ResumetemplatecategoriesController')->except('show');    
         // Packages
         Route::resource('packages', 'PackagesController')->except('show');

         // Users
         Route::resource('users', 'UsersController')->except('show');
        
         // Payments
         Route::get('payments', 'BillingController@payments')->name('payments');

        // Update
        Route::middleware('updateable')->group(function () {
            Route::get('update', 'SettingsController@update_check')->name('update_check');
            Route::post('update', 'SettingsController@update_finish')->name('updatefinish');
        });

    });

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
