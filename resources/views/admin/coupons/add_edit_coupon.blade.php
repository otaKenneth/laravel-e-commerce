{{-- Variables are passed in from the addEditCoupon() method in Admin/CouponsController --}}
@extends('admin.layout.layout')


@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-xl-12">
                        <h4 class="card-title">Coupons</h4>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card mobile-space-top">
                <button class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>


                        {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        @if (Session::has('error_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif



                        {{-- Displaying Laravel Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors --}}
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">


                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif



                        {{-- Displaying The Validation Errors: https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors AND https://laravel.com/docs/9.x/blade#validation-errors --}}
                        {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                        {{-- Our Bootstrap success message in case of updating admin password is successful: --}}
                        @if (Session::has('success_message')) <!-- Check AdminController.php, updateAdminPassword() method -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif



                        <form class="forms-sample" @if (empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/' . $coupon['id']) }}" @endif method="post" enctype="multipart/form-data"> <!-- If the id is not passed in from the route, this measn 'Add a new Coupon', but if the id is passed in from the route, this means 'Edit the Coupon' --> <!-- Using the enctype="multipart/form-data" to allow uploading files (images) -->
                            @csrf

                            @if (empty($coupon['coupon_code'])) {{-- In case of 'Add a new Coupon' --}}
                            <div class="form-group">
                                <label for="coupon_option">Coupon Option:</label><br>
                                <span><input type="radio" id="AutomaticCoupon" name="coupon_option" value="Automatic" checked>&nbsp;Automatic&nbsp;&nbsp;</span>
                                <span><input type="radio" id="ManualCoupon" name="coupon_option" value="Manual">&nbsp;Manual&nbsp;&nbsp;</span>
                            </div>
                            <div class="form-group" style="display: none" id="couponField"> {{-- We used style="display: none" and created that id="couponField" to be used as handle in jQuery to show/hide that field depending on the previous checked Coupon Option, chekc admin/js/custom.js --}}
                                <label for="coupon_code">Coupon Code:</label>
                                <input type="text" class="form-control" placeholder="Enter Coupon Code" name="coupon_code">
                            </div>
                            @else {{-- In case of 'Update the Coupon' --}}
                            <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                            <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">

                            <div class="form-group">
                                <label for="coupon_code">Coupon Code:</label>
                                <span style="color: green; font-weight: bold">{{ $coupon['coupon_code'] }}</span>
                            </div>
                            @endif


                            <div class="form-group">
                                <label for="coupon_type">Coupon Type:</label><br>
                                <span><input type="radio" name="coupon_type" value="Multiple Times" @if (isset($coupon['coupon_type']) && $coupon['coupon_type']=='Multiple Times' ) checked @endif>&nbsp;Multiple Times&nbsp;&nbsp;</span>
                                <span><input type="radio" name="coupon_type" value="Single Time" @if (isset($coupon['coupon_type']) && $coupon['coupon_type']=='Single Time' ) checked @endif>&nbsp;Single Time&nbsp;&nbsp;</span>
                            </div>
                            <div class="form-group">
                                <label for="amount_type">Amount Type:</label><br>
                                <span><input type="radio" name="amount_type" value="Percentage" @if (isset($coupon['amount_type']) && $coupon['amount_type']=='Percentage' ) checked @endif>&nbsp;Percentage&nbsp;(in %)&nbsp;</span>
                                <span><input type="radio" name="amount_type" value="Fixed" @if (isset($coupon['amount_type']) && $coupon['amount_type']=='Fixed' ) checked @endif>&nbsp;Fixed&nbsp;(in PHP)</span>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="text" class="form-control" id="amount" placeholder="Enter Coupon Amount" name="amount" @if (isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @else value="{{ old('amount') }}" @endif> {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                            </div>



                            <div class="form-group relative">
                                <label for="categorySelection" class="block font-medium text-gray-700 mb-2">Select Coupon
                                    Scope:</label>
                            
                                <div class="flex space-x-2 mb-4">
                                    <button type="button"
                                        class="filter-btn px-3 py-2 text-sm border rounded-md focus:outline-none bg-indigo-500 text-white shadow-sm">All</button>
                                    <button type="button"
                                        class="filter-btn px-3 py-2 text-sm border rounded-md focus:outline-none text-gray-700 bg-white shadow-sm hover:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        data-filter="category">Category</button>
                                    <button type="button"
                                        class="filter-btn px-3 py-2 text-sm border rounded-md focus:outline-none text-gray-700 bg-white shadow-sm hover:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        data-filter="subcategory">Sub-category</button>
                                </div>
                            
                                <div class="w-full max-h-72 overflow-y-auto border rounded-md shadow-sm bg-white">
                                    <div class="p-3">
                                        <input type="text" placeholder="Search Categories..." id="categorySearch"
                                            class="w-full px-3 py-2 mb-3 border rounded-md shadow-inner text-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            
                                        @foreach ($categories as $section)
                                            <div class="px-2 pt-2 pb-1 text-gray-800 font-semibold text-sm uppercase tracking-wide">
                                                {{ $section['name'] }}</div>
                                            @foreach ($section['categories'] as $category)
                                                <label class="block px-4 py-2 text-gray-700 text-sm hover:bg-gray-50 cursor-pointer">
                                                    <input type="checkbox"
                                                        class="category-checkbox category-option mr-2 rounded border-gray-300 text-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"
                                                        name="categories[]" value="{{ $category['id'] }}"
                                                        @if (in_array($category['id'], $selCats)) checked @endif>
                                                    {{ $category['category_name'] }}
                                                </label>
                                                @foreach ($category['sub_categories'] as $subcategory)
                                                    <label class="block px-6 py-2 text-gray-700 text-sm hover:bg-gray-50 cursor-pointer">
                                                        <input type="checkbox"
                                                            class="category-checkbox subcategory-option mr-2 rounded border-gray-300 text-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"
                                                            name="categories[]" value="{{ $subcategory['id'] }}"
                                                            @if (in_array($subcategory['id'], $selCats)) checked @endif>
                                                        <span class="ml-1 text-xs text-gray-600">— {{ $subcategory['category_name'] }}</span>
                                                    </label>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    const filterButtons = document.querySelectorAll(".filter-btn");
                                    const checkboxes = document.querySelectorAll(".category-checkbox");
                                    const searchInput = document.getElementById("categorySearch");
                            
                                    filterButtons.forEach(button => {
                                        button.addEventListener("click", function() {
                                            filterButtons.forEach(btn => btn.classList.remove("bg-indigo-500", "text-white", "shadow-sm"));
                                            filterButtons.forEach(btn => btn.classList.add("text-gray-700", "bg-white", "hover:border-indigo-300", "focus:ring", "focus:ring-indigo-200", "focus:ring-opacity-50"));
                                            this.classList.add("bg-indigo-500", "text-white", "shadow-sm");
                            
                                            const filter = this.getAttribute("data-filter");
                                            checkboxes.forEach(cb => {
                                                const label = cb.closest("label");
                                                label.style.display = "block";
                                                if (filter === "category" && cb.classList.contains("subcategory-option")) {
                                                    label.style.display = "none";
                                                } else if (filter === "subcategory" && !cb.classList.contains("subcategory-option")) {
                                                    label.style.display = "none";
                                                }
                                            });
                                        });
                                    });
                            
                                    searchInput.addEventListener("input", function() {
                                        const query = this.value.toLowerCase();
                                        checkboxes.forEach(cb => {
                                            const label = cb.closest("label");
                                            const text = label.textContent.toLowerCase();
                                            label.style.display = text.includes(query) ? "block" : "none";
                                        });
                                    });
                                });
                            </script>



                            <div class="form-group hide">
                                <label for="brands">Select Brand:</label>
                                <select name="brands[]" class="form-control text-dark" multiple> {{-- "multiple" HTML attribute: https://www.w3schools.com/tags/att_multiple.asp --}} {{-- We used the Square Brackets [] in name="brands[]" is an array because we used the "multiple" HTML attribute to be able to choose multiple brands (more than one brand) at the same time --}}
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand['id'] }}" selected>{{ $brand['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group hide">
                                <label for="users">Select User (by email):</label>
                                <select name="users[]" class="form-control text-dark" multiple> {{-- "multiple" HTML attribute: https://www.w3schools.com/tags/att_multiple.asp --}} {{-- We used the Square Brackets [] in name="users[]" is an array because we used the "multiple" HTML attribute to be able to choose multiple users (more than one user) at the same time --}}
                                    @foreach ($users as $user)
                                    <option value="{{ $user['email'] }}"
                                        @if ($title=='Add Coupon' )
                                        selected
                                        @else
                                        @if (in_array($user['email'], $selUsers))
                                        selected
                                        @endif
                                        @endif>{{ $user['email'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date:</label> {{-- Coupon Expiry Date --}}
                                <input type="date" class="form-control" id="expiry_date" placeholder="Enter Expiry Date" name="expiry_date" @if (isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @else value="{{ old('expiry_date') }}" @endif> {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                            </div>


                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection