<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $seo = SeoSetting::where('page', 'home')->where('locale', $locale)->first();
        
        if ($seo) {
            SEOTools::setTitle($seo->meta_title ?? 'Rubenhair Latvia');
            SEOTools::setDescription($seo->meta_description);
            SEOTools::metatags()->setKeywords($seo->meta_keywords);
            if ($seo->og_image) {
                SEOTools::opengraph()->setImage(asset($seo->og_image));
            }
        }
        
        return view('frontend.index');
    }
}