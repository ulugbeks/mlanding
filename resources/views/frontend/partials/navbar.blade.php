<nav class="navbar">
    <div class="container navbar__container">
        <button class="navbar__burger" aria-label="Open menu" aria-expanded="false" aria-controls="navbar-menu">
            <span></span><span></span><span></span>
        </button>
        
        <div class="navbar__logo">
            <img src="{{ asset('assets/logo/dark.png') }}" alt="Rubenhair">
        </div>
        
        <div class="navbar__links">
            <a class="navbar__link" href="{{ LaravelLocalization::localizeUrl('/') }}">{{ __('messages.main') }}</a>
            <a class="navbar__link" href="{{ LaravelLocalization::localizeUrl('/#about') }}">{{ __('messages.about') }}</a>
            <a class="navbar__link" href="{{ LaravelLocalization::localizeUrl('/#service') }}">{{ __('messages.services') }}</a>
            <a class="navbar__link" href="{{ LaravelLocalization::localizeUrl('/#reviews') }}">{{ __('messages.reviews') }}</a>
            <a class="navbar__link" href="{{ LaravelLocalization::localizeUrl('/blogs') }}">{{ __('messages.blog') }}</a>
            <a class="navbar__link" href="{{ LaravelLocalization::localizeUrl('/#contacts') }}">{{ __('messages.contacts') }}</a>
        </div>
        
        <div class="navbar__extras">
            <div class="navbar__contact">+371 267 777 76</div>
            <div class="navbar__language">
                <div class="select">
                    <img src="{{ asset('assets/langs/' . LaravelLocalization::getCurrentLocale() . '.png') }}" alt="">
                </div>
                <div class="options">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="option">
                            <img src="{{ asset('assets/langs/' . $localeCode . '.png') }}" alt="{{ $properties['native'] }}">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div id="navbar-menu" class="navbar__menu" aria-hidden="true">
        <button class="navbar__close" aria-label="Close menu"></button>
    </div>
    
    <div class="navbar__overlay"></div>
</nav>