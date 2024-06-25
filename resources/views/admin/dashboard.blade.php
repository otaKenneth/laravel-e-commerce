@extends('admin.layout.layout')


@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row space-right-mobile">
                        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <button class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                            <span class="icon-menu"></span>
                        </button>
                            <h3 class="font-weight-bold">Welcome {{ Auth::guard('admin')->user()->name }}</h3> {{-- Accessing Specific Guard Instances: https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --}} <!-- https://laravel.com/docs/9.x/authentication#retrieving-the-authenticated-user --> <!-- https://laravel.com/docs/9.x/authentication#accessing-specific-guard-instances --> <!-- https://laravel.com/docs/9.x/eloquent#retrieving-models -->
                            <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                
                <div class="col-md-6 grid-margin transparent no-mobile-margin-bottom">


                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Sections</p>
                                    <p class="fs-30 mb-2">{{ $sectionsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Categories</p>
                                    <p class="fs-30 mb-2">{{ $categoriesCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Products</p>
                                    <p class="fs-30 mb-2">{{ $productsCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Total Brands</p>
                                    <p class="fs-30 mb-2">{{ $brandsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                
                    
                </div>


                
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Total Orders</p>
                                    <p class="fs-30 mb-2">{{ $ordersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Coupons</p>
                                    <p class="fs-30 mb-2">{{ $couponsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent mobile-no-margin">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Users</p>
                                    <p class="fs-30 mb-2">{{ $usersCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                <p class="mb-4">Vendors found us on</p>

                                    <div style="display: flex; gap: 20px;">
                                        <select id="found_us_select" style="padding: 4px 20px 0 0; border: none; width: 180px; margin-top: -10px;">
                                            <option value="fu_fb">Facebook</option>
                                            <option value="fu_ig">Instagram</option>
                                            <option value="fu_re">Referral</option>
                                            <option value="fu_li">LinkedIn</option>
                                            <option value="fu_wm">Word-of-Mouth</option>
                                        </select>
                                        
                                        <p class="fu_fb fs-30 mb-2 value_short_found_us" style="display: none">{{ $wdyfu_fb }}</p>
                                        <p class="fu_ig fs-30 mb-2 value_short_found_us" style="display: none">{{ $wdyfu_ig }}</p>
                                        <p class="fu_re fs-30 mb-2 value_short_found_us" style="display: none">{{ $wdyfu_re }}</p>
                                        <p class="fu_li fs-30 mb-2 value_short_found_us" style="display: none">{{ $wdyfu_li }}</p>
                                        <p class="fu_wm fs-30 mb-2 value_short_found_us" style="display: none">{{ $wdyfu_wm }}</p>
                                    </div>

                                </div>
                            </div>
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