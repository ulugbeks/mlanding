@extends('frontend.layouts.app')

@section('content')
<header class="header">
    <div class="header__container">
        <p class="header__text">{{ __('messages.header_subtitle') }}</p>
        <hr class="header__hr">
        <h1 class="header__title">{{ __('messages.header_title') }}</h1>
        <p class="header__text">{{ __('messages.header_description') }}</p>
    </div>
</header>

<section class="consultation section-py" id="consultation">
    <div class="consultation__container">
        <h2 class="consultation__title">{{ __('messages.consultation_title') }}</h2>
        <form action="{{ route('consultation.submit') }}" method="POST">
            @csrf
            <div class="consultation__label">
                <label for="name">{{ __('messages.name_surname') }}</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="consultation__label">
                <label for="email">{{ __('messages.email') }}</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="consultation__label">
                <label for="phone">{{ __('messages.phone') }}</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <button type="submit" class="consultation__button">{{ __('messages.get_advice') }}</button>
        </form>
    </div>
</section>

<section class="about" id="about">
    <div class="about__container container">
        <div class="about__left">
            <img src="{{ asset('assets/index/about/1.png') }}" alt="About Rubenhair">
        </div>
        <div class="about__right">
            <h2 class="about__title">{{ __('messages.about_title') }}</h2>
            <p class="about__text">{{ __('messages.about_text') }}</p>
            <a href="#consultation" class="about__button">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ __('messages.get_advice') }}</span>
            </a>
        </div>
    </div>
</section>

<section class="applyfor" id="applyfor">
    <div class="container">
        <div class="applyfor__content">
            <h2 class="applyfor__title">{{ __('messages.book_consultation') }}</h2>
            <p class="applyfor__text">{{ __('messages.improve_quality') }}</p>
        </div>
        <div class="applyfor__number">
            <a href="tel:37126777776" class="applyfor__number">+371 267 777 76</a>
        </div>
    </div>
</section>

<section class="section-py services" id="services">
    <div class="container services__container">
        <h2 class="services__title">{{ __('messages.procedures') }}</h2>
        <hr>
        <p class="services__text">{{ __('messages.services_description') }}</p>
        <div class="services__grid">
            @foreach(__('services.items') as $key => $service)
            <div class="services__card">
                <div class="services__card-icon">
                    <img src="{{ asset('assets/index/services/' . ($key + 1) . '.png') }}" alt="{{ $service['title'] }}">
                </div>
                <h3 class="services__card-title">{{ $service['title'] }}</h3>
                <p class="services__card-text">{{ $service['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Reviews Section (same as original) -->
@include('frontend.partials.reviews')

<!-- Second consultation form -->
@include('frontend.partials.consultation-form')

@endsection