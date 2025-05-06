@foreach ($collection as $product)
@php
$product_image_path = $getImage(
'front/images/product_images/small/',
$product['product_image'],
);

// for animation
$settings = [
        'content_width' => 'full',
        'container_type' => 'flex',
        'animation' => 'fadeInUp'
    ];

@endphp
<div class="elementor-element elementor-element-80f00c9 e-con-full e-flex e-con e-child single_product_card"
    data-id="80f00c9" data-element_type="container"
    data-settings="{{ json_encode($settings) }}">
    <div class="elementor-element elementor-element-757b9c4 elementor-widget__width-inherit elementor-widget elementor-widget-image"
        data-id="757b9c4" data-element_type="widget" data-widget_type="image.default">
        <div class="elementor-widget-container product-card-hover">
            <a href="{{ url('product/' . $product['id']) }}">
                <img loading="lazy" decoding="async" width="800" height="968"
                    src="{{ $product_image_path }}" class="attachment-large size-large wp-image-422"
                    alt=""
                    srcset="{{ $product_image_path }} 846w, {{ $product_image_path }} 248w, {{ $product_image_path }} 768w, {{ $product_image_path }} 879w"
                    sizes="(max-width: 800px) 100vw, 800px">
            </a>
        </div>
    </div>
    <div class="elementor-element elementor-element-826026e elementor-widget__width-inherit elementor-widget elementor-widget-heading"
        data-id="826026e" data-element_type="widget" data-widget_type="heading.default">
        <div class="elementor-widget-container">
            <h2 class="elementor-heading-title elementor-size-default">
                {{ $product['product_name'] }}
            </h2>
        </div>
    </div>
    {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
    @php
    $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
    @endphp

    @if ($getDiscountPrice > 0)
    {{-- If there's a discount on the price, show the price before (the original price) and after (the new price) the discount --}}
    <div class="elementor-element elementor-element-753d4d0 elementor-widget elementor-widget-text-editor"
        data-id="753d4d0" data-element_type="widget" data-widget_type="text-editor.default">
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
            <p> ₱{{ $getDiscountPrice }}</p>
        </div>
    </div>
    <div class="elementor-element elementor-element-725e6f0 elementor-widget elementor-widget-text-editor"
        data-id="725e6f0" data-element_type="widget" data-widget_type="text-editor.default">
        <div class="elementor-widget-container">
            <em style="text-decoration: line-through;">₱{{ $product['product_price'] }}</em>
        </div>
    </div>
    @else
    <div class="elementor-element elementor-element-753d4d0 elementor-widget elementor-widget-text-editor"
        data-id="753d4d0" data-element_type="widget" data-widget_type="text-editor.default">
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
            <p> ₱{{ $product['product_price'] }}</p>
        </div>
    </div>
    @endif

    <div class="elementor-element elementor-element-e6b737c e-flex e-con-boxed e-con e-child"
        data-id="e6b737c" data-element_type="container"
        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
        <div class="e-con-inner">
            @if (isset($product['vendor']))
            @php
            $shop_image = $product->vendor->vendorbusinessdetails->shop_logo;
            if ($shop_image == '') {
            $shop_image = '2023-12-user.png';
            }
            @endphp
            <a class="vendor__name"
                href="{{ url('products/vendor/' . $product->vendor->id) }}">
                <div class="elementor-element elementor-element-a282fc6 e-con-full e-flex e-con e-child"
                    data-id="a282fc6" data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}">
                    <div class="elementor-element elementor-element-ad41e9d elementor-widget elementor-widget-image"
                        data-id="ad41e9d" data-element_type="widget"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img decoding="async" width="300" height="300"
                                src="{{ $getImage('front/images/brand-logos/', $shop_image) }}"
                                class="attachment-large size-large wp-image-423"
                                alt=""
                                srcset="{{ $getImage('front/images/brand-logos/', $shop_image) }} 300w, {{ $getImage('front/images/brand-logos/', $shop_image) }} 150w"
                                sizes="(max-width: 300px) 100vw, 300px">
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-67825cd elementor-widget elementor-widget-heading"
                        data-id="67825cd" data-element_type="widget"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h5 class="elementor-heading-title elementor-size-default">
                                {{ $product->vendor->vendorbusinessdetails->shop_name ?? '' }}
                            </h5>
                        </div>
                    </div>
                </div>
            </a>
            @endif

            <!-- Ratings -->
            <div class="elementor-element elementor-element-036fcb9 elementor-widget elementor-widget-rating css_seller_rating"
                data-id="036fcb9" data-element_type="widget" data-widget_type="rating.default">
                <div class="elementor-widget-container">
                    <style>
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
                    <div class="e-rating" itemtype="https://schema.org/Rating" itemscope=""
                        itemprop="reviewRating">
                        @php
                        $marked = \App\Models\Product::product_computed_ratings(
                        $product['id'],
                        );
                        @endphp
                        <meta itemprop="worstRating" content="0">
                        <meta itemprop="bestRating" content="5">
                        <div class="e-rating-wrapper" itemprop="ratingValue"
                            content="{{ $marked }}" role="img"
                            aria-label="Rated {{ $marked }} out of 5">
                            <div class="elementor-widget-container">
                                <div class="e-rating" itemtype="https://schema.org/Rating" itemscope="" itemprop="reviewRating">
                                    <meta itemprop="worstRating" content="0">
                                    <meta itemprop="bestRating" content="5">
                                    <div class="e-rating-wrapper" itemprop="ratingValue" content="4" role="img" aria-label="Rated 4 out of 5">
                                        @php
                                        $marked = \App\Models\Product::product_computed_ratings($product['id']);
                                        @endphp

                                        @if($marked == 0 || $marked == null)
                                        <span style="display: inline-block; font-size: 14px; color: #666; padding: 5px;">No reviews</span>
                                        @else

                                        @for ($x = 0; $x < 5; $x++)
                                            <div class="e-icon">
                                            <div class="e-icon-wrapper e-icon-marked" style="{{ ($x < $marked && $marked > 0) ? '':'--e-rating-icon-marked-width: 0%;' }}">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-eicon-star" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                                </svg>
                                            </div>
                                            <div class="e-icon-wrapper e-icon-unmarked">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-eicon-star" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M450 75L338 312 88 350C46 354 25 417 58 450L238 633 196 896C188 942 238 975 275 954L500 837 725 954C767 975 813 942 804 896L763 633 942 450C975 417 954 358 913 350L663 312 550 75C529 33 471 33 450 75Z"></path>
                                                </svg>
                                            </div>
                                    </div>
                                    @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endforeach