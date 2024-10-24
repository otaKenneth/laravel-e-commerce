{{-- Note: This page (view) is rendered by the checkout() method in the Front/ProductsController.php --}}
@extends('front.layout.layout')


@section('content')
<div
    data-elementor-type="wp-page"
    data-elementor-id="682"
    class="elementor elementor-682 row collection_outer"
    data-elementor-post-type="page"
>
    <div
        class="elementor-element elementor-element-a4dba70 e-flex e-con-boxed e-con e-parent"
        data-id="a4dba70"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-9ae396b elementor-widget__width-inherit elementor-invisible elementor-widget elementor-widget-heading"
                data-id="9ae396b"
                data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                data-widget_type="heading.default"
            >


                <div class="collection-wide-banner-image">
                    <img style="display: block; border-radius: 10px; width: 100%;" src="{{ $getImage("front/images/vendor/owl-carousel/dist/", 'vendor-banner.jpg') }}">
                </div>


                <div class="elementor-widget-container">
                    <h2 class="elementor-heading-title elementor-size-default">{{ $pageTitle }}</h2>
                </div>
            </div>
            <div
                class="elementor-element elementor-element-89b25a4 e-flex e-con-boxed elementor-invisible e-con e-child z-index-2 filter-outer"
                data-id="89b25a4"
                data-element_type="container"
                data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            >
                <div class="e-con-inner">
                    <div
                        class="elementor-element elementor-element-970c6e2 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                        data-id="970c6e2"
                        data-element_type="widget"
                        data-widget_type="heading.default"
                    >
                        <div class="elementor-widget-container mobile-height-auto">
                            <h5 class="elementor-heading-title elementor-size-default">{{ $collection->count() }} PRODUCTS </h5>
                        </div>
                    </div>
                    <div
                        class="collection-container collection-sort-by elementor-element elementor-element-353f84f elementor-widget__width-auto elementor-widget elementor-widget-html sort-outer-wrap"
                        data-id="353f84f"
                        data-element_type="widget"
                        data-widget_type="html.default"
                    >
                        <div class="elementor-widget-container">
                            <h6 style="margin-bottom: 4px; font-size: 12px;">Sort by:</h6>
                            <form id="form-collection-sortby" method="get">
                                <select id="sort_by" name="sortby">
                                    <option value="date-1">Date, new to old</option>
                                    <option value="date-2">Date, old to new</option>
                                    <option value="price-1">Price, low to high</option>
                                    <option value="price-2">Price, high to low</option>
                                    <option value="alphabetically-A">Alphabetically , A-Z</option>
                                    <option value="alphabetically-Z">Alphabetically , Z-A</option>
                                    <option value="rating">Best Selling</option>
                                </select>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div
                class="elementor-element elementor-element-d690bed elementor-widget-divider--view-line elementor-invisible elementor-widget elementor-widget-divider"
                data-id="d690bed"
                data-element_type="widget"
                data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                data-widget_type="divider.default"
            >
                <div class="elementor-widget-container">
                    <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-divider{--divider-border-style:none;--divider-border-width:1px;--divider-color:#0c0d0e;--divider-icon-size:20px;--divider-element-spacing:10px;--divider-pattern-height:24px;--divider-pattern-size:20px;--divider-pattern-url:none;--divider-pattern-repeat:repeat-x}.elementor-widget-divider .elementor-divider{display:flex}.elementor-widget-divider .elementor-divider__text{font-size:15px;line-height:1;max-width:95%}.elementor-widget-divider .elementor-divider__element{margin:0 var(--divider-element-spacing);flex-shrink:0}.elementor-widget-divider .elementor-icon{font-size:var(--divider-icon-size)}.elementor-widget-divider .elementor-divider-separator{display:flex;margin:0;direction:ltr}.elementor-widget-divider--view-line_icon .elementor-divider-separator,.elementor-widget-divider--view-line_text .elementor-divider-separator{align-items:center}.elementor-widget-divider--view-line_icon .elementor-divider-separator:after,.elementor-widget-divider--view-line_icon .elementor-divider-separator:before,.elementor-widget-divider--view-line_text .elementor-divider-separator:after,.elementor-widget-divider--view-line_text .elementor-divider-separator:before{display:block;content:"";border-bottom:0;flex-grow:1;border-top:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--element-align-left .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-left .elementor-divider-separator:before{content:none}.elementor-widget-divider--element-align-left .elementor-divider__element{margin-left:0}.elementor-widget-divider--element-align-right .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type{flex-grow:0;flex-shrink:100}.elementor-widget-divider--element-align-right .elementor-divider-separator:after{content:none}.elementor-widget-divider--element-align-right .elementor-divider__element{margin-right:0}.elementor-widget-divider:not(.elementor-widget-divider--view-line_text):not(.elementor-widget-divider--view-line_icon) .elementor-divider-separator{border-top:var(--divider-border-width) var(--divider-border-style) var(--divider-color)}.elementor-widget-divider--separator-type-pattern{--divider-border-style:none}.elementor-widget-divider--separator-type-pattern.elementor-widget-divider--view-line .elementor-divider-separator,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:after,.elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:before,.elementor-widget-divider--separator-type-pattern:not([class*=elementor-widget-divider--view]) .elementor-divider-separator{width:100%;min-height:var(--divider-pattern-height);-webkit-mask-size:var(--divider-pattern-size) 100%;mask-size:var(--divider-pattern-size) 100%;-webkit-mask-repeat:var(--divider-pattern-repeat);mask-repeat:var(--divider-pattern-repeat);background-color:var(--divider-color);-webkit-mask-image:var(--divider-pattern-url);mask-image:var(--divider-pattern-url)}.elementor-widget-divider--no-spacing{--divider-pattern-size:auto}.elementor-widget-divider--bg-round{--divider-pattern-repeat:round}.rtl .elementor-widget-divider .elementor-divider__text{direction:rtl}.e-con-inner>.elementor-widget-divider,.e-con>.elementor-widget-divider{width:var(--container-widget-width,100%);--flex-grow:var(--container-widget-flex-grow)}</style>
                    <div class="elementor-divider">
                        <span class="elementor-divider-separator"></span>
                    </div>
                </div>
            </div>

            <div class="filter_outer_container">
                @include('front.products.filters')
            </div>

            <div id="container-product_list" class="product_list_container">
                <!-- Start of product list -->
                @foreach ($collection as $product)
                @php
                    $product_image_path = $getImage("front/images/product_images/small/", $product['product_image']);
                @endphp
                <div
                    class="elementor-element elementor-element-80f00c9 e-con-full e-flex elementor-invisible e-con e-child single_product_card"
                    data-id="80f00c9"
                    data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;}">
                    <div
                        class="elementor-element elementor-element-757b9c4 elementor-widget__width-inherit elementor-widget elementor-widget-image"
                        data-id="757b9c4"
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
                        class="elementor-element elementor-element-826026e elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                        data-id="826026e"
                        data-element_type="widget"
                        data-widget_type="heading.default"
                    >
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">{{$product['product_name']}}</h2>
                        </div>
                    </div>
                    {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                    @php
                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                    @endphp

                    @if ($getDiscountPrice > 0)
                    {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
                    <div
                        class="elementor-element elementor-element-753d4d0 elementor-widget elementor-widget-text-editor"
                        data-id="753d4d0"
                        data-element_type="widget"
                        data-widget_type="text-editor.default"
                    >
                        <div class="elementor-widget-container">
                            <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#69727d;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}</style>
                            <p> ₱{{$getDiscountPrice}}</p>
                        </div>
                    </div>
                    <div
                        class="elementor-element elementor-element-725e6f0 elementor-widget elementor-widget-text-editor"
                        data-id="725e6f0"
                        data-element_type="widget"
                        data-widget_type="text-editor.default"
                    >
                        <div class="elementor-widget-container">
                            <em style="text-decoration: line-through;">₱{{$product['product_price']}}</em>
                        </div>
                    </div>
                    @else
                    <div
                        class="elementor-element elementor-element-753d4d0 elementor-widget elementor-widget-text-editor"
                        data-id="753d4d0"
                        data-element_type="widget"
                        data-widget_type="text-editor.default"
                    >
                        <div class="elementor-widget-container">
                            <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#69727d;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}</style>
                            <p> ₱{{$product['product_price']}}</p>
                        </div>
                    </div>
                    @endif

                    <div
                        class="elementor-element elementor-element-e6b737c e-flex e-con-boxed e-con e-child"
                        data-id="e6b737c"
                        data-element_type="container"
                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                    >
                        <div class="e-con-inner">
                            @if (isset($product['vendor']))
                            <a class="vendor__name" href="{{ url('products/vendor/' . $product->vendor->id) }}">
                                <div
                                    class="elementor-element elementor-element-a282fc6 e-con-full e-flex e-con e-child"
                                    data-id="a282fc6"
                                    data-element_type="container"
                                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                >
                                    <div
                                        class="elementor-element elementor-element-ad41e9d elementor-widget elementor-widget-image"
                                        data-id="ad41e9d"
                                        data-element_type="widget"
                                        data-widget_type="image.default"
                                    >
                                        <div class="elementor-widget-container">
                                            <img
                                                decoding="async"
                                                width="300"
                                                height="300"
                                                src="{{ $getImage('front/images/brand-logos/', '2023-12-user.png') }}"
                                                class="attachment-large size-large wp-image-423"
                                                alt=""
                                                srcset="{{ $getImage('front/images/brand-logos/', '2023-12-user.png') }} 300w, {{ $getImage('front/images/brand-logos/', '2023-12-user.png') }} 150w"
                                                sizes="(max-width: 300px) 100vw, 300px"
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-element elementor-element-67825cd elementor-widget elementor-widget-heading"
                                        data-id="67825cd"
                                        data-element_type="widget"
                                        data-widget_type="heading.default"
                                    >
                                        <div class="elementor-widget-container">
                                            <h5 class="elementor-heading-title elementor-size-default">{{ $product->vendor->name ?? "" }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endif

                            <!-- Ratings -->
                            <div
                                class="elementor-element elementor-element-036fcb9 elementor-widget elementor-widget-rating css_seller_rating"
                                data-id="036fcb9"
                                data-element_type="widget"
                                data-widget_type="rating.default"
                            >
                                <div class="elementor-widget-container">
                                    <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-rating{--e-rating-gap:0px;--e-rating-icon-font-size:16px;--e-rating-icon-color:#ccd6df;--e-rating-icon-marked-color:#f0ad4e;--e-rating-icon-marked-width:100%;--e-rating-justify-content:flex-start}.elementor-widget-rating .e-rating{display:flex;justify-content:var(--e-rating-justify-content)}.elementor-widget-rating .e-rating-wrapper{display:flex;justify-content:inherit;flex-direction:row;flex-wrap:wrap;width:-moz-fit-content;width:fit-content;margin-block-end:calc(0px - var(--e-rating-gap));margin-inline-end:calc(0px - var(--e-rating-gap))}.elementor-widget-rating .e-rating .e-icon{position:relative;margin-block-end:var(--e-rating-gap);margin-inline-end:var(--e-rating-gap)}.elementor-widget-rating .e-rating .e-icon-wrapper.e-icon-marked{--e-rating-icon-color:var(--e-rating-icon-marked-color);width:var(--e-rating-icon-marked-width);position:absolute;z-index:1;height:100%;left:0;top:0;overflow:hidden}.elementor-widget-rating .e-rating .e-icon-wrapper :is(i,svg){display:flex;flex-shrink:0}.elementor-widget-rating .e-rating .e-icon-wrapper i{font-size:var(--e-rating-icon-font-size);color:var(--e-rating-icon-color)}.elementor-widget-rating .e-rating .e-icon-wrapper svg{width:auto;height:var(--e-rating-icon-font-size);fill:var(--e-rating-icon-color)}</style>
                                    <div
                                        class="e-rating"
                                        itemtype="https://schema.org/Rating"
                                        itemscope=""
                                        itemprop="reviewRating"
                                    >
                                        @php
                                            $marked = \App\Models\Product::product_computed_ratings($product['id']);
                                        @endphp
                                        <meta itemprop="worstRating" content="0">
                                        <meta itemprop="bestRating" content="5">
                                        <div
                                            class="e-rating-wrapper"
                                            itemprop="ratingValue"
                                            content="{{$marked}}"
                                            role="img"
                                            aria-label="Rated {{$marked}} out of 5"
                                        >
                                            @for ($x = 0; $x < 5; $x++)
                                            <div class="e-icon">
                                                <div class="e-icon-wrapper e-icon-marked" style="{{ ($x < $marked && $marked > 0) ? '':'--e-rating-icon-marked-width: 0%;' }}">
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
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if ($collection->hasPages())
        @php
            $lastNumInRange = $collection->lastPage();
            $urlRange = $collection->getUrlRange(1, $collection->lastPage());
            
            if ($collection->lastPage() > 5) {
                if ($collection->currentPage() + 2 < $collection->lastPage()) {
                    $lastNumInRange = $collection->currentPage() + 2;
                    $urlRange = $collection->getUrlRange($collection->currentPage(), $collection->currentPage() + 2);
                } else {
                    $lastNumInRange = $collection->lastPage();
                    if ($collection->currentPage() - 2 < 1) {
                        $urlRange = $collection->getUrlRange($collection->currentPage(), $collection->currentPage() + 2);
                    } else {
                        $urlRange = $collection->getUrlRange($collection->currentPage() -2, $collection->lastPage());
                    }
                }
            }
        @endphp
            
        <div
            class="elementor-element elementor-element-77cf768 e-con-full e-flex elementor-invisible e-con e-child"
            data-id="77cf768"
            data-element_type="container"
            data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
        >
            {{-- link to prev page --}}

            @if ($collection->currentPage() > 1)
            <div
                class="elementor-element elementor-element-4e10030 elementor-align-left elementor-widget elementor-widget-button"
                data-id="4e10030"
                data-element_type="widget"
                data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$collection->previousPageUrl()}}">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-icon elementor-align-icon-left">
                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-angle-left" viewBox="0 0 256 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z"></path>
                                    </svg>
                                </span>
                                <span class="elementor-button-text"></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if ($collection->currentPage() != 1 && $collection->lastPage() > 5)
            <div
                class="elementor-element elementor-element-cf4102a elementor-align-left elementor-widget elementor-widget-button"
                data-id="cf4102a"
                data-element_type="widget"
                data-widget_type="button.default"
            >
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$collection->url(1)}}">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">1</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if ($collection->currentPage() - 1 > 1)
                <div
                    class="elementor-element elementor-element-21e3336 elementor-align-left elementor-widget elementor-widget-button"
                    data-id="21e3336"
                    data-element_type="widget"
                    data-widget_type="button.default"
                >
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-size-sm" role="button">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">...</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($urlRange as $urlKey => $url)
            <div
                class="elementor-element elementor-element-cf4102a elementor-align-left elementor-widget elementor-widget-button"
                data-id="cf4102a"
                data-element_type="widget"
                data-widget_type="button.default"
            >
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-size-sm" href="{{$url}}" role="button">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">{{$urlKey}}</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($collection->lastPage() - $collection->currentPage() > 3)
                <div
                    class="elementor-element elementor-element-21e3336 elementor-align-left elementor-widget elementor-widget-button"
                    data-id="21e3336"
                    data-element_type="widget"
                    data-widget_type="button.default"
                >
                    <div class="elementor-widget-container">
                        <div class="elementor-button-wrapper">
                            <a class="elementor-button elementor-size-sm" role="button">
                                <span class="elementor-button-content-wrapper">
                                    <span class="elementor-button-text">...</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if ($lastNumInRange != $collection->lastPage() && $collection->lastPage() > 5)
            <div
                class="elementor-element elementor-element-cf4102a elementor-align-left elementor-widget elementor-widget-button"
                data-id="cf4102a"
                data-element_type="widget"
                data-widget_type="button.default"
            >
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$collection->url($collection->lastPage())}}">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-text">{{$collection->lastPage()}}</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if ($collection->currentPage() < $collection->lastPage())
            <div
                class="elementor-element elementor-element-4e10030 elementor-align-left elementor-widget elementor-widget-button"
                data-id="4e10030"
                data-element_type="widget"
                data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a class="elementor-button elementor-button-link elementor-size-sm" href="{{$collection->nextPageUrl()}}">
                            <span class="elementor-button-content-wrapper">
                                <span class="elementor-button-icon elementor-align-icon-left">
                                    <svg
                                        aria-hidden="true"
                                        class="e-font-icon-svg e-fas-angle-right"
                                        viewbox="0 0 256 512"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                                    </svg>
                                </span>
                                <span class="elementor-button-text"></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @endif
        
        {{-- $collection->links() --}}
    </div>
</div>
@endsection