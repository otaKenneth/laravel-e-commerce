// Using jQuery for the website ADMIN section:

$(document).ready(function() {

    // DataTables jQuery library
    // Calling the DataTable class for all pages
    $('#sections').DataTable();    // in sections.blade.php
    $('#categories').DataTable();  // in categories.blade.php
    $('#brands').DataTable();      // in brands.blade.php
    $('#products').DataTable({
        search: {
            search: $('input[name="search"]').val()
        },
        order: [[1, 'asc']]
    });    // in products.blade.php
    $('#banners').DataTable();     // in banners.blade.php
    $('#filters').DataTable();     // in filters.blade.php
    $('#coupons').DataTable();     // in admin/coupons/coupons.blade.php              
    $('#users').DataTable();       // in admin/users/users.blade.php                  
    $('#orders').DataTable({
        order: [[0, 'desc'], [1, 'desc']]
    });      // in admin/orders/orders.blade.php                
    $('#shipping').DataTable();    // in admin/shipping/shipping_charges.blade.php    
    $('#subscribers').DataTable(); // in admin/subscribers/subscribers.blade.php      
    $('#ratings').DataTable();     // in admin/ratings/ratings.blade.php              



    // Correcting issues in the Skydash Admin Panel Sidebar
    $('.nav-item').removeClass('active');
    $('.nav-link').removeClass('active');



    // Check if the Admin Password is correct using AJAX in update_admin_password.blade.php page    
    $('#current_password').keyup(function() {
        // console.log(this);
        var current_password = $(this).val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/check-admin-password', // check the web.php for this route and check the AdminController for the checkAdminPassword() method
            data   : {current_password: current_password}, // A key/value pair that will checked inside the AdminController using Hash::check($data['current_password']) (e.g. current_password: 123456)    // send the the    var current_password    (Check the above variable)
            success: function(resp) {
                // alert(resp);
                if (resp == 'false') {
                    $('#check_password').html('<b style="color: red">Current Password is Incorrect!</b>'); // the <span> element in update_admin_password.blade.php
                } else if (resp == 'true') {
                    $('#check_password').html('<b style="color: green">Current Password is Correct!</b>'); // the <span> element in update_admin_password.blade.php
                }
            },
            error  : function() {alert('Error');}
        });
    });



    // Updating admin status (active/inactive) using AJAX in admin/admins/admins.blade.php    
    $(document).on('click', '.updateAdminStatus', function() { // '.updateAdminStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateAdminStatus').on('click', function() {
        var status   = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var admin_id = $(this).attr('admin_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-admin-status', // check the web.php for this route and check the AdminController for the updateAdminStatus() method
            data   : {status: status, admin_id: admin_id}, // we pass the status and admin_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#admin-' + admin_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#admin-' + admin_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating section status (active/inactive) using AJAX in sections.blade.php    
    $(document).on('click', '.updateSectionStatus', function() { // '.updateSectionStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateSectionStatus').on('click', function() {
        var status     = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var section_id = $(this).attr('section_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-section-status', // check the web.php for this route and check the SectionController for the updateSectionStatus() method
            data   : {status: status, section_id: section_id}, // we pass the status and section_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#section-' + section_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#section-' + section_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Category status (active/inactive) using AJAX in categories.blade.php    
    $(document).on('click', '.updateCategoryStatus', function() { // '.updateCategoryStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateCategoryStatus').on('click', function() {
        var status      = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var category_id = $(this).attr('category_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-category-status', // check the web.php for this route and check the CategoryController for the updateCategoryStatus() method
            data   : {status: status, category_id: category_id}, // we pass the status and category_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#category-' + category_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#category-' + category_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Brand status (active/inactive) using AJAX in brands.blade.php    
    $(document).on('click', '.updateBrandStatus', function() { // '.updateBrandStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateBrandStatus').on('click', function() {
        var status   = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var brand_id = $(this).attr('brand_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-brand-status', // check the web.php for this route and check the BrandController for the updateBrandStatus() method
            data   : {status: status, brand_id: brand_id}, // we pass the status and brand_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#brand-' + brand_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#brand-' + brand_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Product status (active/inactive) using AJAX in products.blade.php    
    $(document).on('click', '.updateProductStatus', function() { // '.updateProductStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateProductStatus').on('click', function() {
        var status     = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var product_id = $(this).attr('product_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-product-status', // check the web.php for this route and check the ProductsController for the updateProductStatus() method
            data   : {status: status, product_id: product_id}, // we pass the status and product_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#product-' + product_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#product-' + product_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Attribute status (active/inactive) using AJAX in add_edit_attributes.blade.php    
    $(document).on('click', '.updateAttributeStatus', function() { // '.updateAttributeStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateAttributetatus').on('click', function() {
        var status       = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var attribute_id = $(this).attr('attribute_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-attribute-status', // check the web.php for this route and check the ProductsController for the updateAttributeStatus() method
            data   : {status: status, attribute_id: attribute_id}, // we pass the status and attribute_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#attribute-' + attribute_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#attribute-' + attribute_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Image status (active/inactive) using AJAX in add_images.blade.php    
    $(document).on('click', '.updateImageStatus', function() { // '.updateImageStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateAttributetatus').on('click', function() {
        var status   = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var image_id = $(this).attr('image_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-image-status', // check the web.php for this route and check the ProductsController for the updateImageStatus() method
            data   : {status: status, image_id: image_id}, // we pass the status and image_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#image-' + image_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#image-' + image_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Banner status (active/inactive) using AJAX in banners.blade.php    
    $(document).on('click', '.updateBannerStatus', function() { // '.updateBannerStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateBannerstatus').on('click', function() {
        var status   = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var banner_id = $(this).attr('banner_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-banner-status', // check the web.php for this route and check the ProductsController for the updateBannerStatus() method
            data   : {status: status, banner_id: banner_id}, // we pass the status and banner_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#banner-' + banner_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#banner-' + banner_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Filter status (active/inactive) using AJAX in filters.blade.php    
    $(document).on('click', '.updateFilterStatus', function() { // '.updateFilterStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateFilterstatus').on('click', function() {
        var status    = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var filter_id = $(this).attr('filter_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-filter-status', // check the web.php for this route and check the ProductsController for the updateFilterStatus() method
            data   : {status: status, filter_id: filter_id}, // we pass the status and filter_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Updating Filter Value status (active/inactive) using AJAX in filters_values.blade.php    
    $(document).on('click', '.updateFilterValueStatus', function() { // '.updateFilterValueStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateFilterValuestatus').on('click', function() {
        var status    = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var filter_id = $(this).attr('filter_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-filter-value-status', // check the web.php for this route and check the ProductsController for the updateFilterValueStatus() method
            data   : {status: status, filter_id: filter_id}, // we pass the status and filter_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#filter-' + filter_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update Coupon Status (active/inactive) via AJAX in admin/coupons/coupons.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateCouponStatus', function() { // '.updateCouponStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateCouponStatus').on('click', function() {
        var status    = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var coupon_id = $(this).attr('coupon_id'); // Using HTML Custom Attributes



        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-coupon-status', // check the web.php for this route and check the CouponsController for the updateCouponStatus() method
            data   : {status: status, coupon_id: coupon_id}, // we pass the status and coupon_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#coupon-' + coupon_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#coupon-' + coupon_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update User Status (active/inactive) via AJAX in admin/users/users.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateUserStatus', function() { // '.updateUserStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateUserStatus').on('click', function() {
        var status  = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var user_id = $(this).attr('user_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-user-status', // check the web.php for this route and check the UsersController for the updateUserStatus() method
            data   : {status: status, user_id: user_id}, // we pass the status and user_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#user-' + user_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#user-' + user_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update Shipping Status (active/inactive) via AJAX in admin/shipping/shipping_charages.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateShippingStatus', function() { // '.updateUserStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateUserStatus').on('click', function() {
        var status  = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var shipping_id = $(this).attr('shipping_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-shipping-status', // check the web.php for this route and check the ShippingController for the updateShippingStatus() method
            data   : {status: status, shipping_id: shipping_id}, // we pass in the status and shipping_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#shipping-' + shipping_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#shipping-' + shipping_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update Subscriber Status (active/inactive) via AJAX in admin/subscribers/subscribers.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateSubscriberStatus', function() { // '.updateUserStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateUserStatus').on('click', function() {
        var status  = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var subscriber_id = $(this).attr('subscriber_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : '/admin/update-subscriber-status', // check the web.php for this route and check the NewsletterController for the updateSubscriberStatus() method
            data   : {status: status, subscriber_id: subscriber_id}, // we pass in the status and subscriber_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#subscriber-' + subscriber_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#subscriber-' + subscriber_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });

    // Update Rating Status (active/inactive) via AJAX in admin/ratings/ratings.blade.php, check admin/js/custom.js    
    $(document).on('click', '.updateRatingStatus', function() { // '.updateUserStatus' is the anchor link <a> CSS class    // This is the same as    $('.updateUserStatus').on('click', function() {
        var status    = $(this).children('i').attr('status'); // Using HTML Custom Attributes
        var rating_id = $(this).attr('rating_id'); // Using HTML Custom Attributes

        
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token
            type   : 'post',
            url    : '/admin/update-rating-status', // check the web.php for this route and check the NewsletterController for the updateRatingStatus() method
            data   : {status: status, rating_id: rating_id}, // we pass in the status and rating_id
            success: function(resp) {
                if (resp.status == 0) { // in case of success, reverse the status (active/inactive) and show the right icon in the frontend    // Or the same    if (resp['status'] == 0) {
                    $('#rating-' + rating_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>');
                } else if (resp.status == 1) {
                    $('#rating-' + rating_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>');
                }
            },
            error  : function() {
                alert('Error');
            }
        });
    });



    // This method will be GLOBAL/COMMON and SHARED with many things that are going to be deleted in different pages, but they ALL must have both the HTML custom attributs: module and module_id to use them here to redirect to the relevant proper route (Check down a little bit    window.location = ....)
    // Confirm Deletion using SweetAlert JavaScript package/plugin
    // Delete category image in add_edit_category.blade.php
    // $('.confirmDelete').click(function() {
    $(document).on('click', '.confirmDelete', function() { // correcting the issue of .confirmDelete (Delete button is not working) is not working when going to the next page (using pagination)
        var module   = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');


        // After the CDNs block in the country, I resorted to this solution:
        if (confirm('Are you sure you want to delete this?')) {
            window.location = '/admin/delete-' + module + '/' + moduleid; // e.g.    '/admin/delete-sections/3'    or    '/admin/delete-category/5'    or    '/admin/delete-category-image/4'    or    /admin/delete-subscriber/43
        } else {
            return false; // return true    means STOP THE EXECUTION! Don't Do Anything! You can't do what you want to do!
        }

        /*
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )

                // We added this line by ourselves (to go to this route to delete the said module ...)
                window.location = '/admin/delete-' + module + '/' + moduleid; // e.g.    '/admin/delete-sections/3'    or    '/admin/delete-category/5'    or    '/admin/delete-category-image/4'    or    /admin/delete-subscriber/43
                }
            })
        */
    });



    // Show Categories <select> <option> depending on the selected (choosed) Section (show the relevant categories of the choosed section) in append_categories_level.blade.php page        // https://www.w3schools.com/jquery/event_change.asp
    $('#section_id').change(function() { // When the sections <select> <option> HTML element in add_edit_category.blade.php is selected or changed
        // console.log(this);
        var section_id = $(this).val();
        // console.log(section_id);


        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'get',
            url    : '/admin/append-categories-level',
            data   : {section_id: section_id}, // name/value pairs sent to server
            success: function(resp) {
                $('#appendCategoriesLevel').html(resp); // $('#appendCategoriesLeve') is the <div> in add_edit_category.blade.php
            },
            error  : function() {alert('Error');}
        });
    });



    // Add Remove Input Fields Dynamically using jQuery: https://www.codexworld.com/add-remove-input-fields-dynamically-using-jquery/    
    // Products attributes add//remove input fields dynamically using jQuery
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = `<div><div style="height:10px"></div><input type="text" name="attribute[${x}][color]" placeholder="Color" style="width:100px">&nbsp;<input type="text" name="attribute[${x}][size]" placeholder="Size" style="width:100px">&nbsp;<a href="javascript:void(0);" class="remove_button">Remove</a></div>'` 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        // Check maximum number of input fields
        if(x < maxField){ 
            x++; // Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); // Remove field html
        x--; // Decrement field counter
    });



    // Show the related filters depending on the selected category in category_filters.blade.php (which in turn is included by add_edit_product.php) using AJAX
    $('#category_id').on('change', function() {
        var category_id = $(this).val(); // the category_id of the selected category

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'post',
            url    : 'category-filters', // check this route in web.php
            data   : {category_id: category_id},
            success: function(resp) {
                $('.loadFilters').html(resp.view);
            }
        });
    });



    // Show/Hide Coupon fields for Coupon Options (Manual/Automatic) in admin/coupons/add_edit_coupon.blade.php    
    $('#ManualCoupon').click(function() {
        $('#couponField').show();
    });
    $('#AutomaticCoupon').click(function() {
        $('#couponField').hide();
    });



    // Hide Courier Name and Tracking Number HTML input fields in admin/orders/order_details.blade.php in "Update Order Status" Section, and show them ONLY if the "Update Order Status" <select><option> (dropdown menu) is updated/changed (to 'Shipped' only) by an 'admin'    
    $('#courier_name').hide();
    $('#tracking_number').hide();
    $('#order_status').on('change', function() {
        if (this.value == 'Shipped') { // is the same as:    if ($(this).val() == 'Shipped') {
            $('#courier_name').show();
            $('#tracking_number').show();
        } else {
            $('#courier_name').hide();
            $('#tracking_number').hide();
        }
    });

    // Reports
    // Sales Filter form
    $('#filterBy').change(function (v) {
        // Set the search filter label to what is selected from Filter By: input
        $('#filterBy-labelValue').text($(v.currentTarget).find('option:selected').text() + ":");
        let filterVal = v.currentTarget.value;
        
        $('.filter-container .input-group[data-filterFor]').each((k, el) => {
            $(el).hide();
            let filterFor = $(el).attr('data-filterFor').split(",");
            // show filterFor search input
            if (filterFor.find(d => d == filterVal)) {
                $(el).show();
            }
        })
    });

    $('#pcontents-select').change(function (ev) {
        let pcontent_id = $(ev.currentTarget).val();
        console.log(ev);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : 'get',
            url    : 'platform-management/' + pcontent_id, // check this route in web.php
            success: function(resp) {
                if (resp && resp.content) {
                    // Get the TinyMCE editor instance
                    var editor = tinymce.get('tinymce');

                    // Check if the editor instance exists
                    if (editor) {
                        // Update the content of the editor
                        let content = resp.content == null ? '':resp.content;
                        editor.setContent(content);
                    } else {
                        console.error('TinyMCE editor instance not found.');
                    }
                }
            }
        });
    })

    $('#pcontents-save-btn').click(function (ev) {
        let pcontent_id = $('#pcontents-select').val();
        var editor = tinymce.get('tinymce');
        var htmlContent = editor.getContent();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : 'post',
            url    : 'platform-management/' + pcontent_id + '/update', // check this route in web.php
            data   : {'content': htmlContent},
            success: function(resp) {
                console.log(resp)
                // platform-content-form
                if (resp && resp.success) {
                    $('.platform-content-form .alert.alert-success .alert-message').html(resp.message);
                    $('.platform-content-form .alert.alert-success').toggleClass('d-none');
                    setTimeout(() => {
                        $('.platform-content-form .alert.alert-success').toggleClass('d-none');
                    }, 1500);
                }
            }
        });
    })

    $('#formUpload_trusted_by').on('submit', function(e) {
        e.preventDefault();

        console.log(e.currentTarget);
        var formdata = new FormData(e.currentTarget);

        // Log FormData keys and values to the console
        for (var pair of formdata.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/admin/platform-management/save-trusted-by",
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (resp) {
                if (resp && resp.success) {
                    $('.trusted_by_list_of_images').html(resp.view);
                    $('.trusted_by_images .alert.alert-success .alert-message').html(resp.message);
                    $('.trusted_by_images .alert.alert-success').toggleClass('d-none');
                    setTimeout(() => {
                        $('.trusted_by_images .alert.alert-success').toggleClass('d-none');
                    }, 1500);
                } else {
                    $('.trusted_by_images .alert.alert-danger .alert-message').html(resp.message);
                    $('.trusted_by_images .alert.alert-danger').toggleClass('d-none');
                    setTimeout(() => {
                        $('.trusted_by_images .alert.alert-danger').toggleClass('d-none');
                    }, 1500);
                }
            }, error: function (err) {
                console.log(err)
            }
        });
    })


    $('.value_short_found_us').each(function() {
        let value = parseInt($(this).text(), 10);
        let formattedValue;

        if (value >= 1000000) {
            formattedValue = (value / 1000000).toFixed(1) + 'm';
        } else if (value >= 1000) {
            formattedValue = (value / 1000).toFixed(1) + 'k';
        } else {
            formattedValue = value;
        }

        $(this).text(formattedValue);
    });


    $('#found_us_select').on('change', function() {
        var selectedValue = $(this).val();
        
        $('.card-body p[class^="fu_"]').each(function() {
            if ($(this).hasClass(selectedValue)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Trigger the change event on page load to set the initial state
    $('#found_us_select').trigger('change');

}); // End of $(document).ready()




/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
let map;
let marker;
let geocoder;

async function initMap() {
    let lat = $('#update_vendor_details_form #business_address_lat[name*="lat"]').val();
    let lng = $('#update_vendor_details_form #business_address_lng[name*="lng"]').val();
    let position;

    if (lat === '' && lng === '') {
        position = { lat: 14.5806494, lng: 121.0203798 };
    } else {
        position = { lat: parseFloat(lat), lng: parseFloat(lng) };
    }


    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    
    map = new Map(document.getElementById("map_vendor_details"), {
        zoom: 11,
        center: position,
        // mapTypeControl: false,
        mapId: "e36eca20b19b9c"
    });
    geocoder = new google.maps.Geocoder();
    marker = new AdvancedMarkerElement({
        map: map,
        position: new google.maps.LatLng(position.lat, position.lng),
        title: "Metro Manila"
    });


    map.addListener('click', function(event) {
        
        marker.position = event.latLng;

        $('#update_vendor_details_form #business_address_lat[name*="lat"]').val(Object.values(marker.position)[0])
        $('#update_vendor_details_form #business_address_lng[name*="lng"]').val(Object.values(marker.position)[1])
    });


}
window.addEventListener("load", initMap);




$(document).ready(function() {


    function requestGeocode(address) {
        geocoder.geocode({
            "address": address
        }, function (results, status) {
            if (status == "OK") {
                map.setCenter(results[0].geometry.location);
                marker.position = results[0].geometry.location;

                $('#update_vendor_details_form #business_address_lat[name*="lat"]').val(Object.values(marker.position)[0])
                $('#update_vendor_details_form #business_address_lng[name*="lng"]').val(Object.values(marker.position)[1])
            }
        })
    }

    /**
     * On change of country name - load city
     */
    $('#update_vendor_details_form #shop_country').change((el) => {
        let country = $(el.currentTarget).val();

        var settings = {
            "url": 'https://countriesnow.space/api/v0.1/countries/states',
            "method": "POST",
            data: {
                "country": country
            }
        };
          

        $.ajax(settings).done(function (response) {
            if (!response.error) {
                $('#update_vendor_details_form #shop_state .added-through-api').remove();

                let states = response.data.states.map((state) => {
                    let newOption = $('<option>', {
                        value: state.name,
                        text: state.name,
                        class: "added-through-api"
                    });

                    return newOption;
                });
                
                $('#update_vendor_details_form #shop_state').append(states);
            }
        });
    })

    /**
     * On change of state get cities
     */
    $('#update_vendor_details_form #shop_state').change((el) => {
        let country = $('#shop_country').val();
        let state = $(el.currentTarget).val();

        var settings = {
            "url": 'https://countriesnow.space/api/v0.1/countries/state/cities',
            "method": "POST",
            data: {
                "country": country,
                "state": state
            }
        }

        $.ajax(settings).done(function (response) {
            if (!response.error) {
                $('#update_vendor_details_form #shop_city .added-through-api').remove();
                
                let cities = response.data.map((city) => {
                    let newOption = $('<option>', {
                        value: city,
                        text: city,
                        class: "added-through-api"
                    });

                    return newOption;
                });
                
                $('#update_vendor_details_form #shop_city').append(cities);
            }
        });
    });

    // Business Details
    /**
     * On change of country name - load city
     */
    $('#update_vendor_details_form #shop_country').change((el) => {
        let country = $(el.currentTarget).val();

        var settings = {
            "url": 'https://countriesnow.space/api/v0.1/countries/states',
            "method": "POST",
            data: {
                "country": country
            }
        };

        $.ajax(settings).done(function (response) {
            if (!response.error) {
                $('#update_vendor_details_form #shop_state .added-through-api').remove();
                let selected = $('#update_vendor_details_form input[name="prev_shop_state_value"]').val();
                console.log(selected)

                let states = response.data.states.map((state) => {
                    let newOption = $('<option>', {
                        value: state.name,
                        text: state.name,
                        class: "added-through-api"
                    });

                    if (selected == state.name) newOption.prop('selected', true);
                    
                    return newOption;
                });
                
                $('#update_vendor_details_form #shop_state').append(states);
                $('#update_vendor_details_form #shop_state').change();
                requestGeocode(country);
            }
        });
    })

    $('#update_vendor_details_form #shop_country').trigger('change');

    /**
     * On change of state get cities
     */
    $('#update_vendor_details_form #shop_state').change((el) => {
        let country = $('#update_vendor_details_form #shop_country').val();
        let state = $(el.currentTarget).val();

        var settings = {
            "url": 'https://countriesnow.space/api/v0.1/countries/state/cities',
            "method": "POST",
            data: {
                "country": country,
                "state": state
            }
        }

        $.ajax(settings).done(function (response) {
            if (!response.error) {
                $('#update_vendor_details_form #shop_city .added-through-api').remove();
                
                let cities = response.data.map((city) => {
                    let newOption = $('<option>', {
                        value: city,
                        text: city,
                        class: "added-through-api"
                    });

                    return newOption;
                });
                
                $('#update_vendor_details_form #shop_city').append(cities);
                requestGeocode(`${state}, ${country}`);
            }
        });
    });
 

    let business_address;
    let timeoutId;
    $('#update_vendor_details_form #shop_city').keyup(function (e) {
        let business_city_val = $(e.currentTarget).val();
        clearTimeout(timeoutId);
        
        let country = $('#update_vendor_details_form #shop_country').val();
        let state = $('#update_vendor_details_form #shop_city').val();
        business_address = `${business_city_val}, ${state}, ${country}`;
        timeoutId = setTimeout(() => {
            requestGeocode(business_address)
        }, 300);
    })
    

    $('#update_vendor_details_form #shop_address').keyup(function (e) {
        let business_address_val = $(e.currentTarget).val();
        clearTimeout(timeoutId);

        let country = $('#update_vendor_details_form #shop_country').val();
        let state = $('#update_vendor_details_form #shop_state').val();
        let city = $('#update_vendor_details_form #shop_city');
        business_address = `${business_address_val} ${city}, ${state}, ${country}`;
        timeoutId = setTimeout(() => {
            requestGeocode(business_address)
        }, 300);
    })


    $(".attached_refund_image").click(function(event) {
        event.preventDefault();
        let log_id = $(event.currentTarget).data('log');
        let order_id = $(event.currentTarget).data('order');

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, // X-CSRF-TOKEN: https://laravel.com/docs/9.x/csrf#csrf-x-csrf-token    
            type   : 'get',
            url    : `/admin/orders/${order_id}/refund-log-details/${log_id}`,
            success: function(resp) {
                if (resp.success) {
                    $('#refund-detail-modal').html(resp.view)
                    $(".refund_image_popup_container").addClass("active");
                    
                    $(".refund_image_popup_container .close_refund_popup").click(function(event) {
                        event.preventDefault();
                        $(".refund_image_popup_container").removeClass("active");
                    });
                }
            },
            error  : function(err) {alert(err.response.message);}
        });
    });


})