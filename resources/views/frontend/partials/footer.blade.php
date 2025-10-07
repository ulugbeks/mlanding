<footer class="footer" id="contacts">
    <div class="footer__top">
        <ul class="container footer__top-container">
            <li class="footer__logo">
                <img src="{{ asset('assets/logo/dark.png') }}" alt="Rubenhair">
            </li>
            <li>
                <h3>{{ __('messages.for_communication') }}:</h3>
                <a href="tel:+37126777776">+371 267 777 76</a>
                <a href="mailto:info@rubenhair.eu">info@rubenhair.eu</a>
                <a href="https://www.rubenhair.eu">www.rubenhair.eu</a>
            </li>
            <li>
                <h3>{{ __('messages.contacts') }}:</h3>
                <p>Rubenhair Baltika SIA</p>
                <p>Reg. nr. 40103626380</p>
                <p>Republic Square 3</p>
                <p>Riga LV-1010, Latvia</p>
            </li>
            <li>
                <h3>{{ __('messages.opening_hours') }}:</h3>
                <p>{{ __('messages.mon_fri') }} 09:00 - 18:00</p>
                <p>{{ __('messages.weekend') }}</p>
            </li>
            <li>
                <h3>{{ __('messages.follow_us') }}:</h3>
                <div class="footer__socials">
                    <a href="#" style="--color: #1877f3;">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" style="--color: #1da1f2;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" style="--color: #e4405f;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="--color: #ea4335;">
                        <i class="fab fa-google"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <hr>
    <div class="footer__bottom">
        <div class="container footer__bottom-container">
            <p class="footer__label">
                ©{{ date('Y') }} Rubenhair. {{ __('messages.all_rights_reserved') }}
            </p>
            <p>
                <a href="https://github.com/thisSasha">by ThisDevSasha</a>
            </p>
        </div>
    </div>
</footer>