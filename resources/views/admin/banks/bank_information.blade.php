@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <style>
                .form-control[name="bank_name"] {
                    color: #495057;
                    outline: 1px solid #495057;
                }

                button[type="save"] {
                    background: #5f7a61 !important;
                    color: #FFF !important;
                    border-radius: 10px;
                    width: 100%;
                    max-width: calc(50% - 20px);
                }

                h3.font-weight-bold {
                    margin-bottom: 50px;
                }

                @media (max-width: 767px) {
                    .row {
                        position: relative;
                    }

                    h3.font-weight-bold {
                        margin-bottom: 20px;
                    }

                    button[type="save"] {
                        width: 100%;
                    }
                }
            </style>
            <form action="{{ url('admin/bank/edit') }}" method="post">
                @csrf
                <div class="row">
                    <button
                        class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                        type="button" data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Vendor Bank Details</h3>
                    </div>

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bank Information</h4>
                                <div class="form-group">
                                    <label for="vendor_name">Account Holder Name</label>
                                    <input type="text" class="form-control" name="account_holder_name"
                                        @if (isset($vendorDetails['vendor_bank']['account_holder_name'])) value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}" @endif>
                                    {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                                <div class="form-group">
                                    <label for="vendor_name">Bank Name</label>
                                    <select class="form-control" name="bank_name" id="bank_name">
                                        {{-- @if (isset($vendorDetails['vendor_bank']['bank_name'])) value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" @endif> --}}
                                        <option value="" {{ !isset($vendorDetails['vendor_bank']['bank_name']) ? 'selected' : '' }}>Select Bank</option>
                                        @foreach ($bank_list as $bank_name => $bank_code)
                                            <option value="{{ $bank_name }}" data-bank_code="{{ $bank_code }}"
                                                {{ isset($vendorDetails['vendor_bank']['bank_name']) && $vendorDetails['vendor_bank']['bank_name'] == $bank_name ? 'selected' : '' }}>
                                                {{ $bank_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="bank_ifsc_code" id="bank_ifsc_code">
                                <div class="form-group">
                                    <label for="vendor_address">Account Number</label>
                                    <input type="text" class="form-control" name="account_number"
                                        @if (isset($vendorDetails['vendor_bank']['account_number'])) value="{{ $vendorDetails['vendor_bank']['account_number'] }}" @endif>
                                    {{-- $vendorDetails was passed from AdminController --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="save">Save</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#bank_name').change(function() {
                var bank_code = $('#bank_name option:selected').data('bank_code');
                if (bank_code) {
                    $('#bank_ifsc_code').val(bank_code);
                } else {
                    $('#bank_ifsc_code').val('N/A');
                }
            });
        });
    </script>
@endsection
