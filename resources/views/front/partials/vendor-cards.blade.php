{{-- resources/views/front/partials/vendor-cards.blade.php --}}
@foreach ($vendors_paginated as $vendor)
<div
    class="elementor-element elementor-element-8c38852 e-flex e-con-boxed e-con e-child"
    data-id="8c38852"
    data-element_type="container"
    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
    <div class="e-con-inner">
        <div
            class="elementor-element elementor-element-8047317 elementor-widget elementor-widget-image"
            data-id="8047317"
            data-element_type="widget"
            data-widget_type="image.default">
            <div class="elementor-widget-container">
                <img
                    decoding="async"
                    width="138"
                    height="151"
                    src="{{ $getImage('front/images/brand-logos/', $vendor->vendorbusinessdetails->shop_logo) }}"
                    class="attachment-large size-large wp-image-445"
                    alt="">
            </div>
        </div>
        <div
            id="custom_vendor_style"
            class="elementor-element elementor-element-bde2533 elementor-widget elementor-widget-heading"
            data-id="bde2533"
            data-element_type="widget"
            data-widget_type="heading.default">
            <div class="elementor-widget-container">
                <h5 class="elementor-heading-title elementor-size-default" id="shop_name">{{$vendor->vendorbusinessdetails->shop_name}}</h5>
            </div>
        </div>


        <div
            class="elementor-element elementor-element-77f2f47 elementor-widget elementor-widget-text-editor"
            data-id="77f2f47"
            data-element_type="widget"
            data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
                <style>
                    /*! elementor - v3.18.0 - 08-12-2023 */
                    .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap {
                        background-color: #69727d;
                        color: #fff
                    }

                    .elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap {
                        color: #69727d;
                        border: 3px solid;
                        background-color: transparent
                    }

                    .elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap {
                        margin-top: 8px
                    }

                    .elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter {
                        width: 1em;
                        height: 1em
                    }

                    .elementor-widget-text-editor .elementor-drop-cap {
                        float: left;
                        text-align: center;
                        line-height: 1;
                        font-size: 50px
                    }

                    .elementor-widget-text-editor .elementor-drop-cap-letter {
                        display: inline-block
                    }
                </style>
                <p id="custom_vendor_name_style">{{$vendor->name}}<br>
                    {{$vendor->vendorbusinessdetails->shop_address}}, {{$vendor->vendorbusinessdetails->shop_city}},
                    {{$vendor->vendorbusinessdetails->shop_state}}, {{$vendor->vendorbusinessdetails->shop_country}}<br>
                    {{$vendor->vendorbusinessdetails->shop_mobile}}
                </p>
            </div>
        </div>


        <div
            id="custom_review_style"
            class="elementor-element elementor-element-0d99fff e-flex e-con-boxed e-con e-child"
            data-id="0d99fff"
            data-element_type="container"
            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
            @php
            $avg_rating = $vendor->vendorProductRatings();
            @endphp
            @if ($vendor->ratingsCount() > 0)
            <div class="e-con-inner">
                <div
                    class="elementor-element elementor-element-70dd1ff elementor-widget elementor-widget-text-editor"
                    data-id="70dd1ff"
                    data-element_type="widget"
                    data-widget_type="text-editor.default">
                    <div class="elementor-widget-container">
                        <p>
                            <strong>{{$avg_rating}}</strong> based on {{$vendor->ratingsCount()}} reviews
                        </p>
                    </div>
                    @if ($vendor->vendor_product_orders_sum_product_qty > 0)
                    <div style="display: flex; justify-content: center; font-weight: bold; content-visibility: hidden;">
                        {{$vendor->vendor_product_orders_sum_product_qty}} SOLD
                    </div>
                    @endif
                </div>
                <div
                    class="elementor-element elementor-element-14c7ad9 elementor-widget elementor-widget-rating"
                    data-id="14c7ad9"
                    data-element_type="widget"
                    data-widget_type="rating.default">
                    <div class="elementor-widget-container">
                        <style>
                            #custom_review_style{
                                margin-top: -20px;
                            }
                            /*! elementor - v3.18.0 - 08-12-2023 */
                            .elementor-widget-rating {
                                --e-rating-gap: 0px;
                                --e-rating-icon-font-size: 16px;
                                --e-rating-icon-color: #ccd6df;
                                --e-rating-icon-marked-color: #f0ad4e;
                                --e-rating-icon-marked-width: 100%;
                                --e-rating-justify-content: flex-start
                            }

                            .elementor-widget-rating .e-rating {
                                display: flex;
                                justify-content: var(--e-rating-justify-content)
                            }

                            .elementor-widget-rating .e-rating-wrapper {
                                display: flex;
                                justify-content: inherit;
                                flex-direction: row;
                                flex-wrap: wrap;
                                width: -moz-fit-content;
                                width: fit-content;
                                margin-block-end: calc(0px - var(--e-rating-gap));
                                margin-inline-end: calc(0px - var(--e-rating-gap))
                            }

                            .elementor-widget-rating .e-rating .e-icon {
                                position: relative;
                                margin-block-end: var(--e-rating-gap);
                                margin-inline-end: var(--e-rating-gap)
                            }

                            .elementor-widget-rating .e-rating .e-icon-wrapper.e-icon-marked {
                                --e-rating-icon-color: var(--e-rating-icon-marked-color);
                                width: var(--e-rating-icon-marked-width);
                                position: absolute;
                                z-index: 1;
                                height: 100%;
                                left: 0;
                                top: 0;
                                overflow: hidden
                            }

                            .elementor-widget-rating .e-rating .e-icon-wrapper :is(i, svg) {
                                display: flex;
                                flex-shrink: 0
                            }

                            .elementor-widget-rating .e-rating .e-icon-wrapper i {
                                font-size: var(--e-rating-icon-font-size);
                                color: var(--e-rating-icon-color)
                            }

                            .elementor-widget-rating .e-rating .e-icon-wrapper svg {
                                width: auto;
                                height: var(--e-rating-icon-font-size);
                                fill: var(--e-rating-icon-color)
                            }
                        </style>
                        <div
                            class="e-rating"
                            itemtype="https://schema.org/Rating"
                            itemscope=""
                            itemprop="reviewRating">
                            <meta itemprop="worstRating" content="0">
                            <meta itemprop="bestRating" content="5">
                            <div
                                class="e-rating-wrapper"
                                itemprop="ratingValue"
                                content="{{$avg_rating}}"
                                role="img"
                                aria-label="Rated {{$avg_rating}} out of 5">
                                @for ($stars = 0; $stars < 5; $stars++)
                                    <div class="e-icon">
                                    @if ($stars+1 < $avg_rating)
                                        <div class="e-icon-wrapper e-icon-marked">
                                        <svg
                                            aria-hidden="true"
                                            class="e-font-icon-svg e-eicon-star"
                                            viewbox="0 0 1000 1000"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                        </svg>
                            </div>
                            @endif
                            <div class="e-icon-wrapper e-icon-unmarked">
                                <svg
                                    aria-hidden="true"
                                    class="e-font-icon-svg e-eicon-star"
                                    viewbox="0 0 1000 1000"
                                    xmlns="http://www.w3.org/2000/svg">
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
    @else
    <div class="e-con-inner">
        <div
            class="elementor-element elementor-element-70dd1ff elementor-widget elementor-widget-text-editor"
            data-id="70dd1ff"
            data-element_type="widget"
            data-widget_type="text-editor.default">
            <div class="elementor-widget-container">
                <p>
                    <strong>No Reviews</strong>
                </p>
            </div>
        </div>
    </div>
    @endif
</div>

<div
    id="custom_button_style"
    class="elementor-element elementor-element-58fa36b elementor-widget__width-auto elementor-align-center elementor-widget elementor-widget-button"
    data-id="58fa36b"
    data-element_type="widget"
    data-widget_type="button.default">
    <div class="elementor-widget-container">
        <div class="elementor-button-wrapper">
            <a class="elementor-button elementor-button-link elementor-size-sm" href="{{ url('products/vendor/' . $vendor['id']) }}">
                <span class="elementor-button-content-wrapper">
                    <span class="elementor-button-text">VIEW STORE</span>
                </span>
            </a>
        </div>
    </div>
</div>

</div>
</div>
@endforeach