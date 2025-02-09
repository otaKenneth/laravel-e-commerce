@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <form action="{{ url('admin/bank/edit') }}" method="post">
        @csrf
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Bank Information</h4>
                            <div class="form-group">
                                <label for="vendor_name">Account Holder Name</label>
                                <input type="text" class="form-control" name="account_holder_name"  @if (isset($vendorDetails['vendor_bank']['account_holder_name'])) value="{{ $vendorDetails['vendor_bank']['account_holder_name'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                            <div class="form-group">
                                <label for="vendor_name">Bank Name</label>
                                <select class="form-control" name="bank_name" @if (isset($vendorDetails['vendor_bank']['bank_name'])) value="{{ $vendorDetails['vendor_bank']['bank_name'] }}" @endif>
                                    @foreach ($bank_list as $bank_name)
                                    <option value="{{ $bank_name }}">{{ $bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Account Number</label>
                                <input type="text" class="form-control" name="account_number" @if (isset($vendorDetails['vendor_bank']['account_number'])) value="{{ $vendorDetails['vendor_bank']['account_number'] }}" @endif> {{-- $vendorDetails was passed from AdminController --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="save">Save</button>
        </form>
    </div>
</div>
@endsection