<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::where('is_published', true)->count();
        $recentBlogs = Blog::with('translations')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('backend.dashboard', compact('totalBlogs', 'publishedBlogs', 'recentBlogs'));
    }
}