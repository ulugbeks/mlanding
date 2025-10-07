<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::published()
            ->with(['translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            }])
            ->orderBy('sort_order', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Get latest blogs for sidebar
        $latestBlogs = Blog::published()
            ->with(['translations' => function ($query) {
                $query->where('locale', app()->getLocale());
            }])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Set SEO
        $locale = app()->getLocale();
        $seo = SeoSetting::where('page', 'blogs')->where('locale', $locale)->first();
        
        if ($seo) {
            SEOTools::setTitle($seo->meta_title ?? 'Blog - Rubenhair Latvia');
            SEOTools::setDescription($seo->meta_description);
            SEOTools::metatags()->setKeywords($seo->meta_keywords);
        }
        
        return view('frontend.blogs', compact('blogs', 'latestBlogs'));
    }
    
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->published()->firstOrFail();
        $translation = $blog->translation();
        
        if (!$translation) {
            abort(404);
        }
        
        SEOTools::setTitle($translation->meta_title ?? $translation->title);
        SEOTools::setDescription($translation->meta_description ?? $translation->excerpt);
        SEOTools::metatags()->setKeywords($translation->meta_keywords);
        
        if ($blog->preview_image) {
            SEOTools::opengraph()->setImage(asset('storage/' . $blog->preview_image));
        }
        
        return view('frontend.blog-single', compact('blog', 'translation'));
    }
}