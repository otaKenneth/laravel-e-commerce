<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorsBankDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorBankController extends Controller
{
    public function index () {
        Session::put('page', 'update_bank_details');

        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $bank_list = [
            'BDO Unibank, Inc.',
            'Bank of the Philippine Islands',
            'China Banking Corporation',
            'CIMB Bank Philippines',
            'Coins.ph',
            'East West Banking Corporation',
            'GrabPay',
            'GCash',
            'GoTyme',
            'Land Bank of the Philippines',
            'Maya Philippines, Inc.',
            'Metropolitan Bank & Trust Company',
            'Philippine National Bank',
            'Rizal Commercial Banking Corporation',
            'Security Bank Corporation',
            'ShopeePay',
            'Union Bank of the Philippines'
        ];
        if ($vendor_id) {
            
            $vendorDetails = Vendor::with('vendor_bank')->find($vendor_id);
        }

        return view('admin.banks.bank_information')->with(compact('vendorDetails', 'bank_list'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'account_holder_name' => "required",
            'bank_name' => "required",
            'account_number' => "required"
        ]);

        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $vendor_bank = VendorsBankDetail::where('vendor_id', $vendor_id)->first();
        
        if ($vendor_bank) {
            $vendor_bank->update([
                'account_holder_name' => $request->input('account_holder_name'),
                'bank_name' => $request->input('bank_name'),
                'account_number' => $request->input('account_number'),
                'vendor_id' => $vendor_id
            ]);
            $vendor_bank->save();
        } else {
            $vendor_bank = [
                'account_holder_name' => $request->input('account_holder_name'),
                'bank_name' => $request->input('bank_name'),
                'account_number' => $request->input('account_number'),
                'vendor_id' => $vendor_id
            ];
            $vendor_bank = VendorsBankDetail::create($vendor_bank);
        }

        $bank_list = [
            'BDO Unibank, Inc.',
            'Bank of the Philippine Islands',
            'China Banking Corporation',
            'CIMB Bank Philippines',
            'Coins.ph',
            'East West Banking Corporation',
            'GrabPay',
            'GCash',
            'GoTyme',
            'Land Bank of the Philippines',
            'Maya Philippines, Inc.',
            'Metropolitan Bank & Trust Company',
            'Philippine National Bank',
            'Rizal Commercial Banking Corporation',
            'Security Bank Corporation',
            'ShopeePay',
            'Union Bank of the Philippines'
        ];
        $vendorDetails = Vendor::with('vendor_bank')->find($vendor_id);
        return view('admin.banks.bank_information')->with(compact('vendorDetails', 'bank_list'));
    }
}
