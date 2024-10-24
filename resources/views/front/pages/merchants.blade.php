{{-- This page is rendered by merchantsLists() method in Front/IndexController.php --}}
@extends('front.layout.layout')


@section('content')
<div
    data-elementor-type="wp-page"
    data-elementor-id="1751"
    class="elementor elementor-1751"
    data-elementor-post-type="page">
    <div
        class="elementor-element elementor-element-7c4e54c e-flex e-con-boxed e-con e-parent"
        data-id="7c4e54c"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-d507bf3 e-con-full e-flex e-con e-child"
                data-id="d507bf3"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-9ed0446 elementor-invisible elementor-widget elementor-widget-heading"
                    data-id="9ed0446"
                    data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h1 class="elementor-heading-title elementor-size-default">MERCHANTS</h1>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-94b41db login-container e-flex e-con-boxed elementor-invisible e-con e-child"
                    data-id="94b41db"
                    data-element_type="container"
                    data-settings="{&quot;animation&quot;:&quot;fadeInUp&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-b3ddacb e-grid e-con-boxed e-con e-child"
                            data-id="b3ddacb"
                            data-element_type="container"
                            data-settings="{&quot;container_type&quot;:&quot;grid&quot;,&quot;content_width&quot;:&quot;boxed&quot;,&quot;grid_outline&quot;:&quot;yes&quot;,&quot;grid_columns_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:3,&quot;sizes&quot;:[]},&quot;grid_columns_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_columns_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:1,&quot;sizes&quot;:[]},&quot;grid_rows_grid&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:2,&quot;sizes&quot;:[]},&quot;grid_rows_grid_tablet&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_rows_grid_mobile&quot;:{&quot;unit&quot;:&quot;fr&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;grid_auto_flow&quot;:&quot;row&quot;,&quot;grid_auto_flow_tablet&quot;:&quot;row&quot;,&quot;grid_auto_flow_mobile&quot;:&quot;row&quot;}"
                        >
                            <div class="e-con-inner">
                                @foreach ($vendors as $vendor)
                                <div
                                    class="elementor-element elementor-element-8c38852 e-flex e-con-boxed e-con e-child"
                                    data-id="8c38852"
                                    data-element_type="container"
                                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner">
                                        <div
                                            class="elementor-element elementor-element-8047317 elementor-widget elementor-widget-image"
                                            data-id="8047317"
                                            data-element_type="widget"
                                            data-widget_type="image.default"
                                        >
                                            <div class="elementor-widget-container">
                                                <img
                                                    decoding="async"
                                                    width="138"
                                                    height="151"
                                                    src="{{ $getImage('front/images/brand-logos/', $vendor->vendorbusinessdetails->shop_logo) }}"
                                                    class="attachment-large size-large wp-image-445"
                                                    alt=""
                                                >
                                            </div>
                                        </div>
                                        <div
                                            class="elementor-element elementor-element-bde2533 elementor-widget elementor-widget-heading"
                                            data-id="bde2533"
                                            data-element_type="widget"
                                            data-widget_type="heading.default"
                                        >
                                            <div class="elementor-widget-container">
                                                <h5 class="elementor-heading-title elementor-size-default">{{$vendor->vendorbusinessdetails->shop_name}}</h5>
                                            </div>
                                        </div>

                                        <!--
                                        <div
                                            class="elementor-element elementor-element-77f2f47 elementor-widget elementor-widget-text-editor"
                                            data-id="77f2f47"
                                            data-element_type="widget"
                                            data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#69727d;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}</style>
                                                <p>{{$vendor->name}}<br>
                                                {{$vendor->vendorbusinessdetails->shop_address}}, {{$vendor->vendorbusinessdetails->shop_city}},
                                                {{$vendor->vendorbusinessdetails->shop_state}}, {{$vendor->vendorbusinessdetails->shop_country}}<br>
                                                {{$vendor->vendorbusinessdetails->shop_mobile}}
                                                </p>
                                            </div>
                                        </div>
                                        -->

                                        <div
                                            class="elementor-element elementor-element-0d99fff e-flex e-con-boxed e-con e-child"
                                            data-id="0d99fff"
                                            data-element_type="container"
                                            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                        >
                                            @php
                                                $avg_rating = $vendor->vendorProductRatings();
                                            @endphp
                                            @if ($vendor->ratings()->count() > 0)
                                            <div class="e-con-inner">
                                                <div
                                                    class="elementor-element elementor-element-70dd1ff elementor-widget elementor-widget-text-editor"
                                                    data-id="70dd1ff"
                                                    data-element_type="widget"
                                                    data-widget_type="text-editor.default"
                                                >
                                                    <div class="elementor-widget-container">
                                                        <p>
                                                            <strong>{{$avg_rating}}</strong> based on {{$vendor->ratings()->count()}} reviews
                                                        </p>
                                                    </div>
                                                    @if ($vendor->vendor_product_orders_sum_product_qty > 0)
                                                    <div style="display: flex; justify-content: center; font-weight: bold;">
                                                        {{$vendor->vendor_product_orders_sum_product_qty}} SOLD
                                                    </div>
                                                    @endif
                                                </div>
                                                <div
                                                    class="elementor-element elementor-element-14c7ad9 elementor-widget elementor-widget-rating"
                                                    data-id="14c7ad9"
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
                                                            <meta itemprop="worstRating" content="0">
                                                            <meta itemprop="bestRating" content="5">
                                                            <div
                                                                class="e-rating-wrapper"
                                                                itemprop="ratingValue"
                                                                content="{{$avg_rating}}"
                                                                role="img"
                                                                aria-label="Rated {{$avg_rating}} out of 5"
                                                            >
                                                                @for ($stars = 0; $stars < 5; $stars++)
                                                                <div class="e-icon">
                                                                    @if ($stars+1 < $avg_rating)
                                                                    <div class="e-icon-wrapper e-icon-marked">
                                                                        <svg
                                                                            aria-hidden="true"
                                                                            class="e-font-icon-svg e-eicon-star"
                                                                            viewbox="0 0 1000 1000"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                        >
                                                                            <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                                                        </svg>
                                                                    </div>    
                                                                    @endif
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
                                            @else
                                            <div class="e-con-inner">
                                                <div
                                                    class="elementor-element elementor-element-70dd1ff elementor-widget elementor-widget-text-editor"
                                                    data-id="70dd1ff"
                                                    data-element_type="widget"
                                                    data-widget_type="text-editor.default"
                                                >
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
                                            class="elementor-element elementor-element-58fa36b elementor-widget__width-auto elementor-align-center elementor-widget elementor-widget-button"
                                            data-id="58fa36b"
                                            data-element_type="widget"
                                            data-widget_type="button.default"
                                        >
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
                                <div
                                    class="elementor-element elementor-element-0899f6b e-flex e-con-boxed e-con e-child"
                                    data-id="0899f6b"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner"></div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-8d1e524 e-flex e-con-boxed e-con e-child"
                                    data-id="8d1e524"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner"></div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-f8de5f2 e-flex e-con-boxed e-con e-child"
                                    data-id="f8de5f2"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner"></div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-71044be e-flex e-con-boxed e-con e-child"
                                    data-id="71044be"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner"></div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-ac65710 e-flex e-con-boxed e-con e-child"
                                    data-id="ac65710"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner"></div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-4d0e271 e-flex e-con-boxed e-con e-child"
                                    data-id="4d0e271"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner"></div>
                                </div>
                                <div
                                    class="elementor-element elementor-element-691334e e-flex e-con-boxed e-con e-child"
                                    data-id="691334e"
                                    data-element_type="container"
                                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                >
                                    <div class="e-con-inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection