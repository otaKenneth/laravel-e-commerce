{{-- This page is rendered by orders() method inside Admin/OrderController.php --}}
@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card mobile-space-top">
                    <button
                        class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                        type="button" data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Orders</h4>



                            <div class="table-responsive pt-3">
                                {{-- DataTable --}}
                                <table id="orders" class="table table-bordered"> {{-- using the id here for the DataTable --}}
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Order Image</th>
                                            <th>Customer Name</th>
                                            <th>Customer Email</th>
                                            <th>Ordered Products</th>
                                            <th>Order Amount</th>
                                            <th>Order Status</th>
                                            <th>Shipping Method</th>
                                            <th>Payment Method</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // dd($orders); // check if the authenticated/logged-in user is 'vendor' (show ONLY orders of products belonging to them), or 'admin' (show ALL orders)
                                            $sortedOrders = collect($orders)->sortByDesc('created_at');
                                        @endphp
                                        @foreach ($sortedOrders as $order)
                                            @if ($order['orders_products'])
                                                {{-- If the 'vendor' has ordered products (if a 'vendor' product has been ordered), show them. Check how we constrained the eager loads using a subquery in orders() method in Admin/OrderController.php inside the if condition --}}
                                                <tr>
                                                    <td>{{ $order['id'] }}</td>
                                                    <td>{{ date('Y-m-d h:i:s', strtotime($order['created_at'])) }}</td>
                                                    <td>
                                                        <div class="custom-image-slider">
                                                            <div class="custom-slider" id="slider">
                                                                @foreach ($order['orders_products'] as $key => $product)
                                                                    <img src="{{ $getImage('front/images/product_images/small/', $product['product']['product_image']) }}"
                                                                        class="{{ $key != 0 ? 'd-none' : '' }} product-image"
                                                                        data-key="{{ $key }}"
                                                                        style="width:120px; height:100px; object-fit: cover; margin-right: 10px;"
                                                                        alt="{{ $product['product']['product_image'] }}">
                                                                @endforeach
                                                            </div>
                                                            @if (count($order['orders_products']) > 1)
                                                                <button class="custom-prev">❮</button>
                                                                <button class="custom-next">❯</button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>{{ $order['name'] }}</td>
                                                    <td>{{ $order['email'] }}</td>
                                                    <td>
                                                        @foreach ($order['orders_products'] as $product)
                                                            {{ $product['product_code'] }} ({{ $product['product_qty'] }})
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                    <td>₱&nbsp;{{ number_format($order['grand_total'], 2) }}</td>
                                                    <td>{{ $order['order_status'] }}</td>
                                                    <td>{{ strtoupper($order['shipping_method']) }}</td>
                                                    <td>{{ $order['payment_method'] }}</td>
                                                    <td>
                                                        <a title="View Order Details"
                                                            href="{{ url('admin/orders/' . $order['id']) }}">
                                                            <i style="font-size: 25px" class="mdi mdi-file-document"></i>
                                                            {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                        &nbsp;&nbsp;

                                                        {{-- View HTML invoice --}}
                                                        <a title="View Order Invoice"
                                                            href="{{ url('admin/orders/invoice/' . $order['id']) }}"
                                                            target="_blank">
                                                            <i style="font-size: 25px" class="mdi mdi-printer"></i>
                                                            {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                        &nbsp;&nbsp;

                                                        {{-- View PDF invoice --}}
                                                        <a title="Print PDF Invoice"
                                                            href="{{ url('admin/orders/invoice/pdf/' . $order['id']) }}"
                                                            target="_blank">
                                                            <i style="font-size: 25px" class="mdi mdi-file-pdf"></i>
                                                            {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. All rights
                    reserved.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <style>
        .custom-image-slider {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
        }

        .custom-slider {
            display: flex;
            transition: transform 0.5s ease;
        }

        .custom-prev,
        .custom-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .custom-prev {
            left: 0;
        }

        .custom-next {
            right: 0;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $currentSlide = 0;
            $totalSlides = $('.product-image').length;

            $('.custom-prev').on('click', function() {
                if ($currentSlide > 0) {
                    $currentSlide--;
                    $('.product-image').addClass('d-none');
                    $('.product-image').eq($currentSlide).removeClass('d-none');
                }
            });

            $('.custom-next').on('click', function() {
                if ($totalSlides > $currentSlide + 1) {
                    $currentSlide++;
                    $('.product-image').addClass('d-none');
                    $('.product-image').eq($currentSlide).removeClass('d-none');
                }
            });
        });
    </script>
@endsection
