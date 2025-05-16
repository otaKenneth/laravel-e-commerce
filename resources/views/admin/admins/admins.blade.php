@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <button class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center mb-3" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>

        @php
            $renderTables = [];

            if ($title == "Vendors") {
                $renderTables['Active Vendors'] = array_filter($admins, fn($a) => $a['status'] == 1);
                $renderTables['Inactive Vendors'] = array_filter($admins, fn($a) => $a['status'] == 0);
            } elseif ($title == "All Admins/Subadmins/Vendors") {
                $renderTables['Superadmins'] = array_filter($admins, fn($a) => $a['type'] == 'superadmin');
                $renderTables['Vendors'] = array_filter($admins, fn($a) => $a['type'] == 'vendor');
            } else {
                $renderTables[$title] = $admins;
            }
        @endphp

        @foreach ($renderTables as $tableTitle => $adminList)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">{{ $tableTitle }}</h4>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Admin ID</th>
                                            <th>{{ str_contains($tableTitle, 'Vendor') ? 'Business Name' : 'Name' }}</th>
                                            <th>Type</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Verified</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($adminList as $admin)
                                            <tr>
                                                <td>{{ $admin['id'] }}</td>
                                                <td>{{ $admin['type'] == "vendor" ? $admin['vendor_business']['shop_name'] ?? '-' : $admin['name'] }}</td>
                                                <td>{{ $admin['type'] }}</td>
                                                <td>{{ $admin['mobile'] }}</td>
                                                <td>{{ $admin['email'] }}</td>
                                                <td>
                                                    @if (!empty($admin['image']))
                                                        <img src="{{ $getImage('admin/images/photos/', $admin['image']) }}" style="width: 50px; height: auto;">
                                                    @else
                                                        <img src="{{ asset('admin/images/photos/no-image.gif') }}" style="width: 50px; height: auto;">
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="updateAdminConfirmed" id="admin-verified-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)">
                                                        <i style="font-size: 25px" class="mdi {{ $admin['confirm'] == 'Yes' ? 'mdi-bookmark-check' : 'mdi-bookmark-outline' }}" status="{{ $admin['confirm'] == 'Yes' ? 'Active' : 'Inactive' }}"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)">
                                                        <i style="font-size: 25px" class="mdi {{ $admin['status'] == 1 ? 'mdi-bookmark-check' : 'mdi-bookmark-outline' }}" status="{{ $admin['status'] == 1 ? 'Active' : 'Inactive' }}"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($admin['type'] == 'vendor')
                                                        <a href="{{ url('admin/view-vendor-details/' . $admin['id']) }}">
                                                            <i style="font-size: 25px" class="mdi mdi-file-document"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="9" class="text-center">No {{ $tableTitle }} found.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!-- content-wrapper ends -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                Copyright © {{ date('Y') }}. All rights reserved.
            </span>
        </div>
    </footer>
</div>
@endsection
