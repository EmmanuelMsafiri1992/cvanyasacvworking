<?php

namespace App\Http\Controllers;

use DateTimeZone;
use Illuminate\Http\Request;
use App\Library\Helper;
use App\Models\ResumeCategories;
use App\Models\ResumeTemplate;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $landingpage = Storage::disk('landingpage')->directories();
        $currencies = config('currencies');
        $languages  = config('languages');
        $time_zones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('settings.index', compact(
            'landingpage',
            'currencies',
            'languages',
            'time_zones'
        ));
    }

    public function localization(Request $request)
    {
        $landingpage = Storage::disk('landingpage')->directories();
        $currencies = config('currencies');
        $languages  = config('languages');
        $time_zones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('settings.localization', compact(
            'landingpage',
            'currencies',
            'languages',
            'time_zones'
        ));
    }

    public function email(Request $request)
    {
        $landingpage      = Storage::disk('landingpage')->directories();
        $currencies = config('currencies');
        $languages  = config('languages');
        $time_zones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('settings.email', compact(
            'landingpage',
            'currencies',
            'languages',
            'time_zones'
        ));
    }
    
    public function integrations(Request $request)
    {
        $landingpage      = Storage::disk('landingpage')->directories();
        $currencies = config('currencies');
        $languages  = config('languages');
        $time_zones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('settings.integrations', compact(
            'landingpage',
            'currencies',
            'languages',
            'time_zones'
        ));
    }

    public function update(Request $request, $group = '')
    {

        switch ($group) {

            case 'localization':

                $request->validate([
                    'settings'               => 'required',
                    'settings.APP_LOCALE'    => 'required',
                    'settings.CURRENCY_CODE' => 'required',
                    'settings.APP_TIMEZONE'  => 'required',
                ]);

                break;

            case 'email':

                $request->validate([
                    'settings'                   => 'required',
                    'settings.MAIL_HOST'         => 'required',
                    'settings.MAIL_PORT'         => 'required|integer',
                    'settings.MAIL_USERNAME'     => 'required',
                    'settings.MAIL_PASSWORD'     => 'required',
                    'settings.MAIL_ENCRYPTION'   => 'required',
                    'settings.MAIL_FROM_ADDRESS' => 'required|email',
                    'settings.MAIL_FROM_NAME'    => 'required',
                ]);

                break;

            case 'integrations':

                $request->validate([
                    'settings'                => 'required',
                    'settings.PAYPAL_SANDBOX' => 'required|boolean',
                ]);
    
                break;

            default:
            
                $request->validate([
                    'settings'            => 'required',
                    'settings.APP_URL'    => 'required|url',
                    'settings.APP_NAME'   => 'required',
                    'settings.SITE_LANDING'  => 'required',
                    'settings.PURCHASE_CODE' => 'required'
                ]);

                if(!Helper::curl_request($request->settings['PURCHASE_CODE'])){
                    return redirect()->back()
                        ->with('error', 'PURCHASE CODE not found.');
                }

                break;
        }
        
        $settings = collect($request->settings)->filter(function ($value, $setting) {
            if (is_null($value)) {
                setting()->forget($setting);
            }
            return !is_null($value);
        });

        // Bool params
       
        $settings->put('DISABLE_LANDING', $request->filled('settings.DISABLE_LANDING'));
        $settings->put('PAYPAL_SANDBOX', $request->input('settings.PAYPAL_SANDBOX') ? true : false);

        setting($settings->all())->save();

        Artisan::call('config:clear');

        return back()->with('success', __('Settings saved successfully'));
    }
    public function update_check(Request $request)
    {
        // Clear cache, routes, views
        Artisan::call('optimize:clear');

        return view('settings.update');
    }

    public function update_finish(Request $request)
    {
        
        // Migrate
        try {

            Artisan::call('migrate', ["--force" => true]);

            // Save installation
            touch(storage_path('installed'));

        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Can\'t migrate database: ' . $e->getMessage());

        }
        $template = ResumeTemplate::find(1);
        $template_category = ResumeCategories::find(1);
        
        if (!$template && !$template_category) {
            # code...
            // Default template
            $pathSeedSQL = database_path('seeds/default_template.sql');
                
            \DB::unprepared(file_get_contents($pathSeedSQL));

        }
        

        return redirect()->back()
            ->with('success', 'Update finished successfully');
    }
}
