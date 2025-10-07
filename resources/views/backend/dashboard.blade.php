@extends('backend.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="header">
    <h1>Dashboard</h1>
    <span>Welcome to Rubenhair Admin Panel</span>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
    <div class="content-box" style="text-align: center;">
        <h2 style="color: #3498db; font-size: 48px; margin-bottom: 10px;">{{ $totalBlogs ?? 0 }}</h2>
        <p>Total Blogs</p>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary" style="margin-top: 15px;">Manage Blogs</a>
    </div>
    
    <div class="content-box" style="text-align: center;">
        <h2 style="color: #2ecc71; font-size: 48px; margin-bottom: 10px;">{{ $publishedBlogs ?? 0 }}</h2>
        <p>Published Blogs</p>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success" style="margin-top: 15px;">Create New</a>
    </div>
    
    <div class="content-box" style="text-align: center;">
        <h2 style="color: #e74c3c; font-size: 48px; margin-bottom: 10px;">3</h2>
        <p>Languages</p>
        <a href="{{ route('admin.seo.index') }}" class="btn btn-primary" style="margin-top: 15px;">SEO Settings</a>
    </div>
</div>

<div class="content-box" style="margin-top: 30px;">
    <h3 style="margin-bottom: 20px;">Recent Blogs</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentBlogs ?? [] as $blog)
            <tr>
                <td>{{ optional($blog->translation('lv'))->title ?? 'No title' }}</td>
                <td>
                    @if($blog->is_published)
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-warning">Draft</span>
                    @endif
                </td>
                <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; color: #999;">No blogs yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection