@extends('frontend.layouts.app')

@section('content')
<main class="blogs">
    <div class="container">
        <div class="blogs__cards">
            @foreach($blogs as $blog)
                @php
                    $translation = $blog->translation(app()->getLocale());
                @endphp
                @if($translation)
                <div class="blogs__card">
                    <a href="{{ route('blogs.show', $blog->slug) }}">
                        <div class="blogs__card-preview">
                            <img src="{{ asset('storage/' . $blog->preview_image) }}" alt="{{ $translation->title }}">
                        </div>
                        <h2 class="blogs__card-title">{{ $translation->title }}</h2>
                    </a>
                    <p class="blogs__card-description">{{ $translation->excerpt }}</p>
                </div>
                @if(!$loop->last)
                    <hr>
                @endif
                @endif
            @endforeach
        </div>
        
        <div class="blogs__sidebar">
            <div class="blogs__categories">
                <h2>{{ __('messages.categories') }}</h2>
                <a href="{{ route('blogs.index') }}">{{ __('messages.blog') }}</a>
                <a href="{{ route('blogs.index', ['category' => 'fue']) }}">FUE</a>
                <a href="{{ route('blogs.index', ['category' => 'transplantation']) }}">{{ __('messages.hair_transplantation') }}</a>
            </div>
            <div class="blogs__latest">
                <h2>{{ __('messages.latest_news') }}</h2>
                @foreach($latestBlogs ?? [] as $latest)
                    @php
                        $latestTranslation = $latest->translation(app()->getLocale());
                    @endphp
                    @if($latestTranslation)
                        <a href="{{ route('blogs.show', $latest->slug) }}">{{ $latestTranslation->title }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
    {{ $blogs->links() }}
</main>
@endsection