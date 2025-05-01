<?php
// Getting the 'enabled' sections ONLY and their child categories (using the 'categories' relationship method) which, in turn, include their 'subcategories`
$sections = \App\Models\Section::sections();
// dd($sections);
?>


<!-- Header -->
<header>
    <div class="w-full text-dark text-sm h-10 flex items-center text-center justify-center fixed top-0 z-50 font-bold"
        style="background-color: #ffffff; font-weight: bold; font-size: 14px ;"><span class="flex items-center"
            style="font-size: 18px">🛒</span> KAPITON IS IN EARLY DEVELOPMENT</div>
    <div data-elementor-type="header" data-elementor-id="34" class="elementor elementor-34 elementor-location-header"
        data-elementor-post-type="elementor_library">
        <div class="elementor-element elementor-element-76c1337 e-flex e-con-boxed e-con e-parent" data-id="76c1337"
            data-element_type="container"
            data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;&quot;:&quot;top&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;,&quot;&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;&quot;:0,&quot;&quot;:0}"
            data-core-v316-plus="true">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-bc5c742 e-con-full e-flex e-con e-child"
                    data-id="bc5c742" data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}">
                    <div class="elementor-element elementor-element-b943b73 elementor-widget elementor-widget-theme-site-logo elementor-widget-image"
                        data-id="b943b73" data-element_type="widget" data-widget_type="theme-site-logo.default">
                        <div class="elementor-widget-container">
                            <style>
                                /*! elementor - v3.18.0 - 08-12-2023 */
                                .elementor-widget-image {
                                    text-align: center
                                }

                                .elementor-widget-image a {
                                    display: inline-block
                                }

                                .elementor-widget-image a img[src$=".svg"] {
                                    width: 48px
                                }

                                .elementor-widget-image img {
                                    vertical-align: middle;
                                    display: inline-block
                                }
                            </style>
                            <a href="/">
                                <img width="154" height="34"
                                    src="{{ $getImage('front/images/main-logo/', '2023-12-logo-white-text.png') }}"
                                    class="attachment-full size-full wp-image-21" alt=""
                                    srcset="{{ $getImage('front/images/main-logo/', '2023-12-logo-white-text.png') }} 154w, {{ $getImage('front/images/main-logo/', '2023-12-logo-white-text.png') }} 150w"
                                    sizes="(max-width: 154px) 100vw, 154px">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-75e2d37 e-con-full e-flex e-con e-child"
                    data-id="75e2d37" data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}">
                    <div class="elementor-element elementor-element-5c8c1a4 elementor-nav-menu--stretch elementor-nav-menu__align-center elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu"
                        data-id="5c8c1a4" data-element_type="widget"
                        data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;submenu_icon&quot;:{&quot;value&quot;:&quot;&lt;svg class=\&quot;e-font-icon-svg e-fas-caret-down\&quot; viewBox=\&quot;0 0 320 512\&quot; xmlns=\&quot;http:\/\/www.w3.org\/2000\/svg\&quot;&gt;&lt;path d=\&quot;M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z\&quot;&gt;&lt;\/path&gt;&lt;\/svg&gt;&quot;,&quot;library&quot;:&quot;fa-solid&quot;},&quot;toggle&quot;:&quot;burger&quot;}"
                        data-widget_type="nav-menu.default">
                        <div class="elementor-widget-container">
                            <link rel="stylesheet"
                                href="{{ url('front/css/elementor-css/elementor-pro-assets-css-widget-nav-menu.min.css') }}">
                            <nav
                                class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-none">
                                <ul id="menu-1-5c8c1a4" class="elementor-nav-menu">
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-38">
                                        <a href="/" aria-current="page"
                                            class="elementor-item elementor-item-active">HOME</a>
                                    </li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39">
                                        <a href="{{ url('products/collection/all') }}"
                                            class="elementor-item">PRODUCTS</a>
                                    </li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-40">
                                        <a href="{{ url('merchants') }}" class="elementor-item">MERCHANTS</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Menu Toggle"
                                aria-expanded="false">
                                <svg aria-hidden="true" role="presentation"
                                    class="elementor-menu-toggle__icon--open e-font-icon-svg e-eicon-menu-bar"
                                    viewbox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M104 333H896C929 333 958 304 958 271S929 208 896 208H104C71 208 42 237 42 271S71 333 104 333ZM104 583H896C929 583 958 554 958 521S929 458 896 458H104C71 458 42 487 42 521S71 583 104 583ZM104 833H896C929 833 958 804 958 771S929 708 896 708H104C71 708 42 737 42 771S71 833 104 833Z">
                                    </path>
                                </svg>
                                <svg aria-hidden="true" role="presentation"
                                    class="elementor-menu-toggle__icon--close e-font-icon-svg e-eicon-close"
                                    viewbox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M742 167L500 408 258 167C246 154 233 150 217 150 196 150 179 158 167 167 154 179 150 196 150 212 150 229 154 242 171 254L408 500 167 742C138 771 138 800 167 829 196 858 225 858 254 829L496 587 738 829C750 842 767 846 783 846 800 846 817 842 829 829 842 817 846 804 846 783 846 767 842 750 829 737L588 500 833 258C863 229 863 200 833 171 804 137 775 137 742 167Z">
                                    </path>
                                </svg>
                                <span class="elementor-screen-only">Menu</span>
                            </div>
                            <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" aria-hidden="true">
                                <ul id="menu-2-5c8c1a4" class="elementor-nav-menu">
                                    <li
                                        class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-38">
                                        <a href="/" aria-current="page"
                                            class="elementor-item elementor-item-active" tabindex="-1">HOME</a>
                                    </li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-39">
                                        <a href="{{ url('products/collection/all') }}" class="elementor-item"
                                            tabindex="-1">PRODUCTS</a>
                                    </li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-40">
                                        <a href="{{ url('merchants') }}" class="elementor-item"
                                            tabindex="-1">MERCHANTS</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-5e32e32 e-con-full e-flex e-con e-child"
                    data-id="5e32e32" data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}">
                    <div class="elementor-element elementor-element-8e30943 elementor-search-form--skin-full_screen elementor-hidden-desktop elementor-hidden-tablet elementor-widget elementor-widget-search-form"
                        data-id="8e30943" data-element_type="widget"
                        data-settings="{&quot;skin&quot;:&quot;full_screen&quot;}"
                        data-widget_type="search-form.default">
                        <div class="elementor-widget-container">
                            <link rel="stylesheet"
                                href="{{ url('front/css/elementor-css/elementor-pro-assets-css-widget-theme-elements.min.css') }}">
                            <search role="search" class="custom_class_search">
                                <form class="elementor-search-form" action="{{ url('products/search') }}"
                                    method="get">
                                    <div class="elementor-search-form__toggle" tabindex="0" role="button">
                                        <div class="e-font-icon-svg-container">
                                            <svg aria-hidden="true" class="e-font-icon-svg e-fas-search"
                                                viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="elementor-screen-only">Search</span>
                                    </div>
                                    <div class="elementor-search-form__container">
                                        <label class="elementor-screen-only"
                                            for="elementor-search-form-8e30943">Search</label>
                                        <input id="elementor-search-form-8e30943" placeholder="Search..."
                                            class="elementor-search-form__input" type="search" name="s"
                                            value="">
                                        <div class="dialog-lightbox-close-button dialog-close-button" role="button"
                                            tabindex="0">
                                            <svg aria-hidden="true" class="e-font-icon-svg e-eicon-close"
                                                viewbox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M742 167L500 408 258 167C246 154 233 150 217 150 196 150 179 158 167 167 154 179 150 196 150 212 150 229 154 242 171 254L408 500 167 742C138 771 138 800 167 829 196 858 225 858 254 829L496 587 738 829C750 842 767 846 783 846 800 846 817 842 829 829 842 817 846 804 846 783 846 767 842 750 829 737L588 500 833 258C863 229 863 200 833 171 804 137 775 137 742 167Z">
                                                </path>
                                            </svg>
                                            <span class="elementor-screen-only">Close this search box.</span>
                                        </div>
                                    </div>
                                </form>
                            </search>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-7cd9cbb elementor-hidden-tablet elementor-hidden-mobile elementor-widget elementor-widget-heading"
                        data-id="7cd9cbb" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container header-links-custom">
                            <style>
                                /*! elementor - v3.18.0 - 08-12-2023 */
                                .elementor-heading-title {
                                    padding: 0;
                                    margin: 0;
                                    line-height: 1
                                }

                                .elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a {
                                    color: inherit;
                                    font-size: inherit;
                                    line-height: inherit
                                }

                                .elementor-widget-heading .elementor-heading-title.elementor-size-small {
                                    font-size: 15px
                                }

                                .elementor-widget-heading .elementor-heading-title.elementor-size-medium {
                                    font-size: 19px
                                }

                                .elementor-widget-heading .elementor-heading-title.elementor-size-large {
                                    font-size: 29px
                                }

                                .elementor-widget-heading .elementor-heading-title.elementor-size-xl {
                                    font-size: 39px
                                }

                                .elementor-widget-heading .elementor-heading-title.elementor-size-xxl {
                                    font-size: 59px
                                }

                                .header-links-custom {
                                    display: flex;
                                    gap: 20px;
                                }
                            </style>
                            <h6 class="elementor-heading-title elementor-size-default"><a
                                    href="{{ url('become-merchant') }}">Become a Seller</a></h6>
                            <h6 class="elementor-heading-title elementor-size-default">
                                {{-- If the user is authenticated/logged in, show 'My Account', if not, show 'Login/Register' --}}
                                @if (\Illuminate\Support\Facades\Auth::check())
                                    {{-- Determining If The Current User Is Authenticated: https://laravel.com/docs/9.x/authentication#determining-if-the-current-user-is-authenticated --}}
                                    <a class="my-account-link" href="{{ url('user/account') }}">My Account</a>
                                    <ul class="my-account-sub-menu">
                                        <li><a href="{{ url('user/account') }}">Profile</a></li>
                                        <li><a href="{{ url('user/orders') }}">Order List</a></li>
                                        <li><a href="{{ url('user/chats') }}">Chats</a></li>
                                        <li><a href="{{ url('user/logout') }}">Log out</a></li>
                                    </ul>
                                @else
                                    <a href="{{ url('user/login-register') }}">Login / Register</a>
                                @endif
                            </h6>

                        </div>
                    </div>
                    <div class="elementor-element elementor-element-8e0493b elementor-view-default elementor-widget elementor-widget-icon"
                        data-id="8e0493b" data-element_type="widget" data-widget_type="icon.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-icon-wrapper">
                                <div class="elementor-icon">
                                    <a id="mini-cart-trigger" {{-- href="{{ url('cart') }}" --}}>
                                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-shopping-bag"
                                            viewbox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M352 160v-32C352 57.42 294.579 0 224 0 153.42 0 96 57.42 96 128v32H0v272c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V160h-96zm-192-32c0-35.29 28.71-64 64-64s64 28.71 64 64v32H160v-32zm160 120c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24zm-192 0c-13.255 0-24-10.745-24-24s10.745-24 24-24 24 10.745 24 24-10.745 24-24 24z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="elementor-element elementor-element-41706f1 e-flex e-con-boxed e-con e-parent" data-id="41706f1"
            data-element_type="container"
            data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;&quot;:&quot;top&quot;,&quot;&quot;:86,&quot;sticky_offset_tablet&quot;:77,&quot;sticky_offset_mobile&quot;:73,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_effects_offset&quot;:0}"
            data-core-v316-plus="true">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-faa2ff7 e-con-full e-flex e-con e-child"
                    data-id="faa2ff7" data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}">
                    <div class="elementor-element elementor-element-ba4b160 elementor-nav-menu__align-center elementor-nav-menu--dropdown-none elementor-widget__width-auto elementor-widget-mobile__width-inherit elementor-widget elementor-widget-nav-menu"
                        data-id="ba4b160" data-element_type="widget"
                        data-settings="{&quot;layout&quot;:&quot;horizontal&quot;,&quot;submenu_icon&quot;:{&quot;value&quot;:&quot;&lt;svg class=\&quot;e-font-icon-svg e-fas-caret-down\&quot; viewBox=\&quot;0 0 320 512\&quot; xmlns=\&quot;http:\/\/www.w3.org\/2000\/svg\&quot;&gt;&lt;path d=\&quot;M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z\&quot;&gt;&lt;\/path&gt;&lt;\/svg&gt;&quot;,&quot;library&quot;:&quot;fa-solid&quot;}}"
                        data-widget_type="nav-menu.default">
                        <div class="elementor-widget-container">
                            <nav
                                class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-underline e--animation-fade">
                                <ul id="menu-1-ba4b160" class="elementor-nav-menu">
                                    @foreach ($sections as $section)
                                        <li
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-41">
                                            <a href="{{ url('products/collection/' . strtolower($section['name'])) }}"
                                                class="elementor-item">{{ $section['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                            <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container"
                                aria-hidden="true">
                                <ul id="menu-2-ba4b160" class="elementor-nav-menu">
                                    @foreach ($sections as $section)
                                        <li
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-41">
                                            <a href="{{ url('products/collection/' . strtolower($section['name'])) }}"
                                                class="elementor-item" tabindex="-1">{{ $section['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-c6d33de e-flex e-con-boxed e-con e-child"
                    data-id="c6d33de" data-element_type="container"
                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-31363e9 elementor-search-form--skin-full_screen elementor-hidden-mobile elementor-widget elementor-widget-search-form"
                            data-id="31363e9" data-element_type="widget"
                            data-settings="{&quot;skin&quot;:&quot;full_screen&quot;}"
                            data-widget_type="search-form.default">
                            <div class="elementor-widget-container">
                                <search role="search" class="custom_class_search">
                                    <form class="elementor-search-form" action="{{ url('products/search') }}"
                                        method="get">
                                        <div class="elementor-search-form__toggle" tabindex="0" role="button">
                                            <div class="e-font-icon-svg-container">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-search"
                                                    viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <span class="elementor-screen-only">Search</span>
                                        </div>
                                        <div class="elementor-search-form__container">
                                            <label class="elementor-screen-only"
                                                for="elementor-search-form-31363e9">Search</label>
                                            <input id="elementor-search-form-31363e9" placeholder="Search..."
                                                class="elementor-search-form__input" type="search" name="search"
                                                value="">
                                            <div class="dialog-lightbox-close-button dialog-close-button"
                                                role="button" tabindex="0">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-eicon-close"
                                                    viewbox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M742 167L500 408 258 167C246 154 233 150 217 150 196 150 179 158 167 167 154 179 150 196 150 212 150 229 154 242 171 254L408 500 167 742C138 771 138 800 167 829 196 858 225 858 254 829L496 587 738 829C750 842 767 846 783 846 800 846 817 842 829 829 842 817 846 804 846 783 846 767 842 750 829 737L588 500 833 258C863 229 863 200 833 171 804 137 775 137 742 167Z">
                                                    </path>
                                                </svg>
                                                <span class="elementor-screen-only">Close this search box.</span>
                                            </div>
                                        </div>
                                    </form>
                                </search>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-a9bf2d7 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                            data-id="a9bf2d7" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                                <link rel="stylesheet"
                                    href="{{ url('front/css/elementor-css/elementor-assets-css-widget-icon-list.min.css') }}">
                                <ul class="elementor-icon-list-items">
                                    <li class="elementor-icon-list-item">
                                        @if (Auth::check())
                                            <span class="elementor-icon-list-icon">
                                                <a href="{{ url('user/account') }}">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-far-user"
                                                        viewbox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </span>
                                            <span class="elementor-icon-list-text">{{ Auth::user()->first_name }}
                                                {{ Auth::user()->last_name }}</span>
                                        @else
                                            <span class="elementor-icon-list-icon">
                                                <a href="{{ url('user/login-register') }}">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-user-lock"
                                                        viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M224 256A128 128 0 1 0 96 128a128 128 0 0 0 128 128zm96 64a63.08 63.08 0 0 1 8.1-30.5c-4.8-.5-9.5-1.5-14.5-1.5h-16.7a174.08 174.08 0 0 1-145.8 0h-16.7A134.43 134.43 0 0 0 0 422.4V464a48 48 0 0 0 48 48h280.9a63.54 63.54 0 0 1-8.9-32zm288-32h-32v-80a80 80 0 0 0-160 0v80h-32a32 32 0 0 0-32 32v160a32 32 0 0 0 32 32h224a32 32 0 0 0 32-32V320a32 32 0 0 0-32-32zM496 432a32 32 0 1 1 32-32 32 32 0 0 1-32 32zm32-144h-64v-80a32 32 0 0 1 64 0z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom-Header /- -->

    <!-- Mini Cart Widget -->
    <div id="appendHeaderCartItems"> {{-- We created the CSS class 'appendHeaderCartItems' to use it in front/js/custom.js to update the total cart items via AJAX in the Mini Cart Wedget, because in pages that we originally use AJAX to update the cart items (such as when we delete a cart item in http://127.0.0.1:8000/cart using AJAX), the number doesn't change in the header automatically because AJAX is already used and no page reload/refresh has occurred --}}
        @include('front.layout.header_cart_items')
    </div>
    <!-- Mini Cart Widget /- -->
</header>
<!-- Header /- -->

<style>
    header {
        position: relative;
        width: 100%;
        z-index: 999;
        transition: transform 0.5s ease, opacity 0.3s ease;
        /* Matched opacity duration */
        transform-origin: top;
    }

    header.header-fixed {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transform: translateY(0);
        opacity: 1;
    }

    header.header-fixed.header-hidden {
        transform: translateY(-100%);
        opacity: 0;
        pointer-events: none;
    }

    /* Temporary class to disable transitions for instant state changes */
    header.no-transition {
        transition: none !important;
    }

    body {
        padding-top: 0 !important;
    }

    .header-placeholder {
        box-sizing: border-box;
    }


    .mini-cart-wrapper {
        position: fixed;
        top: 0;
        right: 0;
        height: 100%;
        z-index: 9999;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        pointer-events: none;
        background-color: white;
        width: 300px;
        overflow-y: auto;
        max-width: 90%;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    }

    .mini-cart-wrapper.mini-cart-open {
        transform: translateX(0);
        pointer-events: auto;
    }

    .cart-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9990;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .cart-overlay.overlay-active {
        opacity: 1;
        visibility: visible;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('header');
        if (!header) return;

        let lastScrollTop = 0;
        let initialH = header.offsetHeight;
        let manageTh = initialH + 30;
        const deltaTh = 5;

        let ticking = false;

        const cartOverlay = document.createElement('div');
        cartOverlay.classList.add('cart-overlay');
        document.body.appendChild(cartOverlay);

        const headerPlaceholder = document.createElement('div');
        headerPlaceholder.classList.add('header-placeholder');
        headerPlaceholder.style.height = '0';
        headerPlaceholder.style.display = 'none';
        headerPlaceholder.style.boxSizing = 'border-box';
        if (header.nextSibling) {
            header.parentNode.insertBefore(headerPlaceholder, header.nextSibling);
        } else {
            header.parentNode.appendChild(headerPlaceholder);
        }


        const handleScroll = () => {
            const currentScroll = window.scrollY || document.documentElement.scrollTop;
            const scrollDelta = currentScroll - lastScrollTop;

            const isScrollingDown = scrollDelta > deltaTh;
            const isScrollingUp = scrollDelta < -deltaTh;

            const hasScrolledPastThreshold = currentScroll > manageTh;
            const isAtOrAboveThreshold = currentScroll <= manageTh;

            const isCurrentlyFixed = header.classList.contains('header-fixed');

            const isGoingFixedAndHidden = hasScrolledPastThreshold && !isCurrentlyFixed && (
                isScrollingDown || currentScroll > lastScrollTop);
            const isGoingFixedAndVisible = hasScrolledPastThreshold && !isCurrentlyFixed && !(
                isScrollingDown || currentScroll > lastScrollTop);
            const isGoingRelative = isAtOrAboveThreshold && isCurrentlyFixed;
            const isTogglingHiddenWhileFixed = isCurrentlyFixed && hasScrolledPastThreshold && (
                isScrollingDown || isScrollingUp);


            if (isGoingFixedAndHidden) {
                const currentHeaderHeight = header.offsetHeight;
                headerPlaceholder.style.height = currentHeaderHeight + 'px';
                headerPlaceholder.style.display = 'block';

                header.classList.add('no-transition');
                header.classList.add('header-fixed');
                header.classList.add('header-hidden');

                requestAnimationFrame(() => {
                    header.classList.remove('no-transition');
                });

            } else if (isGoingFixedAndVisible) {
                const currentHeaderHeight = header.offsetHeight;
                headerPlaceholder.style.height = currentHeaderHeight + 'px';
                headerPlaceholder.style.display = 'block';

                header.classList.remove('header-hidden');
                header.classList.add('header-fixed');
                header.classList.remove('no-transition');


            } else if (isGoingRelative) {
                header.classList.remove('no-transition');
                header.classList.remove('header-fixed', 'header-hidden');
                headerPlaceholder.style.height = '0';
                headerPlaceholder.style.display = 'none';

            } else if (isTogglingHiddenWhileFixed) {
                header.classList.remove('no-transition');

                if (isScrollingDown) {
                    header.classList.add('header-hidden');
                } else if (isScrollingUp) {
                    header.classList.remove('header-hidden');
                }
            }
            if (isCurrentlyFixed && isAtOrAboveThreshold) {
                header.classList.remove('header-hidden');
                header.classList.remove('no-transition');
            }


            lastScrollTop = Math.max(currentScroll, 0);
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(handleScroll);
                ticking = true;
            }
        });

        handleScroll();

        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                const wasFixed = header.classList.contains('header-fixed');
                const wasHidden = header.classList.contains('header-hidden');

                if (wasFixed) {
                    header.classList.remove('header-fixed');
                }
                if (wasHidden) {
                    header.classList.remove('header-hidden');
                }

                initialH = header.offsetHeight;
                manageTh = initialH + 30;

                if (wasFixed) {
                    header.classList.add('header-fixed');
                    headerPlaceholder.style.height = initialH + 'px';
                }

                handleScroll();

            }, 150);
        });

        function bindCartEvents() {
            if (typeof $ === 'function') {
                $('body').on('click', '#mini-cart-close', function(e) {
                    e.preventDefault();
                    $('.mini-cart-wrapper').removeClass('mini-cart-open');
                    cartOverlay.classList.remove('overlay-active');
                });

                $('body').on('click', '#mini-cart-trigger', function(e) {
                    e.preventDefault();
                    $('.mini-cart-wrapper').addClass('mini-cart-open');
                    cartOverlay.classList.add('overlay-active');
                });

                $(cartOverlay).on('click', function() {
                    $('.mini-cart-wrapper').removeClass('mini-cart-open');
                    cartOverlay.classList.remove('overlay-active');
                });
            } else {
                const miniCartWrapper = document.querySelector('.mini-cart-wrapper');
                document.body.addEventListener('click', function(event) {
                    if (event.target && (event.target.id === 'mini-cart-close' || event.target.closest(
                            '#mini-cart-close'))) {
                        event.preventDefault();
                        if (miniCartWrapper) {
                            miniCartWrapper.classList.remove('mini-cart-open');
                            cartOverlay.classList.remove('overlay-active');
                        }
                    }

                    if (event.target && (event.target.id === 'mini-cart-trigger' || event.target
                            .closest('#mini-cart-trigger'))) {
                        event.preventDefault();
                        if (miniCartWrapper) {
                            miniCartWrapper.classList.add('mini-cart-open');
                            cartOverlay.classList.add('overlay-active');
                        }
                    }
                });

                cartOverlay.addEventListener('click', function() {
                    if (miniCartWrapper) {
                        miniCartWrapper.classList.remove('mini-cart-open');
                        cartOverlay.classList.remove('overlay-active');
                    }
                });
            }
        }

        bindCartEvents();
    });
</script>

<!-- Mini Cart /- -->
<div class="mini-cart-wrapper">
    <div class="mini-cart">
        <div class="mini-cart-header">
            YOUR CART
            <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
        </div>
        <ul class="mini-cart-list">

            @php $total_price = 0 @endphp

            @php
                $getCartItems = getCartItems();
            @endphp

            @foreach ($getCartItems as $item)
                @php
                    $getDiscountAttributePrice = \App\Models\Product::getDiscountAttributePrice(
                        $item['product_id'],
                        $item['color'],
                        $item['size'],
                    );
                @endphp
                <li class="clearfix">
                    <a href="{{ url('product/' . $item['product_id']) }}">
                        <img src="{{ $getImage('front/images/product_images/small/', $item['product']['product_image']) }}"
                            alt="Product">
                        <span class="mini-item-name">{{ $item['product']['product_name'] }}</span>
                        <span
                            class="mini-item-price">₱{{ number_format($getDiscountAttributePrice['final_price'], 2) }}</span>
                        <span class="mini-item-quantity"> x {{ $item['quantity'] }} </span>
                    </a>
                </li>
                @php $total_price = $total_price + ($getDiscountAttributePrice['final_price'] * $item['quantity']) @endphp
            @endforeach

        </ul>
        <div class="mini-shop-total clearfix">
            <span class="mini-total-heading float-left">Total:</span>
            <span class="mini-total-price float-right">₱{{ number_format($total_price, 2) }}</span>
        </div>
        <div class="mini-action-anchors">
            <a href="{{ url('cart') }}" class="cart-anchor">View Cart</a>
            <a href="{{ url('checkout') }}" class="checkout-anchor">Checkout</a>
        </div>
    </div>
</div>
