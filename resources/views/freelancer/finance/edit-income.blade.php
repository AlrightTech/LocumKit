@extends('layouts.user_profile_app')

@section('content')
    <section id="breadcrum" class="breadcrum">
        <div class="breadcrum-sitemap">
            <div class="container">
                <div class="row">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/freelancer/dashboard">My Dashboard</a></li>
                        <li><a href="/freelancer/finance-detail">Finance</a></li>
                        <li><a href="#">New Income</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="breadcrum-title">
            <div class="container">
                <div class="row">
                    <div class="set-icon registration-icon">
                        <i class="glyphicon glyphicon-edit" aria-hidden="true"></i>
                    </div>
                    <div class="set-title">
                        <h3>Update income</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="primary-content" class="main-content register">
        <div class="container">
            <div class="row">
                <div class="white-bg contents">
                    <section class="add_item pb30 text-left">
                        <div class="col-md-12 pad0">
                            <div class="finance-page-head text-center">Update income</div>
                        </div>
                        <div class="col-md-12 pad0"></div>
                        <div class="col-md-12 pad0">
                            <form role="form" id='income_form' action="{{ route('freelancer.edit-income-update', $income->id) }}" method="post" class="add_item_form form-inline">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Job Type </label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <select name="in_job_type" id="in_job_type" class="form-control" required>
                                                <option value="">Please select job type</option>
                                                <option @if ($income->job_type == '1') selected @endif value="1">Website</option>
                                                <option @if ($income->job_type == '2') selected @endif value="2">Private</option>
                                                <option @if ($income->job_type == '3') selected @endif value="3">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Job No.</label></div>
                                        <div class="col-md-7"><input type="number" class="form-control" name="in_jobno" id="in_jobno" value="{{ $income->job_id }}" placeholder="Please enter job no."></div>
                                    </div>
                                    <div id="error_div" class="has-error"></div>
                                </div>
                                <div class="col-md-12 no_field">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Date </label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>

                                        <div class="col-md-7">
                                            <div class="input-group date form_date">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                <input class="form-control" type="text" id="in_date" value="{{ $income->job_date }}" name="in_date" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 no_field">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Income</label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">£</span>
                                                <input name="in_rate" id="in_rate" type="text" value="{{ $income->job_rate }}" class="form-control" required placeholder="Please enter amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Store</label></div>
                                        <div class="col-md-7"> <input type="text" class="form-control" name="in_store" value="{{ $income->store }}" id="in_store" placeholder="Please enter store name"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Category </label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7"><select name="in_category" id="in_category" class="form-control" required>
                                                <option value="">Please select category</option>
                                                <option @if ($income->income_type == '1') selected @endif value="1">Income</option>
                                                <option @if ($income->income_type == '2') selected @endif value="2">Bonus</option>
                                                <option @if ($income->income_type == '3') selected @endif value="3">Other</option>
                                            </select></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Location</label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7"><input type="text" class="form-control" value="{{ $income->location }}" name="in_location" id="in_location" placeholder="Please enter location of booking"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Supplier</label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i> </div>
                                        <div class="col-md-7"> <input type="text" class="form-control" value="{{ $income->supplier }}" name="in_supplier" id="in_supplier" placeholder="Please enter employer/supplier name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-7">
                                            <div class="checkbox">
                                                <label><input name="in_bank" id="in_bank" value='1' type="checkbox" @if ($income->is_bank_transaction_completed) checked @endif>Please click if income is already banked.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 new_bank_date no_field" @if (!$income->is_bank_transaction_completed) style="display:none" @endif id="bank_date">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Bank Date </label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <div class="input-group date form_date">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                <input class="form-control" type="text" id="in_bankdate" @if ($income->is_bank_transaction_completed) value="{{ $income->bank_transaction_date }}" @endif name="in_bankdate" placeholder="Bank Date" autocomplete="off">
                                            </div>
                                            <span class="field-error" id="in_bankdate_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_bankdate')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <button type="submit" id="income_submit" name="income_submit" value="income_submit" class="read-common-btn grad_btn">Update</button>
                                        <button type="button" id="income_submit_loding" class="read-common-btn grad_bt" style="display: none" disabled>Loading...</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Validate form before submission
        function validateEditIncomeForm() {
            var isValid = true;
            
            // Clear all previous error messages
            $('.field-error').hide().text('');
            
            // Validate Bank Date (if bank checkbox is checked)
            if ($("#in_bank").is(':checked')) {
                var bankDate = $("#in_bankdate").val();
                var jobDate = $("#in_date").val();
                
                if (!bankDate || bankDate.trim() === '') {
                    $("#in_bankdate_error").text('Please select a bank date').show();
                    isValid = false;
                } else {
                    var bankDateObj = parseDate(bankDate);
                    var jobDateObj = parseDate(jobDate);
                    var today = new Date();
                    today.setHours(0, 0, 0, 0);
                    
                    // Check if bank date is before job date
                    if (bankDateObj && jobDateObj && bankDateObj < jobDateObj) {
                        $("#in_bankdate_error").text('Bank Date cannot be before the Job Date').show();
                        isValid = false;
                    }
                    
                    // Check if bank date is in the future
                    if (bankDateObj && bankDateObj > today) {
                        $("#in_bankdate_error").text('Bank Date cannot be in the future').show();
                        isValid = false;
                    }
                }
            }
            
            return isValid;
        }
        
        $("#income_form").submit(function(e) {
            // Prevent form submission if validation fails
            if (!validateEditIncomeForm()) {
                e.preventDefault();
                // Scroll to first error
                $('html, body').animate({
                    scrollTop: $('.field-error:visible').first().offset().top - 100
                }, 500);
                return false;
            }
            
            $('#income_submit').hide();
            $('#income_submit_loding').show();
        });
        $("#in_jobno").keyup(function() {
            var in_jobno = $("#in_jobno").val();
            if (!isNaN(in_jobno) && in_jobno != '' && in_jobno.toString().indexOf('.') == -1) {} else {
                $("#in_jobno").val('');
            }
        });

        $("#in_rate").keyup(function() {
            var in_rate = $("#in_rate").val();
            if (isNaN(in_rate)) {
                $("#in_rate").val('');
            }

        });


        $("#in_bank").click(function() {
            var job_type = $('#in_bank:checked').val();
            if (job_type == '1') {
                $("input#in_bankdate").prop('required', true);
                $('#bank_date').show(1000);
            } else {
                $('#bank_date').hide(1000);
                $('#in_bankdate').val('');
                $("input#in_bankdate").prop('required', false);
                $("#in_bankdate_error").hide();
            }
        });
        
        // Helper function to parse date from dd/mm/yy format
        function parseDate(dateString) {
            if (!dateString) return null;
            
            // Try to parse dd/mm/yy format
            var parts = dateString.split('/');
            if (parts.length === 3) {
                var day = parseInt(parts[0], 10);
                var month = parseInt(parts[1], 10) - 1; // Month is 0-indexed
                var year = parseInt(parts[2], 10);
                
                // Handle 2-digit year
                if (year < 100) {
                    year += 2000;
                }
                
                return new Date(year, month, day);
            }
            
            // Try to parse YYYY-MM-DD format
            var isoParts = dateString.split('-');
            if (isoParts.length === 3) {
                return new Date(isoParts[0], parseInt(isoParts[1], 10) - 1, isoParts[2]);
            }
            
            return null;
        }
        
        // Validate bank date in real-time
        $("#in_bankdate").on('change input', function() {
            $("#in_bankdate_error").hide();
            
            // Real-time validation when bank date changes
            if ($("#in_bank").is(':checked')) {
                var bankDate = $("#in_bankdate").val();
                var jobDate = $("#in_date").val();
                
                if (bankDate && jobDate) {
                    var bankDateObj = parseDate(bankDate);
                    var jobDateObj = parseDate(jobDate);
                    var today = new Date();
                    today.setHours(0, 0, 0, 0);
                    
                    // Check if bank date is before job date
                    if (bankDateObj && jobDateObj && bankDateObj < jobDateObj) {
                        $("#in_bankdate_error").text('Bank Date cannot be before the Job Date').show();
                    }
                    // Check if bank date is in the future
                    else if (bankDateObj && bankDateObj > today) {
                        $("#in_bankdate_error").text('Bank Date cannot be in the future').show();
                    }
                }
            }
        });
        
        // Also validate when job date changes
        $("#in_date").on('change input', function() {
            // Re-validate bank date if it exists
            if ($("#in_bank").is(':checked') && $("#in_bankdate").val()) {
                var bankDate = $("#in_bankdate").val();
                var jobDate = $("#in_date").val();
                
                if (bankDate && jobDate) {
                    var bankDateObj = parseDate(bankDate);
                    var jobDateObj = parseDate(jobDate);
                    
                    if (bankDateObj && jobDateObj && bankDateObj < jobDateObj) {
                        $("#in_bankdate_error").text('Bank Date cannot be before the Job Date').show();
                    } else {
                        $("#in_bankdate_error").hide();
                    }
                }
            }
        });

        // Detect if we're in edit mode (form action contains 'edit-income-update')
        var isEditMode = $('#income_form').attr('action').indexOf('edit-income-update') !== -1;
        
        // Store original form values on page load (for edit mode)
        var originalFormValues = {};
        if (isEditMode) {
            originalFormValues = {
                rate: $("#in_rate").val(),
                store: $("#in_store").val(),
                location: $("#in_location").val(),
                supplier: $("#in_supplier").val(),
                date: $("#in_date").val(),
                category: $("#in_category").val(),
                emp_id: $("#in_emp_id").val() || ''
            };
        }

        // Store initial values to detect if user actually changed them
        var initialJobNo = $("#in_jobno").val();
        var initialJobType = $("#in_job_type").val();

        $("#in_jobno").blur(function() {
            // Only fetch if user actually changed the job number from initial value
            var currentJobNo = $("#in_jobno").val();
            if (currentJobNo != '' && currentJobNo != initialJobNo) {
                get_incomedata();
            }
        });

        $("#in_job_type").change(function() {
            // Only fetch if user actually changed the job type from initial value
            var currentJobType = $("#in_job_type").val();
            if (currentJobType != '' && currentJobType != initialJobType) {
                get_incomedata();
            }
        });

        function get_incomedata() {
            var jobno = $("#in_jobno").val();
            var jobtype = $("#in_job_type").val();
            if (jobno != '' && jobtype != '') {
                // Store current values before AJAX call
                var currentValues = {
                    rate: $("#in_rate").val(),
                    store: $("#in_store").val(),
                    location: $("#in_location").val(),
                    supplier: $("#in_supplier").val(),
                    date: $("#in_date").val(),
                    category: $("#in_category").val(),
                    emp_id: $("#in_emp_id").val() || ''
                };

                $.ajax({
                    url: '/ajax/get-job-info',
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                    },
                    data: {
                        'job_no': jobno,
                        'job_type': jobtype,
                    },
                    success: function(result) {
                        if (result && typeof result === "object" && Object.keys(result).length > 0) {
                            // Valid data returned - update fields
                            var r_data = result;
                            $("#in_rate").val(r_data['rate']);
                            $("#in_store").val(r_data['store_nm']);
                            $("#in_location").val(r_data['location']);
                            $("#in_supplier").val(r_data['supplier']);
                            $("#in_date").val(r_data['job_date']);
                            $("#in_emp_id").val(r_data['emp_id']);
                            $("#in_category").val('1');
                            $("#error_div").html('');
                        } else {
                            // No data returned from AJAX
                            if (isEditMode) {
                                // In edit mode: preserve existing values, don't clear them
                                // Only restore if fields were actually changed by user interaction
                                // Otherwise, keep current values
                                $("#in_rate").val(currentValues.rate);
                                $("#in_store").val(currentValues.store);
                                $("#in_location").val(currentValues.location);
                                $("#in_supplier").val(currentValues.supplier);
                                $("#in_date").val(currentValues.date);
                                $("#in_category").val(currentValues.category);
                                $("#in_emp_id").val(currentValues.emp_id);
                            } else {
                                // In create mode: clear fields if no data found
                                $("#in_rate").val('');
                                $("#in_store").val('');
                                $("#in_location").val('');
                                $("#in_supplier").val('');
                                $("#in_category").val('');
                                $("#in_emp_id").val('');
                                $("#in_date").val('');
                            }
                            $("#error_div").html('');
                        }
                    },
                    error: function() {
                        // AJAX error - preserve existing values, especially in edit mode
                        if (isEditMode) {
                            $("#in_rate").val(currentValues.rate);
                            $("#in_store").val(currentValues.store);
                            $("#in_location").val(currentValues.location);
                            $("#in_supplier").val(currentValues.supplier);
                            $("#in_date").val(currentValues.date);
                            $("#in_category").val(currentValues.category);
                            $("#in_emp_id").val(currentValues.emp_id);
                        }
                        $("#error_div").html('');
                    }
                });
            }
        }
    </script>

    <script type="text/javascript">
        $("#income_form").submit(function() {
            $("#income_submit , #income_update").button('loading');
        });


        $(document).ready(function() {
            $('input#in_bankdate').datepicker({
                maxDate: '0',
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                yearRange: '-100:+0'
            });
        });
        $(document).ready(function() {
            $('input#in_date').datepicker({
                maxDate: '0',
                //minDate: '14/08/2022',
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                yearRange: '-100:+0'
            });
        });


        $('input#in_date ,input#in_bankdate').keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            $goc = $(this);

            // Auto-format- do not expose the mask as the user begins to type
            if (key !== 8 && key !== 9) {
                if ($goc.val().length === 2) {
                    $goc.val($goc.val() + '/');
                }
                if ($goc.val().length === 5) {
                    $goc.val($goc.val() + '/');
                }
            }

            // Allow numeric (and tab, backspace, delete) keys only
            return (key == 8 ||
                key == 9 ||
                key == 46 ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        })
    </script>
@endpush
