{{-- Note: listing.blade.php is the page (rendered by listing() method in Front/ProductsController.php) that opens when you click on a category in the FRONT home page --}}
@extends('front.layout.layout')


@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Shop</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="listing.html">Shop</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->

    <!-- Shop-Page -->
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <!-- Shop-Intro -->
            <div class="shop-intro">
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <a href="{{ url('/') }}">Home</a>
                    </li>


                    {{-- Breadcrumbs --}}
                    @php echo $categoryDetails['breadcrumbs']; @endphp



                </ul>
            </div>
            <!-- Shop-Intro /- -->
            <div class="row">



                {{-- Include the listing page sidebar (Products filters (size, color, ...)) --}}
                @include('front.products.filters')



                <!-- Shop-Right-Wrapper -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <!-- Page-Bar -->
                    <div class="page-bar clearfix">

                    </div>
                    @if (isset($_REQUEST['search']) && count($suggestedResults) > 0)
                        <section class="suggested-results u-s-p-b-50">
                            <h2>You might also be interested in:</h2>
                            <div class="row">
                                @foreach ($suggestedResults as $product)
                                    <div class="col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                                        <div class="product-h">
                                            <a class="product-h__img-link" href="{{ url('product/' . $product['id']) }}">
                                                @php
                                                    $product_image_path =
                                                        'front/images/product_images/small/' .
                                                        $product['product_image'];
                                                @endphp
                                                @if (!empty($product['product_image']) && file_exists($product_image_path))
                                                    <img class="img-fluid" src="{{ asset($product_image_path) }}"
                                                        alt="{{ $product['product_name'] }}">
                                                @else
                                                    <img class="img-fluid"
                                                        src="{{ asset('front/images/product/no-available-image.jpg') }}"
                                                        alt="Product">
                                                @endif
                                            </a>
                                            <div class="product-h__info">
                                                <div class="rate-product">
                                                    {{-- You can add rating here if available --}}
                                                </div>
                                                <span class="product-h__name"> <a
                                                        href="{{ url('product/' . $product['id']) }}">{{ $product['product_name'] }}</a>
                                                </span>
                                                <span class="product-h__price">
                                                    @php $discountedPrice = \App\Models\Product::getDiscountPrice($product['id']); @endphp
                                                    @if ($discountedPrice < $product['product_price'])
                                                        <span class="product-h__price-new">₱{{ $discountedPrice }}</span>
                                                        <span
                                                            class="product-h__price-old">₱{{ $product['product_price'] }}</span>
                                                    @else
                                                        <span
                                                            class="product-h__price-new">₱{{ $product['product_price'] }}</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        <hr class="u-s-m-b-50">
                    @endif


                    {{-- If the Search Form is not used for searching in front/layout/header.blade.php. Note that Filters will be hidden and won't work in case of using the Search Form --}}
                    @if (!isset($_REQUEST['search']))
                        <!-- Toolbar Sorter 1  -->
                        {{-- Sorting Filter WITHOUT AJAX (using HTML <form> and jQuery). Check front/js/custom.js file for the related script --}}
                        {{-- Sidenote: There are TWO ways to submit a <form> to the backed: firstly, the regular one using the <button type="submit">, secondly, using AJAX by sending the "value" attributes of the <input> fields --}}
                        <form name="sortProducts" id="sortProducts"> {{-- Absence of the "action" attribute means submitting the <form> data to the same page, and absence of "method" attribute means the <form> uses the default "method" which is "GET" --}}

                            {{-- Sorting Filter WITH AJAX. Check ajax_products_listing.blade.php --}}
                            <input type="hidden" name="url" id="url" value="{{ $url }}">
                            {{-- $url is passed in from listing() method in Front/ProductsController.php --}}

                            <div class="toolbar-sorter">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="sort-by">Sort By</label>
                                    <select name="sort" id="sort" class="select-box">
                                        {{-- <option selected="selected" value="">Sort By: Best Selling</option> --}}
                                        <option value="" selected>Select</option>
                                        <option value="product_latest" @if (isset($_GET['sort']) && $_GET['sort'] == 'product_latest') selected @endif>
                                            Sort By: Latest</option>
                                        <option value="price_lowest" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_lowest') selected @endif>Sort
                                            By: Lowest Price</option>
                                        <option value="price_highest" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_highest') selected @endif>Sort
                                            By: Highest Price</option>
                                        <option value="name_a_z" @if (isset($_GET['sort']) && $_GET['sort'] == 'name_a_z') selected @endif>Sort By:
                                            Name A - Z</option>
                                        <option value="name_z_a" @if (isset($_GET['sort']) && $_GET['sort'] == 'name_z_a') selected @endif>Sort By:
                                            Name Z - A</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <!-- //end Toolbar Sorter 1  -->
                    @endif



                    <!-- Toolbar Sorter 2  -->
                    <div class="toolbar-sorter-2">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="show-records">Show Records Per Page</label>
                            <select class="select-box" id="show-records">
                                <option selected="selected" value="">Showing: {{ count($categoryProducts) }}</option>
                                <option value="">Showing: All</option>
                            </select>
                        </div>
                    </div>
                    <!-- //end Toolbar Sorter 2  -->
                </div>
                <!-- Page-Bar /- -->


                <!-- Row-of-Product-Container -->

                {{-- Sorting Filter WITH AJAX. Check ajax_products_listing.blade.php --}}
                <div class="filter_products">
                    @include('front.products.ajax_products_listing')
                </div>

                <!-- Row-of-Product-Container /- -->



                {{-- Laravel Pagination and showing it using Bootstrap Pagination --}}
                {{-- <div>{{ $categoryProducts->links() }}</div> --}}



                {{-- If the Search Form is not used for searching in front/layout/header.blade.php. Note that Filters will be hidden and won't work in case of using the Search Form --}}
                @if (!isset($_REQUEST['search']))
                    {{-- Fixing the Laravel Pagination problem with the Sorting Filter where sorting gets messed up with pagination). The cause of the problem is that when you click on the pagination links like for example when you go to the second page, the URL query string parameters gets the pagination page number (e.g. 'page=2') but it loses the filter query string parameter (e.g. '&sort=desc'), so we have to always append the sorting filter query string parameter to the page number query string paramter  --}}
                    {{-- Appending Query String Values: https://laravel.com/docs/9.x/pagination#appending-query-string-values --}}
                    @if (isset($_GET['sort']))
                        {{-- if there's a Sorting Filter used --}}
                        <div>
                            {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }} {{-- Appending Query String Values: https://laravel.com/docs/9.x/pagination#appending-query-string-values --}}
                            {{-- Displaying Pagination Results: https://laravel.com/docs/9.x/pagination#displaying-pagination-results --}}
                        </div>
                    @else
                        <div>
                            {{ $categoryProducts->links() }} {{-- Displaying Pagination Results: https://laravel.com/docs/9.x/pagination#displaying-pagination-results --}}
                        </div>
                    @endif
                @endif


                <div>&nbsp;</div>

                {{-- Show the category and subcategory description --}}
                <div>{{ $categoryDetails['categoryDetails']['description'] }}</div>



            </div>
            <!-- Shop-Right-Wrapper /- -->


            <!-- Shop-Pagination -->


            <!-- Shop-Pagination /- -->


        </div>
    </div>
    </div>
    <!-- Shop-Page /- -->
@endsection
