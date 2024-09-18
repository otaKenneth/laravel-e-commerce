{{-- This page is rendered by index() method in Front/IndexController.php --}}
@extends('front.layout.layout')


@section('content')
<div data-elementor-type="wp-page" data-elementor-id="15" class="elementor elementor-15" data-elementor-post-type="page">
    <!-- Slider -->
    <div
        class="elementor-element elementor-element-ca69b15 e-flex e-con-boxed e-con e-parent"
        data-id="ca69b15"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-7ab35dc elementor-pagination-position-inside elementor-pagination-type-bullets elementor-arrows-position-inside elementor-widget elementor-widget-n-carousel"
                data-id="7ab35dc"
                data-element_type="widget"
                data-settings="{&quot;carousel_items&quot;:[{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;67bee37&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;564cfd1&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;c7f716d&quot;}],&quot;slides_to_show&quot;:&quot;1&quot;,&quot;slides_to_show_tablet&quot;:&quot;1&quot;,&quot;slides_to_show_mobile&quot;:&quot;1&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500,&quot;offset_sides&quot;:&quot;none&quot;,&quot;arrows&quot;:&quot;yes&quot;,&quot;pagination&quot;:&quot;bullets&quot;,&quot;image_spacing_custom&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;image_spacing_custom_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;image_spacing_custom_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                data-widget_type="nested-carousel.default"
            >
                <div class="elementor-widget-container">
                    <link rel="stylesheet" href="{{ url('front/css/elementor-css/elementor-pro-assets-css-widget-nested-carousel.min.css') }}">
                    <div class="e-n-carousel swiper" dir="ltr">
                        <div class="swiper-wrapper" aria-live="off">
                            <!-- slider -->
                            @foreach ($sliderBanners as $banner)
                            <div
                                class="swiper-slide"
                                data-slide="1"
                                role="group"
                                aria-roledescription="slide"
                                aria-label="1 of 3"
                            >
                                <div
                                    class="elementor-element elementor-element-dee8d3b e-grid e-con-boxed e-con e-child"
                                    data-id="dee8d3b"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;grid&quot;,&quot;grid_columns_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:2,&quot;sizes&quot;:[]},&quot;grid_columns_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;grid_rows_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;grid_rows_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:2,&quot;sizes&quot;:[]},&quot;content_width&quot;:&quot;boxed&quot;,&quot;grid_outline&quot;:&quot;yes&quot;,&quot;grid_columns_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;grid_rows_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_auto_flow&quot;:&quot;row&quot;,&quot;grid_auto_flow_tablet&quot;:&quot;row&quot;,&quot;grid_auto_flow_mobile&quot;:&quot;row&quot;}"
                                >
                                    <div class="e-con-inner hero-inner">
                                        
                                        <div
                                            class="elementor-element elementor-element-c9adeb5 elementor-invisible elementor-widget elementor-widget-image"
                                            data-id="c9adeb5"
                                            data-element_type="widget"
                                            data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}">
                                            <div class="elementor-widget-container">
                                                <img
                                                    fetchpriority="high"
                                                    decoding="async"
                                                    width="620"
                                                    height="620"
                                                    src="{{ $getImage('front/images/banner_images/', $banner['image']) }}"
                                                    class="aaaaaaaaaa attachment-large size-large wp-image-258"
                                                    alt=""
                                                    srcset="{{ $getImage('front/images/banner_images/', $banner['image']) }} 620w, {{ $getImage('front/images/banners/', $banner['image']) }} 300w, {{ $getImage('front/images/banners/', $banner['image']) }} 150w"
                                                    sizes="(max-width: 620px) 100vw, 620px"
                                                >
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- slider -->
                        </div>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-prev" role="button" tabindex="0">
                        <svg
                            aria-hidden="true"
                            class="e-font-icon-svg e-eicon-chevron-left"
                            viewbox="0 0 1000 1000"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-next" role="button" tabindex="0">
                        <svg
                            aria-hidden="true"
                            class="e-font-icon-svg e-eicon-chevron-right"
                            viewbox="0 0 1000 1000"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
                        </svg>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider /- -->

    <!-- Our top Categories -->
    <div
        class="elementor-element elementor-element-230bb8d e-flex e-con-boxed e-con e-parent"
        data-id="230bb8d"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-0aa242b elementor-widget__width-inherit elementor-invisible elementor-widget elementor-widget-heading"
                data-id="0aa242b"
                data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                data-widget_type="heading.default"
            >
                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default">OUR TOP CATEGORIES</h2>
                </div>
            </div>
            <div
                class="elementor-element elementor-element-9aa2de9 elementor-pagination-type-bullets elementor-arrows-position-inside elementor-pagination-position-outside elementor-invisible elementor-widget elementor-widget-n-carousel"
                data-id="9aa2de9"
                data-element_type="widget"
                data-settings="{&quot;carousel_items&quot;:[{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;1f25688&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;c1aa6cf&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;182661e&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;f350a64&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;3f6f84c&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;e0f2548&quot;}],&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;slides_to_show_tablet&quot;:&quot;2&quot;,&quot;slides_to_show_mobile&quot;:&quot;1&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500,&quot;offset_sides&quot;:&quot;none&quot;,&quot;arrows&quot;:&quot;yes&quot;,&quot;pagination&quot;:&quot;bullets&quot;,&quot;image_spacing_custom&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;image_spacing_custom_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;image_spacing_custom_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                data-widget_type="nested-carousel.default"
            >
                <div class="elementor-widget-container">
                    <div class="e-n-carousel swiper" dir="ltr">
                        <div class="swiper-wrapper" aria-live="off">
                            @foreach ($categories as $category)
                            <div
                                class="swiper-slide"
                                data-slide="{{ $category['id'] }}"
                                role="group"
                                aria-roledescription="slide"
                                aria-label="{{ $category['id'] }} of {{ count($categories) }}"
                            >
                                <div
                                    class="elementor-element elementor-element-57bcf2d e-flex e-con-boxed e-con e-child"
                                    data-id="57bcf2d"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner">
                                        <a
                                            class="elementor-element elementor-element-778c4e0 e-flex e-con-boxed e-con e-child"
                                            data-id="778c4e0"
                                            data-element_type="container"
                                            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                            href="{{ url('/products/category/' . $category['url']) }}"
                                        >
                                            <div class="e-con-inner">
                                                <div
                                                    class="elementor-element elementor-element-586c92f elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                                                    data-id="586c92f"
                                                    data-element_type="widget"
                                                    data-widget_type="heading.default"
                                                >
                                                    <div class="elementor-widget-container">
                                                        <h2 class="elementor-heading-title elementor-size-default">{{$category['category_name']}}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-prev" role="button" tabindex="0">
                        <svg
                            aria-hidden="true"
                            class="e-font-icon-svg e-eicon-chevron-left"
                            viewbox="0 0 1000 1000"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path>
                        </svg>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-next" role="button" tabindex="0">
                        <svg
                            aria-hidden="true"
                            class="e-font-icon-svg e-eicon-chevron-right"
                            viewbox="0 0 1000 1000"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path>
                        </svg>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our top Categories /- -->

    <!-- Who we Are? 
    <div
        class="elementor-element elementor-element-698ae04 e-flex e-con-boxed e-con e-parent"
        data-id="698ae04"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true">
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-733cff2 e-con-full e-flex e-con e-child"
                data-id="733cff2"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-cbaae6f elementor-invisible elementor-widget elementor-widget-heading"
                    data-id="cbaae6f"
                    data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;}"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h2 class="elementor-heading-title elementor-size-default">Who we are?
                            <br> How are we different?
                        </h2>
                    </div>
                </div>
                <div
                    id="ks-who-are-we"
                    class="elementor-element elementor-element-174cf2a elementor-widget__width-inherit elementor-invisible elementor-widget elementor-widget-text-editor"
                    data-id="174cf2a"
                    data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;}"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container"></div>
                </div>
                <div
                    class="elementor-element elementor-element-d7501db elementor-widget__width-auto elementor-invisible elementor-widget elementor-widget-button"
                    data-id="d7501db"
                    data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;}"
                    data-widget_type="button.default"
                >
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-button-link elementor-size-sm" href="#">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">LEARN MORE</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-element elementor-element-a51e797 e-con-full e-flex elementor-invisible e-con e-child"
                data-id="a51e797"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;background_background&quot;:&quot;slideshow&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;animation_mobile&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;background_slideshow_gallery&quot;:[],&quot;background_slideshow_loop&quot;:&quot;yes&quot;,&quot;background_slideshow_slide_duration&quot;:5000,&quot;background_slideshow_slide_transition&quot;:&quot;fade&quot;,&quot;background_slideshow_transition_duration&quot;:500}"
            >
                <div
                    class="elementor-element elementor-element-734e58c elementor-widget elementor-widget-video"
                    data-id="734e58c"
                    data-element_type="widget"
                    data-settings="{&quot;youtube_url&quot;:&quot;https:\/\/www.youtube.com\/watch?v=XHOmBV4js_E&quot;,&quot;show_image_overlay&quot;:&quot;yes&quot;,&quot;image_overlay&quot;:{&quot;url&quot;:&quot;./wp-content\/uploads\/2023\/12\/cheerful-business-people-1.png&quot;,&quot;id&quot;:365,&quot;size&quot;:&quot;&quot;,&quot;alt&quot;:&quot;&quot;,&quot;source&quot;:&quot;library&quot;},&quot;video_type&quot;:&quot;youtube&quot;,&quot;controls&quot;:&quot;yes&quot;}"
                    data-widget_type="video.default"
                >
                    <div class="elementor-widget-container">
                        <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-video .elementor-widget-container{overflow:hidden;transform:translateZ(0)}.elementor-widget-video .elementor-wrapper{aspect-ratio:var(--video-aspect-ratio)}.elementor-widget-video .elementor-wrapper iframe,.elementor-widget-video .elementor-wrapper video{height:100%;width:100%;display:flex;border:none;background-color:#000}@supports not (aspect-ratio:1/1){.elementor-widget-video .elementor-wrapper{position:relative;overflow:hidden;height:0;padding-bottom:calc(100% / var(--video-aspect-ratio))}.elementor-widget-video .elementor-wrapper iframe,.elementor-widget-video .elementor-wrapper video{position:absolute;top:0;right:0;bottom:0;left:0}}.elementor-widget-video .elementor-open-inline .elementor-custom-embed-image-overlay{position:absolute;top:0;right:0;bottom:0;left:0;background-size:cover;background-position:50%}.elementor-widget-video .elementor-custom-embed-image-overlay{cursor:pointer;text-align:center}.elementor-widget-video .elementor-custom-embed-image-overlay:hover .elementor-custom-embed-play i{opacity:1}.elementor-widget-video .elementor-custom-embed-image-overlay img{display:block;width:100%;aspect-ratio:var(--video-aspect-ratio);-o-object-fit:cover;object-fit:cover;-o-object-position:center center;object-position:center center}@supports not (aspect-ratio:1/1){.elementor-widget-video .elementor-custom-embed-image-overlay{position:relative;overflow:hidden;height:0;padding-bottom:calc(100% / var(--video-aspect-ratio))}.elementor-widget-video .elementor-custom-embed-image-overlay img{position:absolute;top:0;right:0;bottom:0;left:0}}.elementor-widget-video .e-hosted-video .elementor-video{-o-object-fit:cover;object-fit:cover}.e-con-inner>.elementor-widget-video,.e-con>.elementor-widget-video{width:var(--container-widget-width);--flex-grow:var(--container-widget-flex-grow)}</style>
                        <div class="elementor-wrapper elementor-open-inline">
                            <div class="elementor-video"></div>
                            <div class="elementor-custom-embed-image-overlay" style="background-image: url(./images/2023-12-cheerful-business-people-1.png);">
                                <div
                                    class="elementor-custom-embed-play"
                                    role="button"
                                    aria-label="Play Video"
                                    tabindex="0"
                                >
                                    <svg
                                        aria-hidden="true"
                                        class="e-font-icon-svg e-fas-play-circle"
                                        viewbox="0 0 512 512"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm115.7 272l-176 101c-15.8 8.8-35.7-2.5-35.7-21V152c0-18.4 19.8-29.8 35.7-21l176 107c16.4 9.2 16.4 32.9 0 42z"></path>
                                    </svg>
                                    <span class="elementor-screen-only">Play Video</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    Who we Are? /- -->

    <!-- Top Products -->
    @if (count($bestSellers) > 0)
    <div
        class="elementor-element elementor-element-943f922 e-flex e-con-boxed e-con e-parent"
        data-id="943f922"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-914ddf2 elementor-widget__width-inherit elementor-invisible elementor-widget elementor-widget-heading"
                data-id="914ddf2"
                data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                data-widget_type="heading.default"
            >
                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default">Our Top Products</h2>
                </div>
            </div>

            @foreach ($bestSellers as $product)
            @php
                $product_image_path = $getImage("front/images/product_images/small/", $product['product_image']);
            @endphp
            <div
                class="elementor-element elementor-element-6b25072 e-con-full e-flex elementor-invisible e-con e-child"
                data-id="6b25072"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-70c91c9 elementor-widget elementor-widget-image"
                    data-id="70c91c9"
                    data-element_type="widget"
                    data-widget_type="image.default"
                >
                    <div class="elementor-widget-container">
                        <a href="#">
                            <img
                                decoding="async"
                                width="329"
                                height="329"
                                src="{{ $product_image_path }}"
                                class="attachment-large size-large wp-image-386"
                                alt=""
                                srcset="{{ $product_image_path }} 329w, {{ $product_image_path }} 300w, {{ $product_image_path }} 150w"
                                sizes="(max-width: 329px) 100vw, 329px"
                            >
                        </a>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-178eb48 elementor-widget elementor-widget-text-editor"
                    data-id="178eb48"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <p>{{$product['product_name']}}</p>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-0624bb6 elementor-widget elementor-widget-heading"
                    data-id="0624bb6"
                    data-element_type="widget"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h2 class="elementor-heading-title elementor-size-default"> ₱{{number_format($product['product_price'], 2)}}</h2>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-f3f6e12 elementor-widget elementor-widget-button"
                    data-id="f3f6e12"
                    data-element_type="widget"
                    data-widget_type="button.default"
                >
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-button-link elementor-size-sm" href="{{url('product/'.$product['id'])}}">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">Order now</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    @endif
    <!-- Top Products /- -->

    <!-- Recently added -->
    <div
        class="elementor-element elementor-element-636e848 e-flex e-con-boxed e-con e-parent"
        data-id="636e848"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-9b04cf1 elementor-widget__width-inherit elementor-invisible elementor-widget elementor-widget-heading"
                data-id="9b04cf1"
                data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                data-widget_type="heading.default"
            >
                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default">RECENTLY ADDED</h2>
                </div>
            </div>
            <div
                class="elementor-element elementor-element-95c34ed elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                data-id="95c34ed"
                data-element_type="widget"
                data-widget_type="divider.default"
            >
                <div class="elementor-widget-container">
                    <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-divider{--divider-border-style:none;--divider-border-width:1px;--divider-color:#0c0d0e;--divider-icon-size:20px;--divider-element-spacing:10px;--divider-pattern-height:24px;--divider-pattern-size:20px;--divider-pattern-url:none;--divider-pattern-repeat:repeat-x}.elementor-widget-divider .elementor-divider{display:flex}.elementor-widget-divider .elementor-divider__text{font-size:15px;line-height:1;max-width:95%}.elementor-widget-divider .elementor-divider__element{margin:0 var(--divider-element-spacing);flex-shrink:0}.elementor-widget-divider .elementor-icon{font-size:var(--divider-icon-size)}.elementor-widget-divider .elementor-divider-separator{display:flex;margin:0;direction:ltr}.elementor-widget-divider--view-line_icon .elementor-divider-separator,.elementor-widget-divider--view-line_text .elementor-divider-separator{align-items:center}.elementor-widget-divider--view-line_icon .elementor-divider-separator:after,.elementor-widget-divider--view-line_icon .elementor-divider-separator:before,.elementor-widget-divider--view-line_text .elementor-divider-separator:after,.elementor-widget-divider--view-line_text .elementor-divider-separator:before{display:block;content:"";border-bottom:0;flex-grow:1;border-top:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--element-align-left .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-left .elementor-divider-separator:before{content:none}.elementor-widget-divider--element-align-left .elementor-divider__element{margin-left:0}.elementor-widget-divider--element-align-right .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-right .elementor-divider-separator:after{content:none}.elementor-widget-divider--element-align-right .elementor-divider__element{margin-right:0}.elementor-widget-divider:not(.elementor-widget-divider--view-line_text):not(.elementor-widget-divider--view-line_icon) .elementor-divider-separator{border-top:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--separator-type-pattern{--divider-border-style:none}.elementor-widget-divider--separator-type-pattern.elementor-widget-divider--view-line .elementor-divider-separator,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:after,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:before,.elementor-widget-divider--separator-type-pattern:not([class*=elementor-widget-divider--view]) .elementor-divider-separator{width:100%;min-height:var(--divider-pattern-height);-webkit-mask-size:var(--divider-pattern-size) 100%;mask-size:var(--divider-pattern-size) 100%;-webkit-mask-repeat:var(--divider-pattern-repeat);mask-repeat:var(--divider-pattern-repeat);background-color:var(--divider-color);-webkit-mask-image:var(--divider-pattern-url);mask-image:var(--divider-pattern-url)}.elementor-widget-divider--no-spacing{--divider-pattern-size:auto}.elementor-widget-divider--bg-round{--divider-pattern-repeat:round}.rtl .elementor-widget-divider .elementor-divider__text{direction:rtl}.e-con-inner>.elementor-widget-divider,.e-con>.elementor-widget-divider{width:var(--container-widget-width,100%);--flex-grow:var(--container-widget-flex-grow)}</style>
                    <div class="elementor-divider">
                        <span class="elementor-divider-separator"></span>
                    </div>
                </div>
            </div>

            <!-- Product list -->
            @foreach ($newProducts as $product)
            @php
                $product_image_path = $getImage("front/images/product_images/small/", $product['product_image']);
            @endphp
            <div
                class="elementor-element elementor-element-977d0d9 e-con-full e-flex elementor-invisible e-con e-child"
                data-id="977d0d9"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-bfbcc32 elementor-widget__width-inherit elementor-widget elementor-widget-image"
                    data-id="bfbcc32"
                    data-element_type="widget"
                    data-widget_type="image.default"
                >
                    <div class="elementor-widget-container">
                        <a href="{{ url('product/' . $product['id']) }}">
                            <img
                                loading="lazy"
                                decoding="async"
                                width="800"
                                height="968"
                                src="{{ $product_image_path }}"
                                class="attachment-large size-large wp-image-422"
                                alt=""
                                srcset="{{ $product_image_path }} 846w, {{ $product_image_path }} 248w, {{ $product_image_path }} 768w, {{ $product_image_path }} 879w"
                                sizes="(max-width: 800px) 100vw, 800px"
                            >
                        </a>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-2344262 elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                    data-id="2344262"
                    data-element_type="widget"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h2 class="elementor-heading-title elementor-size-default custom_h2_size">{{$product['product_name']}}</h2>
                    </div>
                </div>

                {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                @php
                    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                @endphp

                @if ($getDiscountPrice > 0) {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                <div
                    class="elementor-element elementor-element-1cd7c54 elementor-widget elementor-widget-text-editor"
                    data-id="1cd7c54"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <p> ₱{{$getDiscountPrice}}</p>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-fa07c3b elementor-widget elementor-widget-text-editor"
                    data-id="fa07c3b"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <em style="text-decoration: line-through;">₱{{number_format($product['product_price'], 2)}}</em>
                    </div>
                </div>
                @else
                <div
                    class="elementor-element elementor-element-1cd7c54 elementor-widget elementor-widget-text-editor"
                    data-id="1cd7c54"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <p> ₱{{number_format($product['product_price'], 2)}}</p>
                    </div>
                </div>
                @endif

                 <!-- Ratings -->
                 <div
                    class="custom_class_rating elementor-element elementor-element-036fcb9 elementor-widget elementor-widget-rating"
                    data-id="036fcb9"
                    data-element_type="widget"
                    data-widget_type="rating.default">
                    <div class="elementor-widget-container">
                        <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-rating{--e-rating-gap:0px;--e-rating-icon-font-size:16px;--e-rating-icon-color:#ccd6df;--e-rating-icon-marked-color:#f0ad4e;--e-rating-icon-marked-width:100%;--e-rating-justify-content:flex-start}.elementor-widget-rating .e-rating{display:flex;justify-content:var(--e-rating-justify-content)}.elementor-widget-rating .e-rating-wrapper{display:flex;justify-content:inherit;flex-direction:row;flex-wrap:wrap;width:-moz-fit-content;width:fit-content;margin-block-end:calc(0px - var(--e-rating-gap));margin-inline-end:calc(0px - var(--e-rating-gap))}.elementor-widget-rating .e-rating .e-icon{position:relative;margin-block-end:var(--e-rating-gap);margin-inline-end:var(--e-rating-gap)}.elementor-widget-rating .e-rating .e-icon-wrapper.e-icon-marked{--e-rating-icon-color:var(--e-rating-icon-marked-color);width:var(--e-rating-icon-marked-width);position:absolute;z-index:1;height:100%;left:0;top:0;overflow:hidden}.elementor-widget-rating .e-rating .e-icon-wrapper :is(i,svg){display:flex;flex-shrink:0}.elementor-widget-rating .e-rating .e-icon-wrapper i{font-size:var(--e-rating-icon-font-size);color:var(--e-rating-icon-color)}.elementor-widget-rating .e-rating .e-icon-wrapper svg{width:auto;height:var(--e-rating-icon-font-size);fill:var(--e-rating-icon-color)}
                        .custom_class_rating{
                            margin-left: auto;
                            margin-top: 5px;
                        }
                        .custom_class_rating label{
                            margin-right: 5px;
                        }
                        @media (max-width: 767px){
                            .custom_class_rating{
                                width: 100%;
                                margin-top: -10px;
                            }
                            
                        }
                        </style>
                        <div
                            class="e-rating"
                            itemtype="https://schema.org/Rating"
                            itemscope=""
                            itemprop="reviewRating"
                        >
                            <meta itemprop="worstRating" content="0">
                            <meta itemprop="bestRating" content="5">
                            <div
                                class="e-rating-wrapper"
                                itemprop="ratingValue"
                                content="4"
                                role="img"
                                aria-label="Rated 4 out of 5"
                            >
                              <label>{{ \App\Models\Rating::productRating($product['id']) }}</label>
                                <div class="e-icon">
                                    <div class="e-icon-wrapper e-icon-marked" style="">
                                        <svg
                                            aria-hidden="true"
                                            class="e-font-icon-svg e-eicon-star"
                                            viewbox="0 0 1000 1000"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                        </svg>
                                    </div>
                                    <div class="e-icon-wrapper e-icon-unmarked">
                                        <svg
                                            aria-hidden="true"
                                            class="e-font-icon-svg e-eicon-star"
                                            viewbox="0 0 1000 1000"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                        </svg>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            @endforeach
            <!-- Product list /- -->

        </div>
    </div>
    <!-- Recently added /- -->
</div>
@endsection