@extends('frontend.layouts.app')

@section('content')
<main class="blog">
    <div class="container">
        @if($blog->preview_image)
            <img src="{{ asset('storage/' . $blog->preview_image) }}" class="full" alt="{{ $translation->title }}">
        @endif
        
        <h1>{{ $translation->title }}</h1>
        
        {!! $translation->content !!}
        
        <button>
            <a href="{{ route('blogs.index') }}">
                {{ __('messages.return_to_blogs') }}
            </a>
        </button>
    </div>
</main>
@endsection