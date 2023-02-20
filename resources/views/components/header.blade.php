<header class="header-area header-style-1 header-height-2">
    {{--    <div class="mobile-promotion">--}}
    {{--        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>--}}
    {{--    </div>--}}
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>Offerte imperdibili pensate per te</li>
                                <li>Attrezzature per pasticceria</li>
                                <li>Packaging per le aziende, scopri le nostre offerte</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            {{--                            <li>Chiamaci: <strong class="text-brand ml-2"> (39) 075 517 21 22 </strong></li>--}}
                            <li>
                                <a class="language-dropdown-active">
                                    @if(app()->getLocale() == 'it')
                                        <img src="/assets/images/flags/ita.png" alt="ITA Flag" width="18" height="12"
                                             class="dropdown-image"/>
                                        ITALIANO <i
                                            class="fi-rs-angle-small-down"></i>
                                    @else
                                        <img src="/assets/images/flags/eng.png" alt="ENG Flag" width="18" height="12"
                                             class="dropdown-image"/> ENGLISH <i
                                            class="fi-rs-angle-small-down"></i>

                                    @endif
                                </a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle py-3 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{route('index')}}"><img
                            src="/uploads/logo/logo.png" alt="logo" style="height: 140px;width: 100%;object-fit: contain;"/></a>
                </div>
                <div class="header-right">
                    <livewire:search-users>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">

                                    @if(Auth::check())
                                        <a href="{{route('customerLogin')}}"><span
                                                class="lable ml-0"><img class="svgInject" alt="Livewire"
                                                                        src="/assets/imgs/theme/icons/icon-user.svg"/>{{ Auth::user()->billing_name }}</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <a href="#currency" class="notranslate"><i
                                                    class="w-icon-account"></i> </a>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('profile') }}"><i
                                                            class="fi fi-rs-user mr-10"></i>
                                                        {!!__('app.profile')!!}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('orders.index') }}">
                                                        <i class="fi fi-rs-settings-sliders mr-10"></i> {!!__('checkout.orders.0')!!}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                                        <i class="fi fi-rs-sign-out mr-10"></i> {!!__('app.logout')!!}
                                                    </a>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}"
                                                      method="POST"
                                                      class="d-none">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </div>
                                    @else
{{--                                        <a href="{{route('login')}}"><span--}}
{{--                                                class="lable ml-0"><img class="svgInject" alt="Livewire"--}}
{{--                                                                        src="/assets/imgs/theme/icons/icon-user.svg"/>Log in</span></a>--}}
{{--                                        <span class="delimiter d-lg-show">/</span>--}}
                                        {{--                                    <a href="{{route('register')}}"--}}
                                        {{--                                       class="ml-0 d-lg-show">Registrati</a>--}}
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{url('/')}}"><img src="/uploads/logo/logo.png" alt="logo" style="height: 71px;width: 100%;object-fit: contain;"/></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> <span class="et"></span> Categorie
                            <i class="fi-rs-angle-down"></i>
                        </a>

                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
                    <img src="/assets/imgs/theme/icons/icon-headphone.svg" alt="hotline"/>
                    <p>(33) 1612 234 34 <span style="margin-top:5px">24/7 Customer support</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{url('/')}}"><img src="/uploads/logo/logo.png" alt="logo"/></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
    </div>
</div>
