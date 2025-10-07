<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seoSettings = SeoSetting::where('page', 'home')->get()->keyBy('locale');
        return view('backend.seo.index', compact('seoSettings'));
    }
    
    public function update(Request $request)
    {
        foreach (['lv', 'en', 'ru'] as $locale) {
            SeoSetting::updateOrCreate(
                ['page' => 'home', 'locale' => $locale],
                [
                    'meta_title' => $request->input("home_meta_title_$locale"),
                    'meta_description' => $request->input("home_meta_description_$locale"),
                    'meta_keywords' => $request->input("home_meta_keywords_$locale"),
                ]
            );
        }
        
        return redirect()->route('admin.seo.index')->with('success', 'SEO settings updated successfully');
    }
}