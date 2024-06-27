{{-- This page is accessed from My Account tab in the dropdown menu in the header (in front/layout/header.blade.php). Check userAccount() method in Front/UserController.php --}} 
@extends('front.layout.layout')


@section('content')
<div
    data-elementor-type="wp-page"
    data-elementor-id="843"
    class="elementor elementor-843"
    data-elementor-post-type="page"
>
<!-- POP UP CONTENT -->


    <div class="popup_review_order elementor-491">
        <div class="elementor-element elementor-element-1dc2f32 displayed-block">
            <form id="form-productReview" action="javascript:;" name="Write a review">

                @csrf
                @if (session('success_message'))
                    <div class="alert success">{{ session('success_message') }}</div>
                @endif

                <input type="hidden" name="post_id" value="491">
                <input type="hidden" name="form_id" value="1dc2f32">
                <input type="hidden" name="referer_title" value="Product Page">
                <input type="hidden" name="queried_id" value="491">
                <input type="hidden" name="product_id" value="">
                <div class="elementor-form-fields-wrapper elementor-labels-">
                    <div class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_e12c23e elementor-col-100">
                        <h3 style="text-align: center; margin-bottom: 0px; color: #5F7A61">
                            <b>Write a Review</b>
                        </h3>
                    </div>
                    <div class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-field_2c1b095 elementor-col-100">
                        <label style="text-align: center; width: 100%;">
                            <b>Rating</b>
                        </label>
                        <div class="rating">
                            <input
                                type="radio"
                                id="star5"
                                name="rating"
                                value="5"
                                checked
                            >
                            <label for="star5"></label>
                            <input
                                type="radio"
                                id="star4"
                                name="rating"
                                value="4"
                            >
                            <label for="star4"></label>
                            <input
                                type="radio"
                                id="star3"
                                name="rating"
                                value="3"
                            >
                            <label for="star3"></label>
                            <input
                                type="radio"
                                id="star2"
                                name="rating"
                                value="2"
                            >
                            <label for="star2"></label>
                            <input
                                type="radio"
                                id="star1"
                                name="rating"
                                value="1"
                            >
                            <label for="star1"></label>
                        </div>
                    </div>
                    <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-field_009055d elementor-col-100 elementor-field-required">
                        <label for="form-field-field_009055d" class="elementor-field-label elementor-screen-only"> 								Name</label>
                        <input
                            size="1"
                            type="text"
                            name="reviewer"
                            id="form-field-field_009055d"
                            class="elementor-field elementor-size-sm  elementor-field-textual"
                            placeholder="Name"
                            required="required"
                            aria-required="true"
                            value=""
                        >
                    </div>
                    <div class="elementor-field-type-checkbox elementor-field-group elementor-column elementor-field-group-field_ff7cdbc elementor-col-100">
                        <label for="form-field-field_ff7cdbc" class="elementor-field-label elementor-screen-only">Write as Anonymous</label>
                        <div class="elementor-field-subgroup  ">
                            <span class="elementor-field-option">
                                <input type="checkbox" value="Write as Anonymous" id="anonymousCheckbox" name="form_fields[field_ff7cdbc]"> 
                                <label for="anonymousCheckbox">Write as Anonymous</label>
                            </span>
                        </div>
                    </div>


                    <div class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
                        <label for="form-field-name" class="elementor-field-label elementor-screen-only"> 								Review Title</label>
                        <input
                            size="1"
                            type="text"
                            name="form_fields[name]"
                            id="form-field-name"
                            class="elementor-field elementor-size-sm  elementor-field-textual"
                            placeholder="Review Title"
                            required="required"
                            aria-required="true"
                        >
                    </div>
                    <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
                        <label for="form-field-email" class="elementor-field-label elementor-screen-only"> 								Review</label>
                        <textarea
                            class="elementor-field-textual elementor-field  elementor-size-sm"
                            name="review"
                            id="form-field-email"
                            rows="5"
                            placeholder="Write your comments here"
                            required="required"
                            aria-required="true"
                        ></textarea>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons" style="justify-content: center;">
                        <button type="submit" class="elementor-button elementor-size-sm">
                            <span>
                                <span class="elementor-button-icon"></span>
                                <span class="elementor-button-text">SUBMIT REVIEW</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
            
        </div>
        <a href="#" class="close_image_review_popup">X</a>
    </div>

    <div class="refund_popup_outer">
        <div class="refund_popup_inner">
            <h3 style="text-align: center; margin-bottom: 40px; color: #5F7A61"><b>Reason for Refund</b></h3>
            <form>
                <div class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-email elementor-col-100 elementor-field-required">
                    <label for="form-field-email" class="elementor-field-label elementor-screen-only">Reason</label>
                    <textarea class="elementor-field-textual elementor-field  elementor-size-sm" name="review" id="form-field-email" rows="5" placeholder="Write your reason here" required="required" aria-required="true"></textarea>
                </div>
                <div class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons" style="justify-content: center;">
                    <button type="submit" class="elementor-button elementor-size-sm refund__popup__btn">
                        <span>
                            <span class="elementor-button-icon"></span>
                            <span class="elementor-button-text">SUBMIT REFUND</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
        <a href="#" class="close_image_refund_popup">X</a>
    </div>



