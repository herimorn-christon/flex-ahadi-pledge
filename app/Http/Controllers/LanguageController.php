<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeLanguageRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    
    public function switchLanguage(Request $request)
    {
        $locale = $request->language;
        $request->session()->put('locale', $locale);

        return redirect()->back();
    }
    
}
