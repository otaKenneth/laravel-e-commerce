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
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
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
                    <button
                        class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                        type="button" data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $title }}</h4>


                            {{-- Our Bootstrap error code in case of wrong current password or the new password and confirm password are not matching: --}}
                            {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                            @if (Session::has('error_message'))
                                <!-- Check AdminController.php, updateAdminPassword() method -->
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
                            @if (Session::has('success_message'))
                                <!-- Check AdminController.php, updateAdminPassword() method -->
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif



                            <form class="forms-sample"
                                @if (empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/' . $coupon['id']) }}" @endif
                                method="post" enctype="multipart/form-data">
                                <!-- If the id is not passed in from the route, this measn 'Add a new Coupon', but if the id is passed in from the route, this means 'Edit the Coupon' -->
                                <!-- Using the enctype="multipart/form-data" to allow uploading files (images) -->
                                @csrf

                                @if (empty($coupon['coupon_code'])) {{-- In case of 'Add a new Coupon' --}}
                                    <div class="form-group">
                                        <label for="coupon_option">Coupon Option:</label><br>
                                        <span><input type="radio" id="AutomaticCoupon" name="coupon_option"
                                                value="Automatic" checked>&nbsp;Automatic&nbsp;&nbsp;</span>
                                        <span><input type="radio" id="ManualCoupon" name="coupon_option"
                                                value="Manual">&nbsp;Manual&nbsp;&nbsp;</span>
                                    </div>
                                    <div class="form-group" style="display: none" id="couponField"> {{-- We used style="display: none" and created that id="couponField" to be used as handle in jQuery to show/hide that field depending on the previous checked Coupon Option, chekc admin/js/custom.js --}}
                                        <label for="coupon_code">Coupon Code:</label>
                                        <input type="text" class="form-control" placeholder="Enter Coupon Code"
                                            name="coupon_code">
                                    </div>
                                @else
                                    {{-- In case of 'Update the Coupon' --}}
                                    <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                                    <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">

                                    <div class="form-group">
                                        <label for="coupon_code">Coupon Code:</label>
                                        <span style="color: green; font-weight: bold">{{ $coupon['coupon_code'] }}</span>
                                    </div>
                                @endif


                                <div class="form-group">
                                    <label for="coupon_type">Coupon Type:</label><br>
                                    <span><input type="radio" name="coupon_type" value="Multiple Times"
                                            @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Multiple Times') checked @endif>&nbsp;Multiple
                                        Times&nbsp;&nbsp;</span>
                                    <span><input type="radio" name="coupon_type" value="Single Time"
                                            @if (isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Single Time') checked @endif>&nbsp;Single
                                        Time&nbsp;&nbsp;</span>
                                </div>
                                <div class="form-group">
                                    <label for="amount_type">Amount Type:</label><br>
                                    <span><input type="radio" name="amount_type" value="Percentage"
                                            @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Percentage') checked @endif>&nbsp;Percentage&nbsp;(in
                                        %)&nbsp;</span>
                                    <span><input type="radio" name="amount_type" value="Fixed"
                                            @if (isset($coupon['amount_type']) && $coupon['amount_type'] == 'Fixed') checked @endif>&nbsp;Fixed&nbsp;(in
                                        PHP)</span>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                    <input type="text" class="form-control" id="amount"
                                        placeholder="Enter Coupon Amount" name="amount"
                                        @if (isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @else value="{{ old('amount') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                </div>


                                <div class="form-group">
                                    <label for="categoryDropdown">Select Coupon Scope:</label>
                                    <div class="dropdown" style="position: relative; width: 100%;">
                                        <button class="btn btn-secondary dropdown-toggle form-control text-dark"
                                            type="button" id="categoryDropdown" data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                            style="border-radius: 0.25rem; padding: .4375rem .75rem; background-color: #ffffff; text-align: left;">
                                            Select Category
                                        </button>
                                
                                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown"
                                            style="min-width: 200px; width: 50%; border-radius: 0.25rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 0; background-color: #fff; border: 1px solid #ddd; text-align: left;">
                                            @foreach ($categories as $section)
                                                <li class="dropdown-submenu position-relative" style="list-style-type: none;">
                                                    <a class="dropdown-item dropdown-toggle" href="#" 
                                                        data-id="{{ $section['id'] }}" data-type="section" 
                                                        style="padding: 10px 15px; color: black;">
                                                        {{ $section['name'] }}
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        @foreach ($section['categories'] as $category)
                                                            <li class="dropdown-submenu position-relative">
                                                                <a class="dropdown-item dropdown-toggle" href="#" 
                                                                    data-id="{{ $category['id'] }}" data-type="category"
                                                                    style="padding: 10px 15px;">
                                                                    {{ $category['category_name'] }}
                                                                </a>
                                                                @if (!empty($category['sub_categories']))
                                                                    <ul class="dropdown-menu">
                                                                        @foreach ($category['sub_categories'] as $subcategory)
                                                                            <li>
                                                                                <a class="dropdown-item category-option" href="#" 
                                                                                    data-id="{{ $subcategory['id'] }}" data-type="subcategory"
                                                                                    style="padding: 10px 15px;">
                                                                                    {{ $subcategory['category_name'] }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <!-- Hidden input to store selected category or subcategory -->
                                        <input type="hidden" name="categories[]" id="selectedCategory">

                                        <!-- Checkbox for "Apply to all categories" -->
                                        <div class="text-right pt-2">
                                            <label class="text-sm text-gray-600">
                                                <input type="checkbox" id="selectAllCategories" class="mr-1"> Apply to
                                                all categories
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    .dropdown-menu {
                                        min-width: 200px;
                                        width: 50%;
                                        border-radius: 0.25rem;
                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                        padding: 0;
                                        background-color: #fff;
                                        border: 1px solid #ddd;
                                        text-align: left;
                                        color: black;
                                    }

                                    /* Ensures that submenus align neatly with their parent */
                                    .dropdown-submenu {
                                        position: relative;
                                    }

                                    .dropdown-submenu .dropdown-menu {
                                        position: absolute;
                                        left: 100%;
                                        top: 0;
                                        margin-left: -1px;
                                        /* Helps prevent gaps */
                                        min-width: 200px;
                                        background-color: #f8f9fa;
                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                        border-radius: 0.25rem;
                                    }

                                    /* Keeps submenu aligned with the parent category */
                                    .dropdown-submenu:hover>.dropdown-menu {
                                        display: block;
                                    }

                                    .dropdown .dropdown-toggle:after {
                                        content: '►';
                                        /* Arrow symbol */
                                        font-size: 0.8rem;
                                        position: absolute;
                                        right: 10px;
                                        /* Align it to the right */
                                        top: 27%;
                                        transform: translateY(-50%);
                                    }
                                </style>

                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const categoryOptions = document.querySelectorAll('.dropdown-item.category-option, .dropdown-submenu > a');
                                        const selectedCategoryInput = document.getElementById('selectedCategory');
                                        const selectAllCheckbox = document.getElementById('selectAllCategories');
                                        const categoryDropdown = document.getElementById('categoryDropdown');
                                        const categoryHierarchy = @json($categories);

                                        function getAllChildIdsFromSection(sectionId) {
                                            let allIds = [];
                                            categoryHierarchy.forEach(section => {
                                                if (section.id == sectionId) {
                                                    section.categories.forEach(cat => {
                                                        allIds.push(cat.id);
                                                        cat.sub_categories.forEach(sub => {
                                                            allIds.push(sub.id);
                                                        });
                                                    });
                                                }
                                            });
                                            return allIds;
                                        }

                                        function getAllChildIdsFromCategory(categoryId) {
                                            let allIds = [];
                                            categoryHierarchy.forEach(section => {
                                                section.categories.forEach(cat => {
                                                    if (cat.id == categoryId) {
                                                        allIds.push(cat.id);
                                                        cat.sub_categories.forEach(sub => {
                                                            allIds.push(sub.id);
                                                        });
                                                    }
                                                });
                                            });
                                            return allIds;
                                        }

                                        function getAllChildIdsFromSubcategory(subcategoryId) {
                                            let allIds = [];
                                            categoryHierarchy.forEach(section => {
                                                section.categories.forEach(cat => {
                                                    cat.sub_categories.forEach(sub => {
                                                        if (sub.id == subcategoryId) {
                                                            allIds.push(sub.id);
                                                        }
                                                    });
                                                });
                                            });
                                            return allIds;
                                        }

                                        function getCategoryPath(element) {
                                            let path = [element.innerText.trim()];
                                            let parent = element.closest("ul").previousElementSibling;

                                            while (parent && parent.classList.contains("dropdown-item")) {
                                                path.unshift(parent.innerText.trim());
                                                parent = parent.closest("ul").previousElementSibling;
                                            }

                                            return path.join(" > ");
                                        }

                                        categoryOptions.forEach(option => {
                                            option.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                const selectedId = this.getAttribute('data-id');
                                                const type = this.getAttribute('data-type');
                                                let allRelevantIds = [];

                                                if (type === "section") {
                                                    // If section is clicked, get all category and subcategories
                                                    allRelevantIds = getAllChildIdsFromSection(selectedId);
                                                } else if (type === "category") {
                                                    // If category is clicked, get all subcategories of that category
                                                    allRelevantIds = getAllChildIdsFromCategory(selectedId);
                                                } else if (type === "subcategory") {
                                                    // If subcategory is clicked, get that subcategory only
                                                    allRelevantIds = getAllChildIdsFromSubcategory(selectedId);
                                                }

                                                if (!allRelevantIds.includes(selectedId)) {
                                                    allRelevantIds.unshift(selectedId);
                                                }

                                                // Set the selected IDs and display it on the UI
                                                selectedCategoryInput.value = allRelevantIds.join(',');
                                                selectAllCheckbox.checked = false;

                                                // Update the dropdown label
                                                const label = getCategoryPath(this);
                                                categoryDropdown.innerText = label;

                                                // console.log('Selected ID:', selectedId);
                                                // console.log('All Relevant IDs:', allRelevantIds);
                                                // console.log('Joined Value:', allRelevantIds.join(','));
                                            });
                                        });

                                        selectAllCheckbox.addEventListener("change", function() {
                                            if (this.checked) {
                                                let allIds = [];
                                                categoryHierarchy.forEach(section => {
                                                    section.categories.forEach(cat => {
                                                        allIds.push(cat.id);
                                                        cat.sub_categories.forEach(sub => allIds.push(sub.id));
                                                    });
                                                });
                                                selectedCategoryInput.value = [...new Set(allIds)].join(',');
                                                categoryDropdown.innerText = 'All Categories';
                                            } else {
                                                selectedCategoryInput.value = '';
                                                categoryDropdown.innerText = 'Select Category';
                                            }
                                        });

                                        // Submenu toggle
                                        document.querySelectorAll(".dropdown-submenu > a").forEach(function(el) {
                                            el.addEventListener("click", function(e) {
                                                const submenu = this.nextElementSibling;
                                                if (submenu) {
                                                    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                                                    this.parentElement.classList.toggle("open");
                                                }
                                            });
                                        });
                                    });

                                </script>




                                <div class="form-group hide">
                                    <label for="brands">Select Brand:</label>
                                    <select name="brands[]" class="form-control text-dark" multiple>
                                        {{-- "multiple" HTML attribute: https://www.w3schools.com/tags/att_multiple.asp --}} {{-- We used the Square Brackets [] in name="brands[]" is an array because we used the "multiple" HTML attribute to be able to choose multiple brands (more than one brand) at the same time --}}
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand['id'] }}" selected>{{ $brand['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group hide">
                                    <label for="users">Select User (by email):</label>
                                    <select name="users[]" class="form-control text-dark" multiple> {{-- "multiple" HTML attribute: https://www.w3schools.com/tags/att_multiple.asp --}}
                                        {{-- We used the Square Brackets [] in name="users[]" is an array because we used the "multiple" HTML attribute to be able to choose multiple users (more than one user) at the same time --}}
                                        @foreach ($users as $user)
                                            <option value="{{ $user['email'] }}"
                                                @if ($title == 'Add Coupon') selected
                                        @else
                                        @if (in_array($user['email'], $selUsers))
                                        selected @endif
                                                @endif>{{ $user['email'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date:</label> {{-- Coupon Expiry Date --}}
                                    <input type="date" class="form-control" id="expiry_date"
                                        placeholder="Enter Expiry Date" name="expiry_date"
                                        @if (isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @else value="{{ old('expiry_date') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
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
