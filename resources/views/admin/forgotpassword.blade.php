<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Panel</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ url('admin/vendors/feather/feather.css') }}">
        <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ url('admin/vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ url('admin/css/vertical-layout-light/style.css') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
    </head>
    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <h4>Forgot your password</h4>
                                <h6 class="font-weight-light">We will send you an email to reset your password</h6>


                                {{-- Our Bootstrap error code in case of wrong credentials when logging in: --}}
                                {{-- Determining If An Item Exists In The Session (using has() method): https://laravel.com/docs/9.x/session#determining-if-an-item-exists-in-the-session --}}
                                @if (Session::has('error_message')) <!-- Check AdminController.php, login() method -->
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


                                {{-- My code --}}
                                <form class="pt-3" action="{{ url('admin/forgot-password') }}" method="post">
                                    @csrf {{-- https://laravel.com/docs/9.x/csrf#preventing-csrf-requests --}}


                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                                    </div>
                                   
                                    <div class="mt-3">
                                        
                                        {{-- My code: --}}
                                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">FORGOT PASSWORD</button>

                                    </div>
                                    <div class="my-2 d-flex justify-content-center align-items-center">
                               
                                            <label class="form-check-label text-muted">
                                            <a style="text-align: center; text-decoration: underline; color: black;" href="/admin/login">Back to login</a>
                                            </label>
                                
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ url('admin/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ url('admin/js/off-canvas.js') }}"></script>
        <script src="{{ url('admin/js/hoverable-collapse.js') }}"></script>
        <script src="{{ url('admin/js/template.js') }}"></script>
        <script src="{{ url('admin/js/settings.js') }}"></script>
        <script src="{{ url('admin/js/todolist.js') }}"></script>
        <!-- endinject -->
    </body>
</html>