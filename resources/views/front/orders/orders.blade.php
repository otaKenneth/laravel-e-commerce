{{-- This page is accessed from My Account tab in the dropdown menu in the header (in front/layout/header.blade.php). Check userAccount() method in Front/UserController.php --}} 
@extends('front.users.profile')

@section('user_account_content')

@php
    $account_page = 'user_orders';
@endphp

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
                class="order-container-outer elementor-element e-flex e-con-boxed e-con e-child"
                data-element_type="container"
                data-order_id="{{$order->id}}"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;container_type&quot;:&quot;flex&quot;,&quot;content_width&quot;:&quot;boxed&quot;}"
            >
                <div class="e-con-inner">
                    <div
                        class="order-id-and-cancel elementor-element elementor-element-f457259 elementor-widget elementor-widget-heading"
                        data-id="f457259"
                        data-element_type="widget"
                        data-widget_type="heading.default"
                    >
                        <div class="elementor-widget-container">
                            <h6 class="elementor-heading-title elementor-size-default">ORDER ID:  &nbsp;
                                <span style="font-size: 26px; color: black;">{{$order->id}}</span>
                            </h6>
                        </div>
                        @if (in_array($order->order_status, ['1', 'New', 'Pending', 'In Progress']))
                        <div class="elementor-widget-container">
                            <a href="#" class="cancel-order-btn">Cancel Order</a>
                        </div>
                        @endif
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
                                    <div>
                                        <label>{{$product->item_status}}</label>
                                    </div>
                                    <div class="btn--wrapper">
                                        @if ($product->item_status === "Delivered")
                                            <a class="review--btn" data-product_id="{{$product->product_id}}" href="#">Product Review</a>
                                            <a class="refund--btn" data-order_id="{{$order->id}}" data-order_item_id="{{$product->id}}" data-product_id="{{$product->product_id}}" href="#">Refund</a>
                                        @elseif ($product->item_status === "Shipped")
                                            <a class="received--btn" data-order_id="{{$order->id}}" data-order_item_id="{{$product->id}}" data-product_id="{{$product->product_id}}">Order Received</a>
                                        @endif
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
                                            <b>₱{{number_format($product->product_price, 2)}}</b>
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


<!-- POP UP CONTENT -->

<!-- Modal -->
@include('front.orders.review_dialog')
@include('front.orders.refund_dialog')

<!-- POP UP CONTENT -->
@endsection