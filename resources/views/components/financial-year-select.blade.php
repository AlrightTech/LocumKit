@php
    // Use available_years if provided, otherwise fallback to old logic
    if (!isset($available_years) || empty($available_years)) {
        // Fallback: Generate years from user creation to current
        $creation_month = Auth::user()->created_at->month;
        $register_year = Auth::user()->created_at->year;
        $currentFinanaceYear = date('Y');
        
        // Adjust register year based on financial year start month
        if ($creation_month < $finance_year_start_month) {
            $register_year = $register_year - 1;
        }
        
        // Generate all years from registration to current (no 3-year limit)
        $available_years = [];
        for ($i = $register_year; $i <= $currentFinanaceYear; $i++) {
            $available_years[] = $i;
        }
        
        // If still empty, at least add current year
        if (empty($available_years)) {
            $available_years[] = get_financial_current_year($finance_year_start_month);
        }
    }
@endphp
<div class="col-md-12 pad0 select-year-wrapper">
    <div class="financial-year-title col-sm-7 col-md-7 bglightgrey">
        <h4 class="text-right">Financial Year ({{ date('M', mktime(0, 0, 0, $finance_year_start_month, 1)) }}-{{ date('M', mktime(0, 0, 0, $finance_year_start_month + 11, 1)) }} ) : </h4>
    </div>
    <div class="financial-year-select col-sm-5 col-md-5 bglightgrey">
        <div class="form-group">
            <select name="year" class="filter-selection" id="finance-year" onchange="this.form.submit()">
                @foreach ($available_years as $year)
                    @php
                        // Calculate the financial year range display (e.g., 2024-2025)
                        $display_start_year = $year;
                        $display_end_year = $year + 1;
                    @endphp
                    <option value="{{ $year }}" @selected($filter_year == $year)> {{ $display_start_year }}-{{ $display_end_year }} </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
