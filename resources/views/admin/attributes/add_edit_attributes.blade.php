
{{-- This page is rendered by addAttributes() method in Admin/ProductsController.php --}}
@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <button class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                                <span class="icon-menu"></span>
                            </button>
                            <h4 class="card-title">Attributes</h4> {{-- meaning Product attributes --}}
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
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Attributes</h4>


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
                

                            


                            
                            <form class="forms-sample" action="{{ url('admin/add-edit-attributes/' . $product['id']) }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="product_name">Product Name:</label>
                                    &nbsp; {{ $product['product_name'] }}
                                </div>
                                <div class="form-group">
                                    <label for="product_code">Product Code:</label>
                                    &nbsp; {{ $product['product_code'] }}
                                </div>
                                <div class="form-group">
                                    <label for="product_price">Product Price:</label>
                                    &nbsp; {{ $product['product_price'] }}
                                </div>
                                <div class="form-group">
                                    {{-- Show the product image, if any (if exits) --}}
                                    @if (!empty($product['product_image']))
                                        <img style="width: 120px" src="{{ $getImage('front/images/product_images/small/', $product['product_image']) }}"> {{--  the 'small' image --}}
                                    @else
                                        <img style="width: 120px" src="{{ $getImage('front/images/product_images/small/', 'no-image.png') }}"> {{--  the 'small' image --}}
                                    @endif
                                </div>

                

                                {{-- Add Remove Input Fields Dynamically using jQuery: https://www.codexworld.com/add-remove-input-fields-dynamically-using-jquery/ --}} 
                                {{-- Products attributes add//remove input fields dynamically using jQuery --}}
                                @php
                                $variants_cnt = count($product['variants']);
                                @endphp
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div class="variant-container dynamic_variant card">
                                            <h4 class="card-title">Variant Name 1</h4>
                                            <input type="text" class="input-variant-name" name="attribute[0][variant][name]"  placeholder="Color" value="{{ $variants_cnt > 0 ? $product['variants'][0]['variant_name']:'' }}" required> {{-- !! Note that the "name" HTML attribute is an ARRAY (using SQUARE BRAKETS [] !!) --}}
                                            <div class="variant-attributes-container" data-variant_key="0">
                                                <div class="variant-attributes-container-input"></div>
                                                <button href="javascript:void(0);" type="button" class="add_variant_attribute_button" title="Add Variant Attributes">+ OPTION</button> {{-- Add another 4 input fields like the former --}}
                                            </div>
                                        </div>
                                        <button id="add-variant" type="button">ADD VARIANT</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset"  class="btn btn-light">Cancel</button>
                            </form>
                            
                            <br><br>
                            
                            {{-- Edit Variant name --}}
                            <div class="accordion" id="variantAccordion">
                                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseVariant" aria-expanded="true" aria-controls="collapseVariant">
                                    Edit Variant
                                </button>
                                <br><br>
                                <div class="card">
                                    <div id="collapseVariant" class="collapse" aria-labelledby="headerVariant" data-parent="#variantAccordion">
                                        <div class="card-body">
                                            <form action="{{ url('admin/update-variant') }}" method="post">
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <select id="variant-id" name="variant-id" required>
                                                            <option value="" selected>Select a Variant</option>
                                                            @foreach ($product['variants'] as $item)
                                                                <option value="{{ $item['id'] }}">{{ $item['variant_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="new-variant-name" name="new-variant-name" placeholder="Edit variant name" required>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Variant</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            @if (count($product['variants']) > 0)
                            <h4 class="card-title">Product Attributes</h4>

                            <form method="post" action="{{ url('admin/edit-attributes/' . $product['id']) }}" style="width: 100%; overflow: auto">
                                @csrf

                                {{-- DataTable --}}
                                <table id="products" class="table table-bordered"> {{-- using the id here for the DataTable --}}
                                    <thead>
                                        <tr>
                                            @foreach ($product['variants'] as $prod_variant)
                                                <th>{{$prod_variant['variant_name']}}</th>
                                            @endforeach
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product['attributes'] as $attribute) {{-- using the relationship 'attributes' --}}
                                            {{--  <input type="hidden" name="attributeId[]" value="{{ $attribute['id'] }}">  --}} {{-- A hidden input field --}} {{-- IMPORTANT NOTE: DIDN'T WORK INSIDE FOR LOOP!! MUST BE OUSTSIDE IT IN ORDER TO WORK! --}}
                                            <input style="display: none" type="text" name="attributeId[]" value="{{ $attribute['id'] }}"> {{-- A hidden input field --}}
                                            <tr>
                                                <td>{{ $attribute['color'] }}</td>
                                                @if (count($product['variants']) > 0)
                                                <td>{{ $attribute['size'] }}</td>
                                                @endif
                                                <td>
                                                    <input type="text" name="sku[{{$attribute['id']}}]" value="{{ $attribute['sku'] }}" placeholder="SKU" style="width:150px" required> {{-- !! Note that the "name" HTML attribute is an ARRAY (using SQUARE BRAKETS [] !!) --}}
                                                </td>
                                                <td>
                                                    <input type="number" name="price[{{$attribute['id']}}]" step="0.01" value="{{ $attribute['price'] }}" required style="width: 130px"> {{-- !! Note the "name" HTML attribute SQUARE BRACKETS [] !! --}}
                                                </td>
                                                <td>
                                                    <input type="number" name="stock[{{$attribute['id']}}]" value="{{ $attribute['stock'] }}" required style="width: 60px"> {{-- !! Note the "name" HTML attribute SQUARE BRACKETS [] !! --}}
                                                </td>
                                                <td>
                                                    @if ($attribute['status'] == 1)
                                                        <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @else 
                                                        {{-- if the admin status is inactive --}}
                                                        <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)"> {{-- Using HTML Custom Attributes. Check admin/js/custom.js --}}
                                                            <i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                        </a>
                                                    @endif

                                                    <a title="Delete Attribute" href="JavaScript:void(0)" class="confirmDelete" module="attribute" moduleid="{{ $attribute['id'] }}"> {{-- Check admin/js/custom.js and web.php (routes) --}}
                                                        <i style="font-size: 25px; color: red" class="mdi mdi-file-excel-box"></i> {{-- Icons from Skydash Admin Panel Template --}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Update Attributes</button>
                            </form>
                            @endif
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
