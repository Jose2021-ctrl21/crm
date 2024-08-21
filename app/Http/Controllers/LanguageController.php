<?php

// app/Http/Controllers/LanguageController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|in:' . implode(',', array_keys(config('adminlte.languages'))),
        ]);

        Session::put('locale', $request->language);
        App::setLocale($request->language);

        return redirect()->back();
    }
}
