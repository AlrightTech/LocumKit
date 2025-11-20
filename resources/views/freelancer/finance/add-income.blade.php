@extends('layouts.user_profile_app')

@section('content')
    <section id="breadcrum" class="breadcrum">
        <div class="breadcrum-sitemap">
            <div class="container">
                <div class="row">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/freelancer/dashboard">My Dashboard</a></li>
                        <li><a href="/freelancer/finance">Finance</a></li>
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
                        <h3>New income</h3>
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
                            <div class="finance-page-head text-center">New income</div>
                        </div>
                        <div class="col-md-12 pad0"></div>
                        <div class="col-md-12 pad0">
                            <form role="form" id='income_form' action="{{ route('freelancer.add-income-save') }}" method="post" class="add_item_form form-inline">
                                @csrf
                                <div class="col-md-12">
                                    <input type="hidden" name="in_emp_id" id="in_emp_id" value="{{ old('in_emp_id') }}" />
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="exampleInputPassword1">Job Type </label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-md-7">
                                            <select name="in_job_type" id="in_job_type" class="form-control" required>
                                                <option value="">Please select job type</option>
                                                <option value="1" {{ old('in_job_type') == '1' ? 'selected' : '' }}>Website</option>
                                                <option value="2" {{ old('in_job_type') == '2' ? 'selected' : '' }}>Private</option>
                                                <option value="3" {{ old('in_job_type') == '3' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            <span class="field-error" id="in_job_type_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_job_type')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Job No.</label></div>
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" name="in_jobno" id="in_jobno" placeholder="Please enter job no." value="{{ old('in_jobno') }}">
                                        </div>
                                    </div>
                                    <div id="error_div" class="has-error"></div>
                                </div>
                                <div class="col-md-12 no_field">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label for="in_date">Date </label>
                                            <i class="fa fa-asterisk required-stars" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="input-group date form_date">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                <input class="form-control" type="text" id="in_date" name="in_date" value="{{ old('in_date') }}" required autocomplete="off">
                                            </div>
                                            <span class="field-error" id="in_date_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_date')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 no_field">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Income</label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-addon">£</span>
                                                <input name="in_rate" id="in_rate" type="number" min="1" class="form-control" oninput="checkValue(this)" required placeholder="Please enter amount" value="{{ old('in_rate') }}">
                                            </div>
                                            <span id="rateValidationError" style="color: red;"></span>
                                            <span class="field-error" id="in_rate_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_rate')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Store</label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="in_store" id="in_store" placeholder="Please enter store name" maxlength="255" value="{{ old('in_store') }}">
                                            <span class="field-error" id="in_store_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_store')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Category </label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <select name="in_category" id="in_category" class="form-control" required>
                                                <option value="">Please select category</option>
                                                <option value="1" {{ old('in_category') == '1' ? 'selected' : '' }}>Income</option>
                                                <option value="2" {{ old('in_category') == '2' ? 'selected' : '' }}>Bonus</option>
                                                <option value="3" {{ old('in_category') == '3' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            <span class="field-error" id="in_category_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_category')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Location</label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="in_location" id="in_location" placeholder="Please enter location of booking" value="{{ old('in_location') }}">
                                            <span class="field-error" id="in_location_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_location')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Supplier</label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i> </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="in_supplier" id="in_supplier" placeholder="Please enter employer/supplier name" required value="{{ old('in_supplier') }}">
                                            <span class="field-error" id="in_supplier_error" style="color: red; font-size: 12px; display: none;"></span>
                                            @error('in_supplier')
                                                <span class="field-error" style="color: red; font-size: 12px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-7">
                                            <div class="checkbox">
                                                <label>
                                                    <input name="in_bank" id="in_bank" value='1' type="checkbox" {{ old('in_bank') ? 'checked' : '' }}>Please click if income is already banked.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 new_bank_date no_field" style="display:none" id="bank_date">
                                    <div class="form-group">
                                        <div class="col-md-4"><label for="exampleInputPassword1">Bank Date </label><i class="fa fa-asterisk required-stars" aria-hidden="true"></i></div>
                                        <div class="col-md-7">
                                            <div class="input-group date form_date">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                <input class="form-control" type="text" id="in_bankdate" name="in_bankdate" placeholder="Bank Date" autocomplete="off" value="{{ old('in_bankdate') }}">
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
                                        <button type="submit" id="income_submit" name="income_submit" value="income_submit" class="read-common-btn grad_btn">Submit</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        // Client-side validation function
        function validateIncomeForm() {
            var isValid = true;
            var errors = {};

            // Clear all previous error messages
            $('.field-error').hide().text('');

            // Validate Job Type
            var jobType = $("#in_job_type").val();
            if (!jobType || jobType === '') {
                $("#in_job_type_error").text('Please choose an income type').show();
                isValid = false;
            }

            // Validate Date
            var date = $("#in_date").val();
            if (!date || date.trim() === '') {
                $("#in_date_error").text('Please select a date').show();
                isValid = false;
            }

            // Validate Income
            var rate = $("#in_rate").val();
            if (!rate || rate.trim() === '' || parseFloat(rate) <= 0) {
                $("#in_rate_error").text('Please enter the income amount').show();
                isValid = false;
            }

            // Validate Store
            var store = $("#in_store").val();
            if (!store || store.trim() === '') {
                $("#in_store_error").text('Please enter the store name').show();
                isValid = false;
            } else if (!/^[a-zA-Z\s]+$/.test(store)) {
                $("#in_store_error").text('Store name can only contain letters and spaces').show();
                isValid = false;
            }

            // Validate Category
            var category = $("#in_category").val();
            if (!category || category === '') {
                $("#in_category_error").text('Please select a category').show();
                isValid = false;
            }

            // Validate Location
            var location = $("#in_location").val();
            if (!location || location.trim() === '') {
                $("#in_location_error").text('Please enter the location').show();
                isValid = false;
            }

            // Validate Supplier
            var supplier = $("#in_supplier").val();
            if (!supplier || supplier.trim() === '') {
                $("#in_supplier_error").text('Please enter the supplier name').show();
                isValid = false;
            } else if (!/^[a-zA-Z\s]+$/.test(supplier)) {
                $("#in_supplier_error").text('Supplier name can only contain letters and spaces').show();
                isValid = false;
            }

            // Validate Bank Date (if bank checkbox is checked)
            if ($("#in_bank").is(':checked')) {
                var bankDate = $("#in_bankdate").val();
                var jobDate = $("#in_date").val();
                
                if (!bankDate || bankDate.trim() === '') {
                    $("#in_bankdate_error").text('Please select a bank date').show();
                    isValid = false;
                } else {
                    // Parse dates (assuming format dd/mm/yy from datepicker)
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

            return isValid;
        }

        $("#income_form").submit(function(e) {
            // Prevent form submission if validation fails
            if (!validateIncomeForm()) {
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

        $("#in_rate").on("input", function() {
            var in_rate = $("#in_rate").val();

            // Remove non-numeric characters except for the decimal point
            in_rate = in_rate.replace(/[^0-9.]/g, '');

            // Ensure the value is not negative
            if (parseFloat(in_rate) < 0) {
                in_rate = 0; // Set to 0 if negative
                $("#rateValidationError").text("Income cannot be negative.");
            }
            // Ensure the value doesn't exceed the limit (less than 1 ten million)
            else if (isNaN(in_rate) || parseFloat(in_rate) >= 10000000) {
                $("#rateValidationError").text("Exceeded the limit (less than 1 ten million)");
            } else {
                $("#rateValidationError").text(''); // Clear any error message
            }
            if (in_rate !== '') {
                in_rate = parseFloat(in_rate).toString();
            }
            // Update the input field with the modified value
            $("#in_rate").val(in_rate);
        });


        // Clear error messages when user starts typing/selecting
        $("#in_job_type").on('change', function() {
            $("#in_job_type_error").hide();
        });
        $("#in_date").on('change input', function() {
            $("#in_date_error").hide();
        });
        $("#in_rate").on('input', function() {
            $("#in_rate_error").hide();
        });
        $("#in_store").on('input', function() {
            $("#in_store_error").hide();
        });
        $("#in_category").on('change', function() {
            $("#in_category_error").hide();
        });
        $("#in_location").on('input', function() {
            $("#in_location_error").hide();
        });
        $("#in_supplier").on('input', function() {
            $("#in_supplier_error").hide();
        });
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
            $("#in_date_error").hide();
            
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

        $("#in_jobno").blur(function() {
            get_incomedata();
        });

        $("#in_job_type").change(function() {
            get_incomedata();
        });

        function get_incomedata() {
            var jobno = $("#in_jobno").val();
            var jobtype = $("#in_job_type").val();
            if (jobno != '' && jobtype != '') {
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
                            $("#in_rate").val('');
                            $("#in_store").val('');
                            $("#in_location").val('');
                            $("#in_supplier").val('');
                            $("#in_category").val('');
                            $("#in_emp_id").val('');
                            $("#in_date").val('');
                            $("#error_div").html('');
                        }
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
            $('input[name="in_date"]').datepicker({
                maxDate: '0',
                //minDate: '14/08/2022',
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                yearRange: '-100:+0'
            });
        });
        $(document).ready(function() {
            $('input[name="in_bankdate"]').datepicker({
                maxDate: '0',
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                yearRange: '-100:+0'
            });
        });


        $('input[name="in_date"], input[name="in_bankdate"]').keydown(function(e) {
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
    <script>
        function checkValue(input) {
            if (input.value > 100000) {
                input.value = 99999;
            }
        }
    </script>
     <script>
        function checkValue(input) {
            // Check if the value is negative
            if (input.value < 0) {
                input.value = 0; // Set the value to 0 if it's negative
                document.getElementById("rateValidationError").innerText = "Income cannot be negative.";
            } else if (input.value === "") {
                document.getElementById("rateValidationError").innerText = "Income is required.";
            } else {
                document.getElementById("rateValidationError").innerText = ""; // Clear the error message if valid
            }
        }
    </script>
@endpush
