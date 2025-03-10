@extends('admin.layout.layout')


@section('content')
    <div class="main-panel income-statement">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin mobile-space-top">
                    <button class="custom_btn_for_navbar_mobile dashboard_nav_btn navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="icon-menu"></span>
                    </button>
                 
                    <h3 class="font-weight-bold page--title">
                    @if ($auth_type == 'vendor')
                        Income Statement
                    @else
                        General Finances
                    @endif
                    </h3>
                  

                    <div class="flex-box-container">

                        <div class="card">
                            <div class="card-body">
                                <p class="mb-4">
                                @if ($auth_type == 'vendor')
                                    Upcoming Payout
                                @else
                                    Total Payout
                                @endif
                                </p>
                                <p class="fs-30 mb-2">₱ {{ number_format($latest_payout, 2) }}</p>
                                
                                @if ($auth_type == 'vendor')
                                <div class="footnote-container">
                                    <p class="footnote">*To be released on March 7 2025</p>
                                    <p class="footnote">*Disbursed on Bank Account ending in 1234</p>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-4">Total Revenue</p>
                                <p class="fs-30 mb-2">₱ {{ number_format($revenue, 2) }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-4">Total Fees Paid</p>
                                <p class="fs-30 mb-2">₱ {{ number_format($total_income->total_income, 2) }}</p>
                            </div>
                        </div>

                    </div>

                    <h3 class="table-head">
                    @if ($auth_type == 'vendor')
                        Release History
                    @else
                        Merchant Finances
                    @endif
                        
                    </h3>

                    <div class="card">
                        <form name="admin.sales_transaction_form" method="post" action="{{ url('admin/finance/income_statement') }}">
                            @csrf
                            <div class="card-body">
                                <div class="table-container">
                                    <table>
                                        <tr>
                                            <th>Date</th>
                                            <th>Destination Bank</th>
                                            <th>Account Number</th>
                                            <th>Transaction Number</th>
                                            @if ($auth_type != 'vendor')
                                            <th>Status</th>
                                            @endif
                                            <th>Amount</th>
                                        </tr>
                                        @foreach ($releases as $release)
                                        <tr>
                                            <input type="hidden" name="release[{{ $release['Date Range'] }}]" value="{{ json_encode($release) }}">
                                            <td>{{ $release['Date Range'] }}</td>
                                            <td>{{ $release['bank_name'] }}</td>
                                            <td>{{ $release['account_number'] }}</td>
                                            <td>
                                                @if ($auth_type != 'vendor')
                                                <input type="text" name="transaction_num[{{ $release['Date Range'] }}]" id="transaction_num[{{ $release['Date Range'] }}]" value="{{ $release['transaction_number'] }}">
                                                @endif
                                            </td>
                                            @if ($auth_type != 'vendor')
                                            <td></td>
                                            @endif
                                            <td>₱ {{ $release['amount'] }}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <input type="submit" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022. All rights reserved.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>



    
@endsection