@extends('admin.layout.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h4 class="card-title">
                                @foreach ($breadcrumb as $value)
                                    @if (isset($value['url']))
                                        <a href="{{ url($value['url']) }}">{{ $value['value'] }}</a>/
                                    @else
                                        <span>{{ $value['value'] }}</span>
                                    @endif
                                @endforeach
                            </h4>
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
                <div class="col-md-6 grid-margin stretch-card">
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
                                @if (empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/' . $product['id']) }}" @endif
                                method="post" enctype="multipart/form-data">
                                <!-- If the id is not passed in from the route, this measn 'Add a new Product', but if the id is passed in from the route, this means 'Edit the Product' -->
                                <!-- Using the enctype="multipart/form-data" to allow uploading files (images) -->
                                @csrf
                                <div class="form-group">
                                    <label for="categoryDropdown">Select Category</label>
                                    <div class="dropdown" style="position: relative; width: 100%;">
                                        <button class="btn btn-secondary dropdown-toggle form-control text-dark" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 0.25rem; padding: .4375rem .75rem; background-color: #ffffff; color: white; text-align: left;">
                                            Select Category
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown" style="min-width: 200px; width: 100%; border-radius: 0.25rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 0; background-color: #fff; border: 1px solid #ddd; text-align: left; color: black;">
                                            @foreach ($categories as $section)
                                                <li class="dropdown-submenu position-relative" style="list-style-type: none;">
                                                    <a class="dropdown-item dropdown-toggle" href="#" data-id="{{ $section['id'] }}" style="padding: 10px 15px; cursor: pointer; transition: background-color 0.3s ease-in-out; text-align: left; color: black;">
                                                        {{ $section['name'] }}
                                                    </a>
                                                    <ul class="dropdown-menu" style="display: none; position: absolute; left: 100%; top: 0; margin-left: 0.1rem; min-width: 200px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.25rem; background-color: #f8f9fa; text-align: left; color: black;">
                                                        @foreach ($section['categories'] as $category)
                                                            <li class="dropdown-submenu position-relative" style="list-style-type: none;">
                                                                <a class="dropdown-item dropdown-toggle" href="#" data-id="{{ $category['id'] }}" style="padding: 10px 15px; cursor: pointer; transition: background-color 0.3s ease-in-out; text-align: left; color: black;">
                                                                    {{ $category['category_name'] }}
                                                                </a>
                                                                @if (!empty($category['sub_categories']))
                                                                    <ul class="dropdown-menu" style="display: none; position: absolute; left: 100%; top: 0; margin-left: 0.1rem; min-width: 200px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 0.25rem; background-color: #f8f9fa; text-align: left; color: black;">
                                                                        @foreach ($category['sub_categories'] as $subcategory)
                                                                            <li style="list-style-type: none;">
                                                                                <a class="dropdown-item category-option" href="#" data-id="{{ $subcategory['id'] }}" style="padding: 10px 15px; cursor: pointer; transition: background-color 0.3s ease-in-out; text-align: left; color: black;">
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
                                        <input type="hidden" name="category_id" id="selectedCategory">
                                    </div>
                                </div>
                                
                                {{-- Including the related filters <select> box of a product DEPENDING ON THE SELECTED CATEGORY of the product --}}
                                <div class="loadFilters">
                                    @include('admin.filters.category_filters')
                                </div>


                                {{-- Hide --}}
                                {{-- <div class="form-group">
                                    <label for="brand_id">Select Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control text-dark" disabled>
                                        <option value="">Select Brand</option>
                                        {{ $selected_brand_id = "" }}
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand['id'] }}" 
                                                @if (!empty($product['brand_id'] == $brand['id'])) 
                                                    {{$selected_brand_id = $brand['id']}}
                                                    selected 
                                                @endif 
                                                @if (strtolower($brand['name']) == 'own')
                                                    {{$selected_brand_id = $brand['id']}}
                                                    selected
                                                @endif
                                            >{{ $brand['name'] }}</option>
                                        @endforeach
                                        <input type="hidden" name="brand_id" value="{{ $selected_brand_id }}">
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name"
                                        placeholder="Enter Product Name" name="product_name"
                                        @if (!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ old('product_name') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Product Code</label>
                                    <input type="text" class="form-control" id="product_code" placeholder="Enter Code"
                                        name="product_code"
                                        @if (!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ old('product_code') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input type="text" class="form-control" id="product_price"
                                        placeholder="Enter Product Price" name="product_price"
                                        @if (!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ old('product_price') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                </div>
                                <div class="form-group">
                                    <label for="product_discount">Product Discount (%)</label>
                                    <input type="text" class="form-control" id="product_discount"
                                        placeholder="Enter Product Discount" name="product_discount"
                                        @if (!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ old('product_discount') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                </div>
                                <div class="form-group">
                                    <label for="product_weight">Product Weight (Kg)</label>
                                    <input type="text" class="form-control" id="product_weight"
                                        placeholder="Enter Product Weight" name="product_weight"
                                        @if (!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                </div>



                                {{-- Managing Product Colors (in front/products/detail.blade.php) --}}
                                <div class="form-group">
                                    <label for="group_code">Tags</label>
                                    <input type="text" class="form-control" id="group_code"
                                        placeholder="Enter Group Code/Tags (100% Cotton; Is FDA approved; ...)"
                                        name="group_code"
                                        @if (!empty($product['group_code'])) value="{{ $product['group_code'] }}" @else value="{{ old('group_code') }}" @endif>
                                    {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                </div>



                                <div class="form-group">
                                    <label for="product_image">Product Image (Recommended Size: 1000x1000)</label>
                                    {{-- Important Note: There are going to be 3 three sizes for the product image: Admin will upload the image with the recommended size which 1000*1000 which is the 'large' size (will store it in 'large' folder), but then we're going to use 'Intervention' package to get another two sizes: 500*500 which is the 'medium' size (will store it in 'medium' folder) and 250*250 which is the 'small' size (will store it in 'small' folder) --}}
                                    <input type="file" class="form-control" id="product_image" name="product_image">
                                    {{-- Show the admin image if exists --}}

                                    {{-- Show the product image, if any (if exits) --}}
                                    @if (!empty($product['product_image']))
                                        <a target="_blank"
                                            href="{{ url('front/images/product_images/large/' . $product['product_image']) }}">View
                                            Product Image</a>&nbsp;|&nbsp; {{-- Showing the 'large' image inside the 'large' folder --}}
                                        <a href="JavaScript:void(0)" class="confirmDelete" module="product-image"
                                            moduleid="{{ $product['id'] }}">Delete Product Image</a>
                                        {{-- Delete the product image from BOTH SERVER (FILESYSTEM) & DATABASE --}} {{-- Check admin/js/custom.js and web.php (routes) --}}
                                    @endif
                                </div>
                                @if (!isset($product['id']))
                                    {{-- if form is edit or not --> show multiple image or not --}}
                                    <div class="form-group">
                                        <label for="multiple-imge">Multiple Image</label>
                                        <div class="d-flex justify-content-start mb-2">
                                            <button type="button" class="btn btn-primary" id="add_more_images">Add Image +</button>
                                        </div>
                                        <div id="multiple-image-wrapper" >
                                            <div class="row image-row mb-2">
                                                <div class="col-xl-10 col-lg-6 col-md-8 col-9">
                                                    <input type="file" class="form-control multiple_image" name="multiple_image[]">
                                                </div>
                                                <div class="col-xl-2 col-lg-6 col-md-4 col-3">
                                                    <button type="button" class="btn btn-danger remove-image-row">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="product_video">Product Video (Recommended Size: Less than 2 MB)</label>
                                    {{-- Important Note: Default php.ini file upload Maximum file size is 2MB (If you upload a file with a larger size, it won't be uploaded!). Check upload_max_filesize using phpinfo() method --}}
                                    <input type="file" class="form-control" id="product_video" name="product_video">
                                    {{-- Show the admin image if exists --}}

                                    {{-- Show the product video, if any (if exits) --}}
                                    @if (!empty($product['product_video']))
                                        <a target="_blank"
                                            href="{{ url('front/videos/product_videos/' . $product['product_video']) }}">View
                                            Product Video</a>&nbsp;|&nbsp;
                                        <a href="JavaScript:void(0)" class="confirmDelete" module="product-video"
                                            moduleid="{{ $product['id'] }}">Delete Product Video</a>
                                        {{-- Delete the product video from BOTH SERVER (FILESYSTEM) & DATABASE --}} {{-- Check admin/js/custom.js and web.php (routes) --}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ $product['description'] }}</textarea>
                                </div>
                                <!--
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" placeholder="Enter Meta Title" name="meta_title"   @if (!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif >  {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <input type="text" class="form-control" id="meta_description" placeholder="Enter Meta Description" name="meta_description"   @if (!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ old('meta_description') }}" @endif >  {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" placeholder="Enter Meta Keywords" name="meta_keywords"   @if (!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ old('meta_keywords') }}" @endif >  {{-- Repopulating Forms (using old() method): https://laravel.com/docs/9.x/validation#repopulating-forms --}}
                                    </div>
                                    -->
                                <div class="form-group">
                                    <label for="is_featured">Featured Item (Yes/No)</label>
                                    <input type="checkbox" name="is_featured" id="is_featured" value="Yes"
                                        @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked @endif>
                                </div>
                                @if ($adminType != 'vendor')
                                    <div class="form-group">
                                        <label for="is_bestseller">Best Seller Item (Yes/No)</label> {{-- Note: Only 'superadmin' can mark a product as 'bestseller', but 'vendor' can't --}}
                                        <input type="checkbox" name="is_bestseller" id="is_bestseller" value="Yes"
                                            @if (!empty($product['is_bestseller']) && $product['is_bestseller'] == 'Yes') checked @endif>
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn btn-light"><a
                                        href="{{ url('admin/products') }}">Cancel</a></button>
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

@section('scripts')
    <script>
      $(document).ready(function() {
        // Add a new image row
        $('#add_more_images').click(function() {
            let newRow = $('.image-row:last').clone();
            newRow.find('input').val('');
            $('#multiple-image-wrapper').append(newRow);
        });

        $(document).on('click', '.remove-image-row', function() {
            if ($('.image-row').length > 1) {
                $(this).closest('.image-row').remove();
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    const categoryDropdown = document.getElementById("categoryDropdown");
    const selectedCategoryInput = document.getElementById("selectedCategory");

    // Handle category selection (including subcategories)
    document.querySelectorAll(".dropdown-submenu > a, .category-option").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            let selectedCategory = this.dataset.id;

            if (selectedCategory) {
                selectedCategoryInput.value = selectedCategory; // Update hidden input
                let categoryPath = getCategoryPath(this);

                categoryDropdown.innerText = categoryPath; // Update dropdown text

                // Save to localStorage for future editing
                localStorage.setItem("selectedCategoryID", selectedCategory);
                localStorage.setItem("selectedCategoryText", categoryPath);
            }
        });
    });

    // Function to get the full category path
    function getCategoryPath(element) {
        let path = [element.innerText.trim()];
        let parent = element.closest("ul").previousElementSibling;

        while (parent && parent.classList.contains("dropdown-item")) {
            path.unshift(parent.innerText.trim()); // Add parent categories to the path
            parent = parent.closest("ul").previousElementSibling;
        }

        return path.join(" > "); // Format with " > "
    }

    // Toggle submenu display on click (for parent categories)
    document.querySelectorAll(".dropdown-submenu > a").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            let submenu = this.nextElementSibling;
            if (submenu) {
                submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                this.parentElement.classList.toggle("open");
            }
        });
    });

    // Hover to show submenus
    document.querySelectorAll(".dropdown-submenu").forEach(function (el) {
        el.addEventListener("mouseenter", function () {
            let submenu = this.querySelector(".dropdown-menu");
            if (submenu) {
                submenu.style.display = "block";
            }
        });

        el.addEventListener("mouseleave", function () {
            let submenu = this.querySelector(".dropdown-menu");
            if (submenu) {
                submenu.style.display = "none";
            }
        });
    });
});


    </script>
    {{-- <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<!-- Bootstrap JS (Ensure this is loaded) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        margin-left: -1px; /* Helps prevent gaps */
        min-width: 200px;
        background-color: #f8f9fa;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 0.25rem;
    }

    /* Keeps submenu aligned with the parent category */
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }
    .dropdown .dropdown-toggle:after {
        content: '►'; /* Arrow symbol */
        font-size: 0.8rem;
        position: absolute;
        right: 10px; /* Align it to the right */
        top: 50%;
        transform: translateY(-50%);
    }
</style>
@endsection
