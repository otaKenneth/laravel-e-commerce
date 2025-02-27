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
        $bank_list = array(
            'BDO Unibank, Inc.'                     => 'BDO',
            'Bank of the Philippine Islands'        => 'BPI',
            'China Banking Corporation'             => 'CBC',
            'CIMB Bank Philippines'                 => 'CIMB',
            'Coins.ph'                              => 'COIN',
            'East West Banking Corporation'         => 'EWBC',
            'GrabPay'                               => 'GRB',
            'GCash'                                 => 'GCASH',
            'GoTyme'                                => 'GT',
            'Land Bank of the Philippines'          => 'LBP',
            'Maya Philippines, Inc.'                => 'MAYA',
            'Metropolitan Bank & Trust Company'     => 'METRO',
            'Philippine National Bank'              => 'PNB',
            'Rizal Commercial Banking Corporation'  => 'RCBC',
            'Security Bank Corporation'             => 'SBC',
            'ShopeePay'                             => 'SP',
            'Union Bank of the Philippines'         => 'UBP',
        );

        if ($vendor_id) {
            $vendorDetails = Vendor::with('vendor_bank')->find($vendor_id);
        }

        return view('admin.banks.bank_information')->with(compact('vendorDetails', 'bank_list'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'account_holder_name'   => "required",
            'bank_name'             => "required",
            'account_number'        => "required"
        ]);

        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $vendor_bank = VendorsBankDetail::where('vendor_id', $vendor_id)->first();
        
        if ($vendor_bank) {
            $vendor_bank->update([
                'account_holder_name'   => $request->input('account_holder_name'),
                'bank_name'             => $request->input('bank_name'),
                'account_number'        => $request->input('account_number'),
                'vendor_id'             => $vendor_id,
            ]);
            $vendor_bank->save();
        } else {
            $vendor_bank = [
                'account_holder_name'   => $request->input('account_holder_name'),
                'bank_name'             => $request->input('bank_name'),
                'account_number'        => $request->input('account_number'),
                'vendor_id'             => $vendor_id,
            ];
            $vendor_bank = VendorsBankDetail::create($vendor_bank);
        }

        $bank_list = array(
            'BDO Unibank, Inc.'                     => 'BDO',
            'Bank of the Philippine Islands'        => 'BPI',
            'China Banking Corporation'             => 'CBC',
            'CIMB Bank Philippines'                 => 'CIMB',
            'Coins.ph'                              => 'COIN',
            'East West Banking Corporation'         => 'EWBC',
            'GrabPay'                               => 'GRB',
            'GCash'                                 => 'GCASH',
            'GoTyme'                                => 'GT',
            'Land Bank of the Philippines'          => 'LBP',
            'Maya Philippines, Inc.'                => 'MAYA',
            'Metropolitan Bank & Trust Company'     => 'METRO',
            'Philippine National Bank'              => 'PNB',
            'Rizal Commercial Banking Corporation'  => 'RCBC',
            'Security Bank Corporation'             => 'SBC',
            'ShopeePay'                             => 'SP',
            'Union Bank of the Philippines'         => 'UBP',
        );

        $vendorDetails = Vendor::with('vendor_bank')->find($vendor_id);

        return redirect()->route('admin.bank.details')->with([
            'vendorDetails' => $vendorDetails,
            'bank_list'     => $bank_list
        ]);
        
    }
}
