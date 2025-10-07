<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('translations')->orderBy('sort_order', 'desc')->paginate(20);
        return view('backend.blogs.index', compact('blogs'));
    }
    
    public function create()
    {
        return view('backend.blogs.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title_lv' => 'required|string|max:255',
            'excerpt_lv' => 'required',
            'content_lv' => 'required',
            'preview_image' => 'nullable|image|max:2048',
        ]);
        
        $blog = Blog::create([
            'slug' => Str::slug($request->title_lv),
            'is_published' => $request->boolean('is_published'),
            'sort_order' => $request->sort_order ?? 0,
        ]);
        
        if ($request->hasFile('preview_image')) {
            $path = $request->file('preview_image')->store('blogs', 'public');
            $blog->update(['preview_image' => $path]);
        }
        
        // Create translations for all languages
        foreach (['lv', 'en', 'ru'] as $locale) {
            BlogTranslation::create([
                'blog_id' => $blog->id,
                'locale' => $locale,
                'title' => $request->{"title_$locale"} ?? $request->title_lv,
                'excerpt' => $request->{"excerpt_$locale"} ?? $request->excerpt_lv,
                'content' => $request->{"content_$locale"} ?? $request->content_lv,
                'meta_title' => $request->{"meta_title_$locale"},
                'meta_description' => $request->{"meta_description_$locale"},
                'meta_keywords' => $request->{"meta_keywords_$locale"},
            ]);
        }
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }
    
    public function edit(Blog $blog)
    {
        $translations = $blog->translations->keyBy('locale');
        return view('backend.blogs.edit', compact('blog', 'translations'));
    }
    
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title_lv' => 'required|string|max:255',
            'excerpt_lv' => 'required',
            'content_lv' => 'required',
        ]);
        
        $blog->update([
            'slug' => Str::slug($request->title_lv),
            'is_published' => $request->boolean('is_published'),
            'sort_order' => $request->sort_order ?? 0,
        ]);
        
        if ($request->hasFile('preview_image')) {
            $path = $request->file('preview_image')->store('blogs', 'public');
            $blog->update(['preview_image' => $path]);
        }
        
        foreach (['lv', 'en', 'ru'] as $locale) {
            BlogTranslation::updateOrCreate(
                ['blog_id' => $blog->id, 'locale' => $locale],
                [
                    'title' => $request->{"title_$locale"} ?? $request->title_lv,
                    'excerpt' => $request->{"excerpt_$locale"} ?? $request->excerpt_lv,
                    'content' => $request->{"content_$locale"} ?? $request->content_lv,
                    'meta_title' => $request->{"meta_title_$locale"},
                    'meta_description' => $request->{"meta_description_$locale"},
                    'meta_keywords' => $request->{"meta_keywords_$locale"},
                ]
            );
        }
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }
    
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }
}