<!-- POP UP CONTENT -->
    <div
        class="elementor-element elementor-element-a808a63 e-flex e-con-boxed e-con e-parent"
        data-id="a808a63"
        data-element_type="container"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
        data-core-v316-plus="true"
    >
        <div class="e-con-inner">
            <div
                class="elementor-element elementor-element-9042c63 e-con-full e-flex e-con e-child"
                data-id="9042c63"
                data-element_type="container"
                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
            >
                <div
                    class="elementor-element elementor-element-f5f7679 elementor-widget__width-inherit elementor-invisible elementor-widget elementor-widget-heading"
                    data-id="f5f7679"
                    data-element_type="widget"
                    data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}"
                    data-widget_type="heading.default"
                >
                    <div class="elementor-widget-container">
                        <h1 class="elementor-heading-title elementor-size-default">ORDER DETAILS</h1>
                    </div>
                </div>
                <div
                    class="elementor-element elementor-element-7e92083 e-flex e-con-boxed e-con e-child"
                    data-id="7e92083"
                    data-element_type="container"
                    data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                >
                    <div class="e-con-inner">
                        <div
                            class="elementor-element elementor-element-7d962be e-con-full e-flex e-con e-child"
                            data-id="7d962be"
                            data-element_type="container"
                            data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                        >
                            <div
                                class="elementor-element elementor-element-0b40ac1 elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list"
                                data-id="0b40ac1"
                                data-element_type="widget"
                                data-widget_type="icon-list.default"
                            >
                                <div class="elementor-widget-container">
                                    <ul class="elementor-icon-list-items">
                                        <li class="elementor-icon-list-item">
                                            <a href="{{ url('user/account') }}">
                                                <span class="elementor-icon-list-icon">
                                                    <svg
                                                        aria-hidden="true"
                                                        class="e-font-icon-svg e-fas-user-alt"
                                                        viewbox="0 0 512 512"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path>
                                                    </svg>
                                                </span>
                                                <span class="elementor-icon-list-text">Profile</span>
                                            </a>
                                        </li>
                                        <li class="elementor-icon-list-item">
                                            <a href="{{ url('user/address') }}">
                                                <span class="elementor-icon-list-icon">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-map-marker-alt" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path>
                                                </svg>
                                                </span>
                                                <span class="elementor-icon-list-text">Addresses</span>
                                            </a>
                                        </li>
                                        <li class="elementor-icon-list-item">
                                            <a href="#">
                                                <span class="elementor-icon-list-icon">
                                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-lock" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z"></path>
                                                </svg>
                                                </span>
                                                <span class="elementor-icon-list-text">Change Password</span>
                                            </a>
                                        </li>
                                        <li class="elementor-icon-list-item">
                                            <a href="{{ url('user/orders') }}">
                                                <span class="elementor-icon-list-icon">
                                                    <svg
                                                        aria-hidden="true"
                                                        class="e-font-icon-svg e-fas-cart-arrow-down"
                                                        viewbox="0 0 576 512"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM403.029 192H360v-60c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v60h-43.029c-10.691 0-16.045 12.926-8.485 20.485l67.029 67.029c4.686 4.686 12.284 4.686 16.971 0l67.029-67.029c7.559-7.559 2.205-20.485-8.486-20.485z"></path>
                                                    </svg>
                                                </span>
                                                <span class="elementor-icon-list-text">Order List</span>
                                            </a>
                                        </li>
                                        <li class="elementor-icon-list-item">
                                            <a href="{{ url('user/chats') }}">
                                                <span class="elementor-icon-list-icon">
                                                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-comments" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M416 192c0-88.4-93.1-160-208-160S0 103.6 0 192c0 34.3 14.1 65.9 38 92-13.4 30.2-35.5 54.2-35.8 54.5-2.2 2.3-2.8 5.7-1.5 8.7S4.8 352 8 352c36.6 0 66.9-12.3 88.7-25 32.2 15.7 70.3 25 111.3 25 114.9 0 208-71.6 208-160zm122 220c23.9-26 38-57.7 38-92 0-66.9-53.5-124.2-129.3-148.1.9 6.6 1.3 13.3 1.3 20.1 0 105.9-107.7 192-240 192-10.8 0-21.3-.8-31.7-1.9C207.8 439.6 281.8 480 368 480c41 0 79.1-9.2 111.3-25 21.8 12.7 52.1 25 88.7 25 3.2 0 6.1-1.9 7.3-4.8 1.3-2.9.7-6.3-1.5-8.7-.3-.3-22.4-24.2-35.8-54.5z"></path>
                                                    </svg>
                                                </span>
                                                <span class="elementor-icon-list-text">Chats</span>
                                            </a>
                                        </li>
                                        <li class="elementor-icon-list-item">
                                            <a href="{{ url('user/logout') }}">
                                                <span class="elementor-icon-list-icon">
                                                    <svg
                                                        aria-hidden="true"
                                                        class="e-font-icon-svg e-fas-sign-out-alt"
                                                        viewbox="0 0 512 512"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                    >
                                                        <path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path>
                                                    </svg>
                                                </span>
                                                <span class="elementor-icon-list-text">Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div
                            class="elementor-element elementor-element-bc5a439 e-con-full e-flex e-con e-child"
                            data-id="bc5a439"
                            data-element_type="container"
                            data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                        >
                            <div
                                class="elementor-element e-flex e-con-boxed e-con e-child"
                                data-element_type="container"
                                data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                            >
                                <div class="e-con-inner">
                                    @foreach ($orders as $order)
                                    <div
                                        class="elementor-element e-flex e-con-boxed e-con e-child"
                                        data-element_type="container"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                    >
                                        <div class="e-con-inner">
                                            <div
                                                class="elementor-element elementor-element-f457259 elementor-widget elementor-widget-heading"
                                                data-id="f457259"
                                                data-element_type="widget"
                                                data-widget_type="heading.default"
                                            >
                                                <div class="elementor-widget-container">
                                                    <h6 class="elementor-heading-title elementor-size-default">ORDER ID:  &nbsp;
                                                        <span style="font-size: 26px; color: black;">{{$order->id}}​</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div
                                                class="elementor-element elementor-element-a61972a elementor-widget elementor-widget-heading"
                                                data-id="a61972a"
                                                data-element_type="widget"
                                                data-widget_type="heading.default"
                                            >
                                                <div class="elementor-widget-container">
                                                    <h6 class="elementor-heading-title elementor-size-default">STATUS:  &nbsp;
                                                        <span style="font-size: 15px; color: black;">{{$order->order_status}}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            @php
                                                $orders_subtotal = 0;
                                            @endphp
                                            @foreach ($order->orders_products as $product)
                                            @php
                                                $product_image_path = $getImage("front/images/product_images/small/", $product['product_image']);
                                            @endphp
                                            <div
                                                class="elementor-element elementor-element-958a31e e-con-full e-flex e-con e-child"
                                                data-id="958a31e"
                                                data-element_type="container"
                                                data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                            >
                                                <div
                                                    class="elementor-element elementor-element-c298c94 e-con-full e-flex e-con e-child"
                                                    data-id="c298c94"
                                                    data-element_type="container"
                                                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                                >
                                                    <div
                                                        class="elementor-element elementor-element-8fec39b elementor-widget elementor-widget-image"
                                                        data-id="8fec39b"
                                                        data-element_type="widget"
                                                        data-widget_type="image.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                        @if (!empty($product->product->product_image) && file_exists($product_image_path))
                                                        {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
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
                                                        @else
                                                        {{-- show the dummy image --}}
                                                        <img
                                                            loading="lazy"
                                                            decoding="async"
                                                            width="800"
                                                            height="968"
                                                            src="{{ $getImage('front/images/product/', 'no-available-image.jpg') }}"
                                                            class="attachment-large size-large wp-image-422"
                                                            alt=""
                                                            srcset="{{ $getImage('front/images/product/', 'no-available-image.jpg') }} 846w, {{ $getImage('front/images/product/', 'no-available-image.jpg') }} 248w, {{ $getImage('front/images/product/', 'no-available-image.jpg') }} 768w, {{ $getImage('front/images/product/', 'no-available-image.jpg') }} 879w"
                                                            sizes="(max-width: 800px) 100vw, 800px"
                                                        >
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="elementor-element elementor-element-96bb8db e-con-full e-flex e-con e-child"
                                                    data-id="96bb8db"
                                                    data-element_type="container"
                                                    data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                                >
                                                    <div
                                                        class="elementor-element elementor-element-3d675a4 e-con-full e-flex e-con e-child"
                                                        data-id="3d675a4"
                                                        data-element_type="container"
                                                        data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                                    >
                                                        <div
                                                            class="elementor-element elementor-element-505857f elementor-widget elementor-widget-heading"
                                                            data-id="505857f"
                                                            data-element_type="widget"
                                                            data-widget_type="heading.default"
                                                        >
                                                            <div class="elementor-widget-container">
                                                                <h6 class="elementor-heading-title elementor-size-default">{{$product->product->category->category_name}}</h6>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="elementor-element elementor-element-808d4bd elementor-widget elementor-widget-heading"
                                                            data-id="808d4bd"
                                                            data-element_type="widget"
                                                            data-widget_type="heading.default"
                                                        >
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default">{{$product->product_name}}</h2>
                                                            </div>
                                                        </div>

                                                        <div class="elementor-element elementor-element-777x2zz elementor-widget elementor-widget-heading">
                                                            <div class="btn--wrapper">
                                                                <a class="review--btn" href="#">Product Review</a>
                                                                <a class="received--btn" href="#">Order Received</a>
                                                                <a class="refund--btn" href="#">Refund</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-03a8e1a e-con-full e-flex e-con e-child"
                                                        data-id="03a8e1a"
                                                        data-element_type="container"
                                                        data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;container_type&quot;:&quot;flex&quot;}"
                                                    >
                                                        <div
                                                            class="elementor-element elementor-element-094ee91 elementor-widget elementor-widget-heading"
                                                            data-id="094ee91"
                                                            data-element_type="widget"
                                                            data-widget_type="heading.default"
                                                        >
                                                            <div class="elementor-widget-container">
                                                                <h2 class="elementor-heading-title elementor-size-default">{{$product->product_qty}} x
                                                                    <b>₱{{$product->product_price}}</b>
                                                                </h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $orders_subtotal += ($product->product_price * $product->product_qty);
                                            @endphp
                                            @endforeach
                                            <div
                                                class="elementor-element elementor-element-f0891eb e-flex e-con-boxed e-con e-child"
                                                data-id="f0891eb"
                                                data-element_type="container"
                                                data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                            >
                                                <div class="e-con-inner">
                                                    <div
                                                        class="elementor-element elementor-element-6250c06 elementor-widget elementor-widget-text-editor"
                                                        data-id="6250c06"
                                                        data-element_type="widget"
                                                        data-widget_type="text-editor.default"
                                                    >
                                                        <div class="elementor-widget-container">
                                                            <p>Placed on
                                                                <strong>{{date_format(date_create($order->created_at), 'M d, Y h:i a')}}</strong>
                                                                <br>Payment Method
                                                                <strong>{{$order->payment_method}}
                                                                    <br>
                                                                </strong>Tracking Number
                                                                <strong>{{$order->tracking_number}}</strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-e203980 e-flex e-con-boxed e-con e-child"
                                                        data-id="e203980"
                                                        data-element_type="container"
                                                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                                    >
                                                        <div class="e-con-inner">
                                                            <div
                                                                class="elementor-element elementor-element-0f2e57f elementor-widget elementor-widget-text-editor"
                                                                data-id="0f2e57f"
                                                                data-element_type="widget"
                                                                data-widget_type="text-editor.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <p>Subtotal</p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="elementor-element elementor-element-75f3293 elementor-widget elementor-widget-text-editor"
                                                                data-id="75f3293"
                                                                data-element_type="widget"
                                                                data-widget_type="text-editor.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <p>₱ {{$orders_subtotal}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-6ea91c2 e-flex e-con-boxed e-con e-child"
                                                        data-id="6ea91c2"
                                                        data-element_type="container"
                                                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                                    >
                                                        <div class="e-con-inner">
                                                            <div
                                                                class="elementor-element elementor-element-901d3f1 elementor-widget elementor-widget-text-editor"
                                                                data-id="901d3f1"
                                                                data-element_type="widget"
                                                                data-widget_type="text-editor.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <p>Shipping Fee</p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="elementor-element elementor-element-350db39 elementor-widget elementor-widget-text-editor"
                                                                data-id="350db39"
                                                                data-element_type="widget"
                                                                data-widget_type="text-editor.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <p>₱ {{$order->shipping_charges}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="elementor-element elementor-element-3310012 e-flex e-con-boxed e-con e-child"
                                                        data-id="3310012"
                                                        data-element_type="container"
                                                        data-settings="{&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
                                                    >
                                                        <div class="e-con-inner">
                                                            <div
                                                                class="elementor-element elementor-element-9a4b6f3 elementor-widget elementor-widget-text-editor"
                                                                data-id="9a4b6f3"
                                                                data-element_type="widget"
                                                                data-widget_type="text-editor.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <p>Total</p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="elementor-element elementor-element-35fb713 elementor-widget elementor-widget-text-editor"
                                                                data-id="35fb713"
                                                                data-element_type="widget"
                                                                data-widget_type="text-editor.default"
                                                            >
                                                                <div class="elementor-widget-container">
                                                                    <p>₱{{number_format($order->grand_total)}}</p>
                                                                </div>
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
                            
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection