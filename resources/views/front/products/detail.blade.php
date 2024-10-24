{{-- Note: front/products/detail.blade.php is the page that opens when you click on a product in the FRONT home page --}} {{-- $productDetails, categoryDetails and $totalStock are passed in from detail() method in Front/ProductsController.php --}}
@extends('front.layout.layout')

@section('content')
<div
    data-elementor-type="wp-page"
    data-elementor-id="491"
    class="elementor elementor-491"
    data-elementor-post-type="page"
>
<div class="popup_review_container">
    <img src="{{ $getImage('front/images/product/', 'no-available-image.jpg') }}">
    <a href="#" class="close_image_review_popup">X</a>
</div>

<div class="wishlist-container" id="wishlist-container">
    <div>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

<dotlottie-player src="https://lottie.host/c80730db-e87e-4f4c-aa13-a7850d40f604/1geJ53SjpY.json" background="transparent" speed="1" style="width: 300px; height: 200px;" loop autoplay></dotlottie-player>
    <p>{{$productDetails['product_name']}} added to your wishlist.</p>
    <a class="button btn" href="/wishlist">View my wishlist</a>
    </div>
    <a href="#" class="close_image_review_popup">X</a>
</div>
<div class="wishlist-container error" id="wishlist-container">
    <div>
    <p>Error occured while adding {{$productDetails['product_name']}} to wishlist.</p>
    </div>
    <a href="#" class="close_image_review_popup">X</a>
</div>

<div class="chat_vendor_window">
    <div class="elementor-widget-container product_page_chat_container">
        <h3 class="h2">Send a message to Vendor {{ isset($productDetails['vendor']['name']) ? $productDetails['vendor']['name']:"" }}</h2>
        <style>/*! elementor-pro - v3.18.0 - 06-12-2023 */ .elementor-button.elementor-hidden,.elementor-hidden{display:none}.e-form__step{width:100%}.e-form__step:not(.elementor-hidden){display:flex;flex-wrap:wrap}.e-form__buttons{flex-wrap:wrap}.e-form__buttons,.e-form__buttons__wrapper{display:flex}.e-form__indicators{display:flex;justify-content:space-between;align-items:center;flex-wrap:nowrap;font-size:13px;margin-bottom:var(--e-form-steps-indicators-spacing)}.e-form__indicators__indicator{display:flex;flex-direction:column;align-items:center;justify-content:center;flex-basis:0;padding:0 var(--e-form-steps-divider-gap)}.e-form__indicators__indicator__progress{width:100%;position:relative;background-color:var(--e-form-steps-indicator-progress-background-color);border-radius:var(--e-form-steps-indicator-progress-border-radius);overflow:hidden}.e-form__indicators__indicator__progress__meter{width:var(--e-form-steps-indicator-progress-meter-width,0);height:var(--e-form-steps-indicator-progress-height);line-height:var(--e-form-steps-indicator-progress-height);padding-right:15px;border-radius:var(--e-form-steps-indicator-progress-border-radius);background-color:var(--e-form-steps-indicator-progress-color);color:var(--e-form-steps-indicator-progress-meter-color);text-align:right;transition:width .1s linear}.e-form__indicators__indicator:first-child{padding-left:0}.e-form__indicators__indicator:last-child{padding-right:0}.e-form__indicators__indicator--state-inactive{color:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-inactive [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-inactive-secondary-color,#fff)}.e-form__indicators__indicator--state-inactive object,.e-form__indicators__indicator--state-inactive svg{fill:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-active{color:var(--e-form-steps-indicator-active-primary-color,#39b54a);border-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active object,.e-form__indicators__indicator--state-active svg{fill:var(--e-form-steps-indicator-active-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed{color:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator--state-completed [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator__label{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator--shape-none{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a);background-color:initial}.e-form__indicators__indicator--state-completed object,.e-form__indicators__indicator--state-completed svg{fill:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator__icon{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);font-size:var(--e-form-steps-indicator-icon-size);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;overflow:hidden;margin-bottom:10px}.e-form__indicators__indicator__icon img,.e-form__indicators__indicator__icon object,.e-form__indicators__indicator__icon svg{width:var(--e-form-steps-indicator-icon-size);height:auto}.e-form__indicators__indicator__icon .e-font-icon-svg{height:1em}.e-form__indicators__indicator__number{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;margin-bottom:10px}.e-form__indicators__indicator--shape-circle{border-radius:50%}.e-form__indicators__indicator--shape-square{border-radius:0}.e-form__indicators__indicator--shape-rounded{border-radius:5px}.e-form__indicators__indicator--shape-none{border:0}.e-form__indicators__indicator__label{text-align:center}.e-form__indicators__indicator__separator{width:100%;height:var(--e-form-steps-divider-width);background-color:#babfc5}.e-form__indicators--type-icon,.e-form__indicators--type-icon_text,.e-form__indicators--type-number,.e-form__indicators--type-number_text{align-items:flex-start}.e-form__indicators--type-icon .e-form__indicators__indicator__separator,.e-form__indicators--type-icon_text .e-form__indicators__indicator__separator,.e-form__indicators--type-number .e-form__indicators__indicator__separator,.e-form__indicators--type-number_text .e-form__indicators__indicator__separator{margin-top:calc(var(--e-form-steps-indicator-padding, 30px) / 2 - var(--e-form-steps-divider-width, 1px) / 2)}.elementor-field-type-hidden{display:none}.elementor-field-type-html{display:inline-block}.elementor-field-type-tel input{direction:inherit}.elementor-login .elementor-lost-password,.elementor-login .elementor-remember-me{font-size:.85em}.elementor-field-type-recaptcha_v3 .elementor-field-label{display:none}.elementor-field-type-recaptcha_v3 .grecaptcha-badge{z-index:1}.elementor-button .elementor-form-spinner{order:3}.elementor-form .elementor-button>span{display:flex;justify-content:center;align-items:center}.elementor-form .elementor-button .elementor-button-text{white-space:normal;flex-grow:0}.elementor-form .elementor-button svg{height:auto}.elementor-form .elementor-button .e-font-icon-svg{height:1em}.elementor-select-wrapper .select-caret-down-wrapper{position:absolute;top:50%;transform:translateY(-50%);inset-inline-end:10px;pointer-events:none;font-size:11px}.elementor-select-wrapper .select-caret-down-wrapper svg{display:unset;width:1em;aspect-ratio:unset;fill:currentColor}.elementor-select-wrapper .select-caret-down-wrapper i{font-size:19px;line-height:2}.elementor-select-wrapper.remove-before:before{content:""!important}</style>
        <form id="form-product-details-vendor-chat" action="javascript:;" method="post">
            <input type="hidden" name="post_id" value="1086">
            <input type="hidden" name="form_id" value="b183ae1">
            <input type="hidden" name="referer_title" value="Chat">
            <input type="hidden" name="queried_id" value="1086">
            <input type="hidden" name="vendor_id" value="{{$productDetails['vendor']['id']}}">
            <div class="product-container-small">
                @php
                    $product_image_path = $getImage('front/images/product_images/small/', $productDetails['product_image']);
                @endphp
                <div
                    class="product-chat-vendor elementor-element elementor-element-80f00c9 e-con-full e-flex  e-con e-child single_product_card"
                    data-id="80f00c9"
                    data-element_type="container">
                    <div class="img-cont">
                        <div
                            class="elementor-element elementor-element-757b9c4 elementor-widget__width-inherit elementor-widget elementor-widget-image"
                            data-id="757b9c4"
                            data-element_type="widget"
                            data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <a href="{{ url('product/' . $productDetails['id']) }}">
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
                    </div>

                    <div class="text-cont">

                        <div
                            class="elementor-element elementor-element-826026e elementor-widget__width-inherit elementor-widget elementor-widget-heading"
                            data-id="826026e"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">{{$productDetails['product_name']}}</h2>
                            </div>
                        </div>
                        {{-- Call the static getDiscountPrice() method in the Product.php Model to determine the final price of a product because a product can have a discount from TWO things: either a `CATEGORY` discount or `PRODUCT` discout     --}}
                        @php
                            $getDiscountPrice = \App\Models\Product::getDiscountPrice($productDetails['id']);
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
                                <em style="text-decoration: line-through;">₱{{$productDetails['product_price']}}</em>
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
                                <p> ₱{{$productDetails['product_price']}}</p>
                            </div>
                        </div>
                        @endif

                        <div
                            class="elementor-element elementor-element-e6b737c e-flex e-con-boxed e-con e-child"
                            data-id="e6b737c"
                            data-element_type="container"
                            data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}">
                            <div class="e-con-inner">
                                @if (isset($productDetails['vendor']))
                                <a href="{{ url('products/vendor/' . $productDetails['vendor']['id']) }}">
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
                                            @php
                                                $brand_logos_path = $getImage('front/images/brand-logos/', '2023-12-user.png');
                                            @endphp
                                            <div class="elementor-widget-container">
                                                <img
                                                    decoding="async"
                                                    width="300"
                                                    height="300"
                                                    src="{{ $brand_logos_path }}"
                                                    class="attachment-large size-large wp-image-423"
                                                    alt=""
                                                    srcset="{{ $brand_logos_path }} 300w, {{ $brand_logos_path }} 150w"
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
                                                <h5 class="elementor-heading-title elementor-size-default">{{ $product['vendor']['name'] ?? "" }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endif

                                <!-- Ratings -->
                                <div
                                    class="elementor-element elementor-element-036fcb9 elementor-widget elementor-widget-rating"
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
                                            <meta itemprop="worstRating" content="0">
                                            <meta itemprop="bestRating" content="5">
                                            <div
                                                class="e-rating-wrapper"
                                                itemprop="ratingValue"
                                                content="4"
                                                role="img"
                                                aria-label="Rated 4 out of 5"
                                            >
                                                @for ($x = 0; $x < 5; $x++)
                                                @php
                                                    $marked = \App\Models\Product::product_computed_ratings($productDetails['id']);
                                                @endphp
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
                </div>
            </div>
            <div class="elementor-form-fields-wrapper elementor-labels-">
                <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-name elementor-col-100">
                    <label for="form-field-name" class="elementor-field-label elementor-screen-only"> 								Type a message here</label>
                    <textarea
                        class="elementor-field-textual elementor-field  elementor-size-sm"
                        name="message"
                        id="form-field-name"
                        rows="3"
                        placeholder="Type a message here"
                    ></textarea>
                </div>
                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                    <button type="submit" class="elementor-button elementor-size-xs">
                        <span>
                            <span class="elementor-button-icon"></span>
                            <span class="elementor-button-text">Send</span>
                        </span>
                    </button>
                </div>
            </div>
            
            
        </form>

        <div class="alert alert-dialog success" style="margin-top: 20px; background: #0080001a; display: none;">
            <p style="margin-bottom: 0; text-align: center;"></p>
        </div>
        <div class="alert alert-dialog error" style="margin-top: 20px; background: #80000033; display: none;">
            <p style="margin-bottom: 0; text-align: center;"></p>
        </div>
        
    </div>
    <a href="#" class="close_image_review_popup">X</a>
</div>




    <div
        class="elementor-element elementor-element-51b2b2e e-flex e-con-boxed e-con e-parent"
        data-id="51b2b2e"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true">

        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-37b0796 e-con-full e-flex e-con e-child"
                data-id="37b0796"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-e8c1cfd elementor-invisible elementor-widget elementor-widget-heading"
                    data-id="e8c1cfd"
                    data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInLeft&quot;}"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        {{-- Breadcrumbs --}} 
                        <p class="elementor-heading-title elementor-size-default">Home / @php echo $categoryDetails['breadcrumbs']; @endphp </p>
                    </div>
                </div>
            </div>
            <div
                class="elementor-element elementor-element-de7af75 e-con-full e-flex elementor-invisible e-con e-child"
                data-id="de7af75"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInLeft&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-7e93cf1 e-flex e-con-boxed e-con e-child"
                    data-id="7e93cf1"
                    data-element_type="container"
                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-14f2792 elementor-pagination-type-progressbar elementor-arrows-position-inside elementor-widget elementor-widget-n-carousel"
                            data-id="14f2792"
                            data-element_type="widget"
                            data-settings="{&quot;carousel_items&quot;:[{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;9df787b&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;9a06489&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;a96bbe5&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;96cff8d&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;8586e44&quot;},{&quot;slide_title&quot;:&quot;Slide #1&quot;,&quot;_id&quot;:&quot;1f406b6&quot;}],&quot;slides_to_show&quot;:&quot;1&quot;,&quot;pagination&quot;:&quot;progressbar&quot;,&quot;slides_to_show_tablet&quot;:&quot;1&quot;,&quot;slides_to_show_mobile&quot;:&quot;1&quot;,&quot;autoplay&quot;:&quot;yes&quot;,&quot;autoplay_speed&quot;:5000,&quot;pause_on_hover&quot;:&quot;yes&quot;,&quot;pause_on_interaction&quot;:&quot;yes&quot;,&quot;infinite&quot;:&quot;yes&quot;,&quot;speed&quot;:500,&quot;offset_sides&quot;:&quot;none&quot;,&quot;arrows&quot;:&quot;yes&quot;,&quot;image_spacing_custom&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;image_spacing_custom_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;image_spacing_custom_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}"
                            data-widget_type="nested-carousel.default"
                        >
                            <div class="elementor-widget-container">
                                <link rel="stylesheet" href="{{ url('front/css/elementor-css/elementor-pro-assets-css-widget-nested-carousel.min.css') }}">
                                <div class="e-n-carousel swiper" dir="ltr">
                                    <div class="swiper-wrapper" aria-live="off">
                                        @empty($productDetails['images'])
                                        <div
                                            class="swiper-slide"
                                            data-slide="1"
                                            role="group"
                                            aria-roledescription="slide"
                                            aria-label="1 of 1"
                                        >
                                            <div
                                                class="elementor-element elementor-element-09d9b51 e-flex e-con-boxed e-con e-child"
                                                data-id="09d9b51"
                                                data-element_type="container"
                                                data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                            >
                                                <div class="e-con-inner">
                                                    <div
                                                        class="elementor-element elementor-element-7496269 e-flex e-con-boxed e-con e-child"
                                                        data-id="7496269"
                                                        data-element_type="container"
                                                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                                    >
                                                        <div class="e-con-inner">
                                                            <div
                                                                class="elementor-element elementor-element-9905f7b elementor-widget elementor-widget-image"
                                                                data-id="9905f7b"
                                                                data-element_type="widget"
                                                                data-widget_type="image.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <img
                                                                        fetchpriority="high"
                                                                        decoding="async"
                                                                        width="522"
                                                                        height="522"
                                                                        src="{{ $getImage('front/images/product/', 'no-available-image.jpg') }}"
                                                                        class="attachment-large size-large wp-image-503"
                                                                        alt=""
                                                                        srcset="{{ $getImage('front/images/product/', 'no-available-image.jpg') }} 522w, {{ $getImage('front/images/product/', 'no-available-image.jpg') }} 300w, {{ $getImage('front/images/product/', 'no-available-image.jpg') }} 150w"
                                                                        sizes="(max-width: 522px) 100vw, 522px"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endempty
                                        @foreach ($productDetails['images'] as $product_key => $product_image)
                                        <div
                                            class="swiper-slide"
                                            data-slide="{{$product_key}}"
                                            role="group"
                                            aria-roledescription="slide"
                                            aria-label="{{$product_key}} of {{count($productDetails['images'])}}"
                                        >
                                            <div
                                                class="elementor-element elementor-element-09d9b5{{$product_key}} e-flex e-con-boxed e-con e-child"
                                                data-id="09d9b5{{$product_key}}"
                                                data-element_type="container"
                                                data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                            >
                                                <div class="e-con-inner">
                                                    <div
                                                        class="elementor-element elementor-element-7496269 e-flex e-con-boxed e-con e-child"
                                                        data-id="7496269"
                                                        data-element_type="container"
                                                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                                    >
                                                        <div class="e-con-inner">
                                                            <div
                                                                class="elementor-element elementor-element-9905f7b elementor-widget elementor-widget-image"
                                                                data-id="9905f7b"
                                                                data-element_type="widget"
                                                                data-widget_type="image.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <img
                                                                        fetchpriority="high"
                                                                        decoding="async"
                                                                        width="522"
                                                                        height="522"
                                                                        src="{{ $getImage('front/images/product_images/large/', $product_image['image']) }}"
                                                                        class="attachment-large size-large wp-image-503"
                                                                        alt=""
                                                                        srcset="{{ $getImage('front/images/product_images/large/', $product_image['image']) }} 522w, {{ $getImage('front/images/product_images/large/', $product_image['image']) }} 300w, {{ $getImage('front/images/product_images/large/', $product_image['image']) }} 150w"
                                                                        sizes="(max-width: 522px) 100vw, 522px"
                                                                    >
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
            </div>
            <div
                class="elementor-element elementor-element-a402a83 e-con-full e-flex elementor-invisible e-con e-child"
                data-id="a402a83"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;animation&quot;:&quot;fadeInRight&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-9707fe2 elementor-widget elementor-widget-heading"
                    data-id="9707fe2"
                    data-element_type="widget"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">

                        <div class="list-of-tags">
                            @foreach (explode(",", $productDetails['group_code']) as $tags)
                                <span>{{$tags}}</span>
                            @endforeach
                        </div>

                        <h1 class="elementor-heading-title elementor-size-default">{{$productDetails['product_name']}}</h1>
                    </div>
                </div>
                <!-- <div
                    class="elementor-element elementor-element-e6c5248 elementor-widget elementor-widget-heading"
                    data-id="e6c5248"
                    data-element_type="widget"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h6 class="elementor-heading-title elementor-size-default">12-Month subscription with Auto-Renewal for PC/MAC</h6>
                    </div>
                </div> -->
                <div
                    class="elementor-element elementor-element-8305131 e-con-full e-flex e-con e-child"
                    data-id="8305131"
                    data-element_type="container"
                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                >
                    <div
                        class="elementor-element elementor-element-c850d33 e-con-full e-flex e-con e-child"
                        data-id="c850d33"
                        data-element_type="container"
                        data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                    >


                        @auth
                        <div
                            class="elementor-element elementor-element-8b97798 elementor-widget elementor-widget-image"
                            data-id="8b97798"
                            data-element_type="widget"
                            data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <img
                                    loading="lazy"
                                    decoding="async"
                                    width="300"
                                    height="300"
                                    src="{{ $getImage('front/images/brand-logos/', 'chatpng2.png') }}"
                                    class="attachment-large size-large wp-image-423 chat_vendor_btn"
                                    alt=""
                                    srcset="{{ $getImage('front/images/brand-logos/', 'chatpng2.png') }} 300w, {{ $getImage('front/images/brand-logos/', 'chatpng2.png') }} 150w"
                                    sizes="(max-width: 300px) 100vw, 300px"
                                >
                            </div>
                        </div>
                        @endauth

                        @php
                            $vendor_profile_image = null;
                            if (isset($productDetails['vendor']['vendorbusinessdetails']['shop_logo']))
                                $vendor_profile_image = $productDetails['vendor']['vendorbusinessdetails']['shop_logo'] != "" ? $productDetails['vendor']['vendorbusinessdetails']['shop_logo']:'2023-12-user.png';
                        @endphp
                        <div
                            class="elementor-element elementor-element-8b97798 elementor-widget elementor-widget-image"
                            data-id="8b97798"
                            data-element_type="widget"
                            data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <img
                                    loading="lazy"
                                    decoding="async"
                                    width="300"
                                    height="300"
                                    src="{{ $getImage('front/images/brand-logos/', $vendor_profile_image) }}"
                                    class="attachment-large size-large wp-image-423"
                                    alt=""
                                    srcset="{{ $getImage('front/images/brand-logos/', $vendor_profile_image) }} 300w, {{ $getImage('front/images/brand-logos/', $vendor_profile_image) }} 150w"
                                    sizes="(max-width: 300px) 100vw, 300px"
                                >
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-621ad64 elementor-widget elementor-widget-heading"
                            data-id="621ad64"
                            data-element_type="widget"
                            data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <h5 class="elementor-heading-title elementor-size-default">{{ (isset($productDetails['vendor']['vendorbusinessdetails']['shop_name'])  ? $productDetails['vendor']['vendorbusinessdetails']['shop_name']:'') }}</h5>
                            </div>
                        </div>

                    </div>
                    <div
                        class="elementor-element elementor-element-0e1807c elementor-widget elementor-widget-rating"
                        data-id="0e1807c"
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
                                    content="4"
                                    role="img"
                                    aria-label="Rated 4 out of 5"
                                >
                                    @for ($x = 0; $x < 5; $x++)
                                        @php
                                            $marked = \App\Models\Product::product_computed_ratings($productDetails['id']);
                                        @endphp
                                    <!-- marked -->
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

                @php $getDiscountPrice = \App\Models\Product::getDiscountPrice($productDetails['id']) @endphp

                <div
                    class="elementor-element elementor-element-0fe71b8 price-container e-flex e-con-boxed e-con e-child"
                    data-id="0fe71b8"
                    data-element_type="container"
                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        @if ($getDiscountPrice > 0)
                        <div
                            class="elementor-element elementor-element-824f352 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                            data-id="824f352"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">₱{{$getDiscountPrice}}</h2>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-32fc723 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                            data-id="32fc723"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">₱{{$productDetails['product_price']}}</h2>
                            </div>
                        </div>
                        @else
                        <div
                            class="elementor-element elementor-element-824f352 elementor-widget__width-auto elementor-widget elementor-widget-heading"
                            data-id="824f352"
                            data-element_type="widget"
                            data-widget_type="heading.default"
                        >
                            <div class="elementor-widget-container">
                                <h2 class="elementor-heading-title elementor-size-default">₱{{$productDetails['product_price']}}</h2>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-b77bd95 elementor-widget elementor-widget-text-editor"
                    data-id="b77bd95"
                    data-element_type="widget"
                    data-widget_type="text-editor.default"
                >
                    <div class="elementor-widget-container">
                        <style>/*! elementor - v3.18.0 - 08-12-2023 */ .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#69727d;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}</style>
                        {{$productDetails['description']}}
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-6671d28 add-to-cart-form e-flex e-con-boxed e-con e-child"
                    data-id="6671d28"
                    data-element_type="container"
                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-0b98135 elementor-button-align-stretch elementor-widget elementor-widget-form"
                            data-id="0b98135"
                            data-element_type="widget"
                            data-settings="{&quot;button_width&quot;:&quot;25&quot;,&quot;step_next_label&quot;:&quot;Next&quot;,&quot;step_previous_label&quot;:&quot;Previous&quot;,&quot;button_width_tablet&quot;:&quot;60&quot;,&quot;step_type&quot;:&quot;number_text&quot;,&quot;step_icon_shape&quot;:&quot;circle&quot;}"
                            data-widget_type="form.default">
                            <div class="elementor-widget-container">
                                <style>/*! elementor-pro - v3.18.0 - 06-12-2023 */ .elementor-button.elementor-hidden,.elementor-hidden{display:none}.e-form__step{width:100%}.e-form__step:not(.elementor-hidden){display:flex;flex-wrap:wrap}.e-form__buttons{flex-wrap:wrap}.e-form__buttons,.e-form__buttons__wrapper{display:flex}.e-form__indicators{display:flex;justify-content:space-between;align-items:center;flex-wrap:nowrap;font-size:13px;margin-bottom:var(--e-form-steps-indicators-spacing)}.e-form__indicators__indicator{display:flex;flex-direction:column;align-items:center;justify-content:center;flex-basis:0;padding:0 var(--e-form-steps-divider-gap)}.e-form__indicators__indicator__progress{width:100%;position:relative;background-color:var(--e-form-steps-indicator-progress-background-color);border-radius:var(--e-form-steps-indicator-progress-border-radius);overflow:hidden}.e-form__indicators__indicator__progress__meter{width:var(--e-form-steps-indicator-progress-meter-width,0);height:var(--e-form-steps-indicator-progress-height);line-height:var(--e-form-steps-indicator-progress-height);padding-right:15px;border-radius:var(--e-form-steps-indicator-progress-border-radius);background-color:var(--e-form-steps-indicator-progress-color);color:var(--e-form-steps-indicator-progress-meter-color);text-align:right;transition:width .1s linear}.e-form__indicators__indicator:first-child{padding-left:0}.e-form__indicators__indicator:last-child{padding-right:0}.e-form__indicators__indicator--state-inactive{color:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-inactive [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-inactive-secondary-color,#fff)}.e-form__indicators__indicator--state-inactive object,.e-form__indicators__indicator--state-inactive svg{fill:var(--e-form-steps-indicator-inactive-primary-color,#c2cbd2)}.e-form__indicators__indicator--state-active{color:var(--e-form-steps-indicator-active-primary-color,#39b54a);border-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-active-secondary-color,#fff)}.e-form__indicators__indicator--state-active object,.e-form__indicators__indicator--state-active svg{fill:var(--e-form-steps-indicator-active-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed{color:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator--state-completed [class*=indicator--shape-]:not(.e-form__indicators__indicator--shape-none){background-color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator__label{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a)}.e-form__indicators__indicator--state-completed .e-form__indicators__indicator--shape-none{color:var(--e-form-steps-indicator-completed-primary-color,#39b54a);background-color:initial}.e-form__indicators__indicator--state-completed object,.e-form__indicators__indicator--state-completed svg{fill:var(--e-form-steps-indicator-completed-secondary-color,#fff)}.e-form__indicators__indicator__icon{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);font-size:var(--e-form-steps-indicator-icon-size);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;overflow:hidden;margin-bottom:10px}.e-form__indicators__indicator__icon img,.e-form__indicators__indicator__icon object,.e-form__indicators__indicator__icon svg{width:var(--e-form-steps-indicator-icon-size);height:auto}.e-form__indicators__indicator__icon .e-font-icon-svg{height:1em}.e-form__indicators__indicator__number{width:var(--e-form-steps-indicator-padding,30px);height:var(--e-form-steps-indicator-padding,30px);border-width:1px;border-style:solid;display:flex;justify-content:center;align-items:center;margin-bottom:10px}.e-form__indicators__indicator--shape-circle{border-radius:50%}.e-form__indicators__indicator--shape-square{border-radius:0}.e-form__indicators__indicator--shape-rounded{border-radius:5px}.e-form__indicators__indicator--shape-none{border:0}.e-form__indicators__indicator__label{text-align:center}.e-form__indicators__indicator__separator{width:100%;height:var(--e-form-steps-divider-width);background-color:#babfc5}.e-form__indicators--type-icon,.e-form__indicators--type-icon_text,.e-form__indicators--type-number,.e-form__indicators--type-number_text{align-items:flex-start}.e-form__indicators--type-icon .e-form__indicators__indicator__separator,.e-form__indicators--type-icon_text .e-form__indicators__indicator__separator,.e-form__indicators--type-number .e-form__indicators__indicator__separator,.e-form__indicators--type-number_text .e-form__indicators__indicator__separator{margin-top:calc(var(--e-form-steps-indicator-padding, 30px) / 2 - var(--e-form-steps-divider-width, 1px) / 2)}.elementor-field-type-hidden{display:none}.elementor-field-type-html{display:inline-block}.elementor-field-type-tel input{direction:inherit}.elementor-login .elementor-lost-password,.elementor-login .elementor-remember-me{font-size:.85em}.elementor-field-type-recaptcha_v3 .elementor-field-label{display:none}.elementor-field-type-recaptcha_v3 .grecaptcha-badge{z-index:1}.elementor-button .elementor-form-spinner{order:3}.elementor-form .elementor-button>span{display:flex;justify-content:center;align-items:center}.elementor-form .elementor-button .elementor-button-text{white-space:normal;flex-grow:0}.elementor-form .elementor-button svg{height:auto}.elementor-form .elementor-button .e-font-icon-svg{height:1em}.elementor-select-wrapper .select-caret-down-wrapper{position:absolute;top:50%;transform:translateY(-50%);inset-inline-end:10px;pointer-events:none;font-size:11px}.elementor-select-wrapper .select-caret-down-wrapper svg{display:unset;width:1em;aspect-ratio:unset;fill:currentColor}.elementor-select-wrapper .select-caret-down-wrapper i{font-size:19px;line-height:2}.elementor-select-wrapper.remove-before:before{content:""!important}</style>
                                <form id="product-detail-add-to-cart-form" method="post" action="javascript:;" name="New Form">
                                    <input type="hidden" name="post_id" value="491">
                                    <input type="hidden" name="form_id" value="0b98135">
                                    <input type="hidden" name="referer_title" value="Product Page">
                                    <input type="hidden" name="queried_id" value="491">
                                    <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">

                                    <div class="elementor-form-fields-wrapper elementor-labels-">
                                        @php
                                            $attributes = $productDetails['attributes'];
                                            $curStock = isset($attributes[0]) ? $attributes[0]['stock']:0;
                                        @endphp
                                        @if (count($attributes) > 0)
                                        <div class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-field_cfabe28 elementor-col-30 elementor-field-required">
                                            <label for="form-field-field_cfabe28" class="elementor-field-label elementor-screen-only" style="
                                                display: block !important;
                                                position: relative;
                                                top: 0;
                                                height: auto;
                                                width: auto;
                                                margin-bottom: 5px;">Variations</label>
                                            <div class="elementor-field elementor-select-wrapper remove-before ">
                                                <div class="select-caret-down-wrapper">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-eicon-caret-down" viewBox="0 0 571.4 571.4" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M571 393Q571 407 561 418L311 668Q300 679 286 679T261 668L11 418Q0 407 0 393T11 368 36 357H536Q550 357 561 368T571 393Z"></path>
                                                    </svg>			
                                                </div>
                                                <select name="variation" id="form-field-field_cfabe28" class="elementor-field-textual elementor-size-sm" aria-required="true">
                                                    @foreach ($attributes as $attribute)
                                                        @if (!is_null($attribute))
                                                        <option value="{{$attribute['id']}}" data-productStock="{{ $attribute['stock'] }}">{{$attribute['color']}} - {{$attribute['size']}} - ₱{{$attribute['price']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div style="height: 0; margin-bottom: 0;" class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_bcf74c7 elementor-col-100">
                                            <br>				
                                        </div>

                                        <div class="elementor-field-type-number elementor-field-group elementor-column elementor-field-group-name elementor-col-20 elementor-field-required" style="margin-bottom: 30px;">
                                            <label for="product-quantity" class="elementor-field-label">Quantity</label>
                                            <input
                                                type="number"
                                                name="quantity"
                                                id="product-quantity"
                                                class="elementor-field elementor-size-sm  elementor-field-textual"
                                                placeholder="1"
                                                required="required"
                                                aria-required="true"
                                                min="1"
                                                max="{{ $curStock }}"
                                                value="1"
                                            >
                                        </div>

                                        <div style="height: 0; margin-bottom: 0;" class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_bcf74c7 elementor-col-100">
                                            <br>				
                                        </div>

                                        <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-25 e-form__buttons elementor-md-60">
                                            <button type="submit" class="elementor-button elementor-size-sm">
                                                <span>
                                                    <span class="elementor-button-icon"></span>
                                                    <span class="elementor-button-text">ADD TO CART</span>
                                                </span>
                                            </button>
                                        </div>
                                        @else
                                        <div>No Stock</div>
                                        @endif
                                        @if (Auth::check())
                                        <div class="wishlist-btn">
                                            <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-25 e-form__buttons elementor-md-60">
                                                <button id="add-to-wishlist" type="button" class="elementor-button elementor-size-sm">
                                                    <span>
                                                        <span class="elementor-button-icon"></span>
                                                        <span class="elementor-button-text">ADD TO WISHLIST</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        @endif



                                    </div>
                                </form>
                            </div>
                        </div>

    
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    
    @include('front.products.ajax_related_products_listings')
    @if ($ratings->total() > 0)
    <div id="container-productreviews">
        @include('front.products.product_reviews')
    </div>
    @endif



</div>
<div class="post-tags"></div>
@endsection
