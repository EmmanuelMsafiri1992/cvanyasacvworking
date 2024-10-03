<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Library\Helper;
use App\Library\Spintax;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\ResumeTemplate;
use App\Models\ResumeCategories;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RBController extends Controller
{
    public function localize($locale)
    {
        $locale = array_key_exists($locale, config('languages')) ? $locale : config('app.fallback_locale');
        
        App::setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }

    public function templates($id = "",Request $request) {
      // Get templates
      
      $data = "";
      
      $user            = $request->user();
      $landingpage            = config('rb.SITE_LANDING');
      $categories = ResumeCategories::all();

      if ($id) {
          $data = ResumeTemplate::where('category_id', $id);
          $data->where('active', true);
      }
      else{
         $data = ResumeTemplate::where('active', true);
      }
      

      // if ($request->filled('search')) {
      //       $data->where('name', 'like', '%' . $request->search . '%');
      // }

      $data->orderBy('created_at', 'DESC');
        
      $data = $data->paginate(12);
      
      return view('landingpage.' . $landingpage . '.templates', compact('data','user','categories'
        ));


    }

    public function landing(Request $request)
    {

        $landingpage            = config('rb.SITE_LANDING');
        $user            = $request->user();
        
        $templates =  ResumeTemplate::where('active', true);
        $templates->orderBy('created_at', 'DESC');

        $templates = $templates->paginate(9);

        $packages   = Package::all();
        $currency_code           = config('rb.CURRENCY_CODE');
        $currency_symbol         = config('rb.CURRENCY_SYMBOL');

        return view('landingpage.' . $landingpage . '.index', compact(
            'user','templates','packages' ,'currency_code',
            'currency_symbol'
        ));
    }
    public function terms(Request $request)
    {
        $user            = $request->user();
        $termcondition            = config('rb.termcondition');
        $landingpage            = config('rb.SITE_LANDING');

        return view('landingpage.' . $landingpage . '.terms', compact('termcondition','user'
        ));
    }
    public function privacy(Request $request)
    {
        $user            = $request->user();
        $privacy            = config('rb.privacy');
        $landingpage            = config('rb.SITE_LANDING');

        return view('landingpage.' . $landingpage . '.privacy', compact('privacy','user'
        ));
    }

}
