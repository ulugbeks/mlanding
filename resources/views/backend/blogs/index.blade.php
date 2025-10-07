@extends('backend.layouts.admin')

@section('title', 'Blog Management')

@section('content')
<div class="header">
    <h1>Blog Management</h1>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">+ Add New Blog</a>
</div>

<div class="content-box">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title (LV)</th>
                <th>Status</th>
                <th>Sort Order</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ optional($blog->translation('lv'))->title ?? 'No translation' }}</td>
                <td>
                    @if($blog->is_published)
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-warning">Draft</span>
                    @endif
                </td>
                <td>{{ $blog->sort_order }}</td>
                <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #999;">No blogs found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($blogs->hasPages())
        <div style="margin-top: 20px;">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
@endsection
