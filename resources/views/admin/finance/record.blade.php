@extends('admin.layout.app')
@section('content')
@inject('controller', 'App\Http\Controllers\admin\FinanceController')
<style>
    .d-none {
        display: none !important;
    }

    .d-block {
        display: block !important;
    }
    .active{
        background: #00A9E0 !important;
        border-top: 1px solid #855D10 !important;        
    }
</style>
<style>
    .flash-message {
    transition: opacity 0.5s ease-in-out;
}

</style>
<div class="main-container container">
    @include('admin.layout.sidebar')
    <div class="col-lg-12 main-content">
        <div id="breadcrumbs" class="breadcrumbs">
            <div id="menu-toggler-container" class="hidden-lg">
                <span id="menu-toggler">
                    <i class="glyphicon glyphicon-new-window"></i>
                    <span class="menu-toggler-text">Menu</span>
                </span>
            </div>
            <ul class="breadcrumb">
            </ul>
        </div>

        <div class="page-content" style="margin-top: -10px">
            @if (request('success'))
    <div class="alert alert-success flash-message">Updated Successfully</div>
@endif

            <div id="tabs">
                        <form method="GET" action="{{ route('finance.record') }}" class="form-inline mb-3">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Search..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                <div class="qus-tabs financead">
                    <form method="GET" action="{{ route('finance.record') }}">
                        <div class="form-group pull-right">
                            <div class="input-group pull-right">
                            <select name="y" onchange="this.form.submit();" class="form-control pull-right">
                                <option value="">Select Year</option>
                                @if(isset($available_year) && !empty($available_year))
                                    @foreach($available_year as $key => $value)
                                        <option value="{{ $value }}" @if(request('y') == $value) selected @endif>{{ $value }}</option>
                                    @endforeach
                                @else
                                    @php
                                        $currentYear = (int) date('Y');
                                        $currentMonth = (int) date('m');
                                        $financial_year_start = $currentMonth >= 4 ? $currentYear : $currentYear - 1;
                                        $defaultYears = [];
                                        for ($i = -5; $i <= 1; $i++) {
                                            $start_year = $financial_year_start + $i;
                                            $end_year = $start_year + 1;
                                            $defaultYears[] = $start_year . '-' . $end_year;
                                        }
                                        rsort($defaultYears);
                                    @endphp
                                    @foreach($defaultYears as $yearRange)
                                        <option value="{{ $yearRange }}" @if(request('y') == $yearRange) selected @endif>{{ $yearRange }}</option>
                                    @endforeach
                                @endif
                            </select>
                                <input type="hidden" value="3" name="c">
                                <label class="pull-right">SELECT FINANCIAL YEAR</label>
                            </div>
                        </div>
                    </form>
                </div>
                
                @if(isset($selected_year_range) && $selected_year_range)
                <!-- Tax Settings Display Section -->
                <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="border: 1px solid #ddd; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                            <div class="panel-heading" style="background-color: #f5f5f5; border-bottom: 1px solid #ddd; padding: 15px;">
                                <h4 style="margin: 0; color: #333; font-size: 18px;">
                                    <i class="fa fa-calculator" style="margin-right: 8px; color: #5cb85c;"></i>
                                    Tax Settings for Financial Year: <strong style="color: #5cb85c;">{{ $selected_year_range }}</strong>
                                </h4>
                            </div>
                            <div class="panel-body" style="padding: 20px;">
                                <div class="row">
                                    <!-- Tax Settings (FinanceTaxRecord) -->
                                    <div class="col-lg-6">
                                        <h5 style="margin-top: 0; margin-bottom: 15px; color: #333; font-weight: 600;">
                                            <i class="fa fa-file-text-o" style="margin-right: 8px; color: #337ab7;"></i>
                                            Income Tax Settings
                                        </h5>
                                        @if(isset($finance_tax_record) && $finance_tax_record)
                                            <table class="table table-bordered table-sm" style="margin-bottom: 0;">
                                                <thead style="background-color: #f9f9f9;">
                                                    <tr>
                                                        <th style="width: 40%;">Tax Band</th>
                                                        <th style="width: 30%;">Amount</th>
                                                        <th style="width: 30%;">Rate</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Personal Allowance Rate</td>
                                                        <td>£{{ number_format($finance_tax_record->personal_allowance_rate ?? 0, 2) }}</td>
                                                        <td>{{ $finance_tax_record->personal_allowance_rate_tax ?? 0 }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Basic Rate</td>
                                                        <td>£{{ number_format($finance_tax_record->basic_rate ?? 0, 2) }}</td>
                                                        <td>{{ $finance_tax_record->basic_rate_tax ?? 0 }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Higher Rate</td>
                                                        <td>£{{ number_format($finance_tax_record->higher_rate ?? 0, 2) }}</td>
                                                        <td>{{ $finance_tax_record->higher_rate_tax ?? 0 }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Additional Rate</td>
                                                        <td>£{{ number_format($finance_tax_record->additional_rate ?? 0, 2) }}</td>
                                                        <td>{{ $finance_tax_record->additional_rate_tax ?? 0 }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Company Limited Tax</td>
                                                        <td colspan="2">{{ $finance_tax_record->company_limited_tax ?? 0 }}%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <div style="padding: 20px; text-align: center; background-color: #f9f9f9; border: 1px dashed #ddd; border-radius: 4px;">
                                                <i class="fa fa-exclamation-circle" style="font-size: 24px; color: #999; margin-bottom: 10px; display: block;"></i>
                                                <p class="text-muted" style="margin: 0;">No income tax settings found for this financial year.</p>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- NI Tax Settings (FinanceNiTaxRecord) -->
                                    <div class="col-lg-6">
                                        <h5 style="margin-top: 0; margin-bottom: 15px; color: #333; font-weight: 600;">
                                            <i class="fa fa-shield" style="margin-right: 8px; color: #5cb85c;"></i>
                                            National Insurance (NI) Tax Settings
                                        </h5>
                                        @if(isset($finance_ni_tax) && $finance_ni_tax)
                                            <table class="table table-bordered table-sm" style="margin-bottom: 0;">
                                                <thead style="background-color: #f9f9f9;">
                                                    <tr>
                                                        <th style="width: 40%;">Class</th>
                                                        <th style="width: 30%;">Amount</th>
                                                        <th style="width: 30%;">Rate</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Class 4 Amount 1</td>
                                                        <td>£{{ number_format($finance_ni_tax->c4_min_ammount_1 ?? 0, 2) }}</td>
                                                        <td>{{ $finance_ni_tax->c4_min_ammount_tax_1 ?? 0 }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Class 4 Amount 2</td>
                                                        <td>£{{ number_format($finance_ni_tax->c4_min_ammount_2 ?? 0, 2) }}</td>
                                                        <td>{{ $finance_ni_tax->c4_min_ammount_tax_2 ?? 0 }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Class 4 Amount 3</td>
                                                        <td>£{{ number_format($finance_ni_tax->c4_min_ammount_3 ?? 0, 2) }}</td>
                                                        <td>{{ $finance_ni_tax->c4_min_ammount_tax_3 ?? 0 }}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Class 2 Amount</td>
                                                        <td>£{{ number_format($finance_ni_tax->c2_min_amount ?? 0, 2) }}</td>
                                                        <td>{{ $finance_ni_tax->c2_tax ?? 0 }}%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <div style="padding: 20px; text-align: center; background-color: #f9f9f9; border: 1px dashed #ddd; border-radius: 4px;">
                                                <i class="fa fa-exclamation-circle" style="font-size: 24px; color: #999; margin-bottom: 10px; display: block;"></i>
                                                <p class="text-muted" style="margin: 0;">No NI tax settings found for this financial year.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div id="fre-tab">
                <div class="cat-tabs">
                    <ul style="display: flex; flex-direction: row;">
                        @php
                        $iterator = 0;
                        @endphp
                        @foreach($professions as $key => $value)
                        @if($iterator == '0')
                            <li id="All-content" class="d-block" style="margin:5px 0px !important;"><a href="#">All</a>
                            </li>
                            @php
                            $iterator = $iterator + 1;
                            @endphp
                        @endif
                        @if($value->is_active != '0' && $value->name == 'Dentistry')
                        <li id="Dentistry-content" class="d-block" style="margin:5px 0px !important;"><a href="#">Dentistry</a>
                        </li>
                        @endif
                        @if($value->is_active != '0' && $value->name == 'Optometry')
                        <li id="Optometry-content" class="d-block" style="margin:5px 0px !important;"><a href="#">Optometry</a>
                        </li>
                        @endif
                        @if($value->is_active != '0' && $value->name == 'Pharmacy')
                        <li id="Pharmacy-content" class="d-block" style="margin:5px 0px !important;"><a href="#">Pharmacy</a>
                        </li>
                        @endif
                        @if($value->is_active != '0' && $value->name == 'Domiciliary Opticians')
                        <li id="Domiciliary_Opticians-content" class="d-block" style="margin:5px 0px !important;"><a href="#">Domiciliary Opticians</a>
                        </li>
                        @endif
                        @if($value->is_active != '0' && $value->name == 'Audiologists')
                        <li id="Audiologists-content" class="d-block" style="margin:5px 0px !important;"><a href="#">Audiologists</a>
                        </li>
                        @endif
                        @if($value->is_active != '0' && $value->name == 'Dispensing Optician / Contact lens Optician')
                        <li id="Dispensing_Optician-content" class="d-block" style="margin:5px 0px !important;"><a href="#">Dispensing Optician / Contact lens Optician</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <table class="table clickable table-striped table-hover d-block" id="All-click">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr style="background-color: white !important;">
                            <th class="text-center">User ID</th>
                            <th class="text-center"><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">Login</a></th>

                            <th class="text-center">Financial Year</th>
                            <th class="text-center">Profit&nbsp;and&nbsp;loss</th>
                            <th class="text-center">Balance&nbsp;sheet</th>
                            <th class="text-center">All&nbsp;Transactions</th>
                            <th class="text-center">Supplier&nbsp;List</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if(isset($year) && !empty($year))
                            @foreach($year as $finYearRange => $numusers)
                                @foreach($numusers as $keys => $numuser)
                                    <tr style="background-color: white !important;">
                                        <td class="text-center">{{ $numuser['user_id'] }}</td>
                                        <td class="text-center">{{ $numuser['login'] }}</td>
                                        <td class="text-center">
                                            {{ $numuser['start_month'] }} - {{ $numuser['end_month'] }} ({{ $finYearRange }})
                                        </td>
                                        <td class="text-center">
                                            @php
                                                // Extract start year from range (e.g., "2023-2024" -> 2023)
                                                $yearParts = explode('-', $finYearRange);
                                                $startYear = isset($yearParts[0]) ? (int)$yearParts[0] : date('Y');
                                            @endphp
                                            <a href="{{ route('finance.profit.loss', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('finance.balancesheet', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('finance.alltransactions', ['id' => $numuser['user_id'], 'year' => $numuser['fin_year'] ?? $finYearRange]) }}" class="btn btn-xs btn-info">All Transactions</a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('finance.supplierlist', ['id' => $numuser['user_id']]) }}" class="btn btn-xs btn-info">Supplier List</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center" style="padding: 40px 20px;">
                                    @if(isset($selected_year_range) && $selected_year_range)
                                        <div style="color: #666; font-size: 14px;">
                                            <i class="fa fa-info-circle" style="font-size: 24px; color: #999; margin-bottom: 10px; display: block;"></i>
                                            <p style="margin: 10px 0; font-weight: 500;">No records found for financial year <strong style="color: #333;">{{ $selected_year_range }}</strong>.</p>
                                            <p style="margin: 5px 0; font-size: 12px; color: #999;">This may be because:</p>
                                            <ul style="text-align: left; display: inline-block; margin: 10px 0; padding-left: 20px; color: #999; font-size: 12px;">
                                                <li>No users have financial year settings configured for this period</li>
                                                <li>No transactions exist for this financial year</li>
                                            </ul>
                                        </div>
                                    @else
                                        <div style="color: #666; font-size: 14px;">
                                            <i class="fa fa-calendar" style="font-size: 24px; color: #999; margin-bottom: 10px; display: block;"></i>
                                            <p style="margin: 10px 0; font-weight: 500;">Please select a financial year from the dropdown above to view records.</p>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="table clickable table-striped table-hover d-none" id="Dentistry">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr style="background-color: white !important;">
                            <th class="text-center">User ID</th>
                            <th class="text-center"><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">Login</a></th>

                            <th class="text-center">Financial Year</th>
                            <th class="text-center">Profit&nbsp;and&nbsp;loss</th>
                            <th class="text-center">Balance&nbsp;sheet</th>
                            <th class="text-center">All&nbsp;Transactions</th>
                            <th class="text-center">Supplier&nbsp;List</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if(isset($year) && !empty($year))
                            @foreach($year as $finYearRange => $numusers)
                                @foreach($numusers as $keys => $numuser)
                                    @if($numuser['user_acl_profession_id'] == '1')
                                        <tr style="background-color: white !important;">
                                            <td class="text-center">{{ $numuser['user_id'] }}</td>
                                            <td class="text-center">{{ $numuser['login'] }}</td>
                                            <td class="text-center">
                                                {{ $numuser['start_month'] }} - {{ $numuser['end_month'] }} ({{ $finYearRange }})
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $yearParts = explode('-', $finYearRange);
                                                    $startYear = isset($yearParts[0]) ? (int)$yearParts[0] : date('Y');
                                                @endphp
                                                <a href="{{ route('finance.profit.loss', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.balancesheet', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.alltransactions', ['id' => $numuser['user_id'], 'year' => $numuser['fin_year'] ?? $finYearRange]) }}" class="btn btn-xs btn-info">All Transactions</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.supplierlist', ['id' => $numuser['user_id']]) }}" class="btn btn-xs btn-info">Supplier List</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-muted">No records found.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>                    
                </table>
                <table class="table clickable table-striped table-hover d-none" id="Optometry">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr style="background-color: white !important;">
                            <th class="text-center">User ID</th>
                            <th class="text-center"><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">Login</a></th>

                            <th class="text-center">Financial Year</th>
                            <th class="text-center">Profit&nbsp;and&nbsp;loss</th>
                            <th class="text-center">Balance&nbsp;sheet</th>
                            <th class="text-center">All&nbsp;Transactions</th>
                            <th class="text-center">Supplier&nbsp;List</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($year) && !empty($year))
                            @foreach($year as $finYearRange => $numusers)
                                @foreach($numusers as $keys => $numuser)
                                    @if($numuser['user_acl_profession_id'] == '3')
                                        <tr style="background-color: white !important;">
                                            <td class="text-center">{{ $numuser['user_id'] }}</td>
                                            <td class="text-center">{{ $numuser['login'] }}</td>
                                            <td class="text-center">
                                                {{ $numuser['start_month'] }} - {{ $numuser['end_month'] }} ({{ $finYearRange }})
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $yearParts = explode('-', $finYearRange);
                                                    $startYear = isset($yearParts[0]) ? (int)$yearParts[0] : date('Y');
                                                @endphp
                                                <a href="{{ route('finance.profit.loss', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.balancesheet', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.alltransactions', ['id' => $numuser['user_id'], 'year' => $numuser['fin_year'] ?? $finYearRange]) }}" class="btn btn-xs btn-info">All Transactions</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.supplierlist', ['id' => $numuser['user_id']]) }}" class="btn btn-xs btn-info">Supplier List</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-muted">No records found.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="table clickable table-striped table-hover d-none" id="Pharmacy">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr style="background-color: white !important;">
                            <th class="text-center">User ID</th>
                            <th class="text-center"><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">Login</a></th>

                            <th class="text-center">Financial Year</th>
                            <th class="text-center">Profit&nbsp;and&nbsp;loss</th>
                            <th class="text-center">Balance&nbsp;sheet</th>
                            <th class="text-center">All&nbsp;Transactions</th>
                            <th class="text-center">Supplier&nbsp;List</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if(isset($year) && !empty($year))
                            @foreach($year as $finYearRange => $numusers)
                                @foreach($numusers as $keys => $numuser)
                                    @if($numuser['user_acl_profession_id'] == '4')
                                        <tr style="background-color: white !important;">
                                            <td class="text-center">{{ $numuser['user_id'] }}</td>
                                            <td class="text-center">{{ $numuser['login'] }}</td>
                                            <td class="text-center">
                                                {{ $numuser['start_month'] }} - {{ $numuser['end_month'] }} ({{ $finYearRange }})
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $yearParts = explode('-', $finYearRange);
                                                    $startYear = isset($yearParts[0]) ? (int)$yearParts[0] : date('Y');
                                                @endphp
                                                <a href="{{ route('finance.profit.loss', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.balancesheet', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.alltransactions', ['id' => $numuser['user_id'], 'year' => $numuser['fin_year'] ?? $finYearRange]) }}" class="btn btn-xs btn-info">All Transactions</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.supplierlist', ['id' => $numuser['user_id']]) }}" class="btn btn-xs btn-info">Supplier List</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-muted">No records found.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>               
                </table>
                <table class="table clickable table-striped table-hover d-none" id="Domiciliary_Opticians">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr style="background-color: white !important;">
                            <th class="text-center">User ID</th>
                            <th class="text-center"><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">Login</a></th>

                            <th class="text-center">Financial Year</th>
                            <th class="text-center">Profit&nbsp;and&nbsp;loss</th>
                            <th class="text-center">Balance&nbsp;sheet</th>
                            <th class="text-center">All&nbsp;Transactions</th>
                            <th class="text-center">Supplier&nbsp;List</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($year) && !empty($year))
                            @foreach($year as $finYearRange => $numusers)
                                @foreach($numusers as $keys => $numuser)
                                    @if($numuser['user_acl_profession_id'] == '8')
                                        <tr style="background-color: white !important;">
                                            <td class="text-center">{{ $numuser['user_id'] }}</td>
                                            <td class="text-center">{{ $numuser['login'] }}</td>
                                            <td class="text-center">
                                                {{ $numuser['start_month'] }} - {{ $numuser['end_month'] }} ({{ $finYearRange }})
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $yearParts = explode('-', $finYearRange);
                                                    $startYear = isset($yearParts[0]) ? (int)$yearParts[0] : date('Y');
                                                @endphp
                                                <a href="{{ route('finance.profit.loss', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.balancesheet', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.alltransactions', ['id' => $numuser['user_id'], 'year' => $numuser['fin_year'] ?? $finYearRange]) }}" class="btn btn-xs btn-info">All Transactions</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.supplierlist', ['id' => $numuser['user_id']]) }}" class="btn btn-xs btn-info">Supplier List</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-muted">No records found.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="table clickable table-striped table-hover d-none" id="Audiologists">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr style="background-color: white !important;">
                            <th class="text-center">User ID</th>
                            <th class="text-center"><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">Login</a></th>

                            <th class="text-center">Financial Year</th>
                            <th class="text-center">Profit&nbsp;and&nbsp;loss</th>
                            <th class="text-center">Balance&nbsp;sheet</th>
                            <th class="text-center">All&nbsp;Transactions</th>
                            <th class="text-center">Supplier&nbsp;List</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($year) && !empty($year))
                            @foreach($year as $finYearRange => $numusers)
                                @foreach($numusers as $keys => $numuser)
                                    @if($numuser['user_acl_profession_id'] == '9')
                                        <tr style="background-color: white !important;">
                                            <td class="text-center">{{ $numuser['user_id'] }}</td>
                                            <td class="text-center">{{ $numuser['login'] }}</td>
                                            <td class="text-center">
                                                {{ $numuser['start_month'] }} - {{ $numuser['end_month'] }} ({{ $finYearRange }})
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $yearParts = explode('-', $finYearRange);
                                                    $startYear = isset($yearParts[0]) ? (int)$yearParts[0] : date('Y');
                                                @endphp
                                                <a href="{{ route('finance.profit.loss', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.balancesheet', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.alltransactions', ['id' => $numuser['user_id'], 'year' => $numuser['fin_year'] ?? $finYearRange]) }}" class="btn btn-xs btn-info">All Transactions</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.supplierlist', ['id' => $numuser['user_id']]) }}" class="btn btn-xs btn-info">Supplier List</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-muted">No records found.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <table class="table clickable table-striped table-hover d-none" id="Dispensing_Optician">
                    <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr style="background-color: white !important;">
                            <th class="text-center">User ID</th>
                            <th class="text-center"><a href="javascript:void(0);" onclick="changeUserNameOrder(2);">Login</a></th>

                            <th class="text-center">Financial Year</th>
                            <th class="text-center">Profit&nbsp;and&nbsp;loss</th>
                            <th class="text-center">Balance&nbsp;sheet</th>
                            <th class="text-center">All&nbsp;Transactions</th>
                            <th class="text-center">Supplier&nbsp;List</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($year) && !empty($year))
                            @foreach($year as $finYearRange => $numusers)
                                @foreach($numusers as $keys => $numuser)
                                    @if($numuser['user_acl_profession_id'] == '10')
                                        <tr style="background-color: white !important;">
                                            <td class="text-center">{{ $numuser['user_id'] }}</td>
                                            <td class="text-center">{{ $numuser['login'] }}</td>
                                            <td class="text-center">
                                                {{ $numuser['start_month'] }} - {{ $numuser['end_month'] }} ({{ $finYearRange }})
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $yearParts = explode('-', $finYearRange);
                                                    $startYear = isset($yearParts[0]) ? (int)$yearParts[0] : date('Y');
                                                @endphp
                                                <a href="{{ route('finance.profit.loss', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.balancesheet', ['id' => $numuser['user_id'], 'year' => $startYear]) }}" class="btn btn-xs btn-info">&nbsp; View &nbsp;</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.alltransactions', ['id' => $numuser['user_id'], 'year' => $numuser['fin_year'] ?? $finYearRange]) }}" class="btn btn-xs btn-info">All Transactions</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('finance.supplierlist', ['id' => $numuser['user_id']]) }}" class="btn btn-xs btn-info">Supplier List</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-muted">No records found.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="pagination">
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
                    <p class="clearfix">
                    </p>
                    <ul class="paginator-div">
                    </ul>
                    <p></p>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $("#All-content").on("click", function(e) {
                        e.preventDefault();

                        $("#All-click").addClass("active d-block").remove('d-none');
                        $("#Dispensing_Optician").addClass("d-none").removeClass("d-block active");
                        $("#Audiologists").addClass("d-none").removeClass("d-block active");
                        $("#Domiciliary_Opticians").addClass("d-none").removeClass("d-block", "active");
                        $("#Pharmacy").addClass("d-none").removeClass("d-block active");
                        $("#Dentistry").addClass("d-none").removeClass("d-block active");
                        $("#Optometry").addClass("d-none").removeClass("d-block active");
                    });
                    $("#Dispensing_Optician-content").on("click", function(e) {
                        e.preventDefault();

                        $("#Dispensing_Optician").addClass("active d-block").removeClass("d-none");
                        $("#Domiciliary_Opticians").removeClass("d-block active").addClass("d-none");
                        $("#All-click").removeClass("d-block active").addClass("d-none");
                        $("#Audiologists").removeClass("d-block active").addClass("d-none");
                        $("#Optometry").removeClass("d-block active").addClass("d-none");
                        $("#Dentistry").removeClass("d-block active").addClass("d-none");
                        $("#Pharmacy").removeClass("d-block active").addClass("d-none");
                    });
                    $("#Domiciliary_Opticians-content").on("click", function(e) {
                        e.preventDefault();

                        $("#Domiciliary_Opticians").addClass("d-block active").removeClass("d-none");
                        $("#Dispensing_Optician").addClass("active d-block").removeClass("d-none");
                        $("#All-click").removeClass("d-block active").addClass("d-none");
                        $("#Audiologists").removeClass("d-block active").addClass("d-none");
                        $("#Optometry").removeClass("d-block active").addClass("d-none");
                        $("#Dentistry").removeClass("d-block active").addClass("d-none");
                        $("#Pharmacy").removeClass("d-block active").addClass("d-none");                        
                    });
                    $("#Pharmacy-content").on("click", function(e) {
                        e.preventDefault();

                        $("#Pharmacy").addClass("d-block", "active").removeClass("d-none");
                        $("#Dispensing_Optician", "#All-click", "#Audiologists", "#Optometry", "#Dentistry", "#Domiciliary_Opticians").removeClass("d-block active").addClass("d-none");
                    });
                    $("#Dentistry-content").on("click", function(e) {
                        e.preventDefault();

                        $("#Dentistry").addClass("d-block active").removeClass("d-none");
                        $("#Dispensing_Optician, #All-click, #Audiologists, #Optometry, #Pharmacy, #Domiciliary_Opticians").removeClass("d-block active").addClass("d-none");
                    });
                    $("#Optometry-content").on("click", function(e) {
                        e.preventDefault();

                        $("#Optometry").addClass("d-block active").removeClass("d-none");
                        $("#Dispensing_Optician").removeClass("active d-block").addClass("d-none");
                        $("#Domiciliary_Opticians").removeClass("d-block active").addClass("d-none");
                        $("#All-click").removeClass("d-block active").addClass("d-none");
                        $("#Audiologists").removeClass("d-block active").addClass("d-none");
                        $("#Dentistry").removeClass("d-block active").addClass("d-none");
                        $("#Pharmacy").removeClass("d-block active").addClass("d-none"); 
                    });
                    $("#Audiologists-content").on("click", function(e) {
                        e.preventDefault();

                        $("#Audiologists").addClass("d-block active").removeClass("d-none");
                        $("#Dispensing_Optician").removeClass("active d-block").addClass("d-none");
                        $("#Domiciliary_Opticians").removeClass("d-block active").addClass("d-none");
                        $("#All-click").removeClass("d-block active").addClass("d-none");
                        $("#Optometry").removeClass("d-block active").addClass("d-none");
                        $("#Dentistry").removeClass("d-block active").addClass("d-none");
                        $("#Pharmacy").removeClass("d-block active").addClass("d-none"); 
                    });
                });
            </script>

            <script type="text/javascript">
                Gc.initTableList();

                function changeUserNameOrder(order) {
                    $.ajax({
                        'url': '/admin/config/user',
                        'type': 'POST',
                        'data': {
                            'setUserNameOrder': order
                        },
                        'success': function(result) {
                            location.reload();
                        }
                    });
                }

                function changeUserFNameOrder(order) {
                    $.ajax({
                        'url': '/admin/config/user',
                        'type': 'POST',
                        'data': {
                            'setUserFNameOrder': order
                        },
                        'success': function(result) {
                            location.reload();
                        }
                    });
                }

                function changeUserLNameOrder(order) {
                    $.ajax({
                        'url': '/admin/config/user',
                        'type': 'POST',
                        'data': {
                            'setUserLNameOrder': order
                        },
                        'success': function(result) {
                            location.reload();
                        }
                    });
                }

                function changeUserEmailOrder(order) {
                    $.ajax({
                        'url': '/admin/config/user',
                        'type': 'POST',
                        'data': {
                            'setUserEmailOrder': order
                        },
                        'success': function(result) {
                            location.reload();
                        }
                    });
                }
            </script>
                                <script>
    // Auto-dismiss flash messages after 5 seconds
    setTimeout(function() {
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function(msg) {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.remove(), 500); // remove from DOM after fade
        });
    }, 5000); // 5 seconds
</script>
            <style>
                div#fre-tab,
                div#emp-tab,
                .financead {
                    float: left;
                    width: 100%;
                }

                .financead {}

                .financead .form-group,
                .financead .input-group {
                    width: 100%;
                }

                .financead label {
                    float: right;
                    font-size: 12px;
                    font-weight: bold;
                    letter-spacing: 1px;
                    padding: 8px 10px;
                }

                .financead select {
                    width: 150px !important;
                }
            </style>
        </div>

    </div>
</div>
@endsection