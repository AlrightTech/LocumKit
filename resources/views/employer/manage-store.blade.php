@extends('layouts.user_profile_app')

@push('styles')
    <style type="text/css">
        ul.ui-autocomplete.ui-front.ui-menu.ui-widget.ui-widget-content {
            max-width: 300px !important;
        }
        
        /* Postcode validation styling */
        input[name^="emp_store_zip_"].is-invalid,
        input[name^="store_zip_"].is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .postcode-error {
            display: block;
            color: #dc3545 !important;
            font-size: 12px;
            margin-top: 5px;
        }
        
        input[name^="emp_store_zip_"]:focus,
        input[name^="store_zip_"]:focus {
            border-color: #66afe9 !important;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
        }
        
        /* Add Store Form State Management */
        #addstore {
            transition: all 0.3s ease;
        }
        
        #add_store_edit {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        #add_store_edit:hover {
            opacity: 0.8;
        }
        
        #close-add-store-form {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        #close-add-store-form:hover {
            background-color: #f0f0f0;
        }
        
        #addstore {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #f9f9f9;
        }
    </style>
@endpush

@section('content')
    <section id="breadcrum" class="breadcrum">
        <div class="breadcrum-sitemap">
            <div class="container">
                <div class="row">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/employer/dashboard">Dashboard</a></li>
                        <li><a href="#">Manage Store</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="breadcrum-title">
            <div class="container">
                <div class="row">
                    <div class="set-icon registration-icon">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </div>
                    <div class="set-title">
                        <h3>Manage Store</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="primary-content" class="main-content register manage-store-wrapper">
        <div class="container">
            <div class="row">
                <div class="white-bg contents">
                    <section>
                        <div class="col-md-12"></div>

                        <div class="col-md-12 manage-store">
                            <form id="mamagestore" action="/employer/manage-store" method="post">
                                @method('PUT')
                                @csrf
                                <div class="user-store-list heading-list">
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <p>Store name</p>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-4">
                                        <p>Store address</p>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <p>Store location</p>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-2">
                                        <p>Post code</p>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1">
                                        <p style="text-align:center">Action</p>
                                    </div>
                                </div>
                                <div class="user-store-list">
                                    @foreach ($stores as $store)
                                        <div class="col-xs-3 col-sm-3 col-md-3 no-padding-right"><input type="text" class="width-100 input-text margin-bottom" name="store_name_{{ $store->id }}" value="{{ $store->store_name }}" minlength="3" maxlength="40" required>
                                        </div>
                                        <div class="col-xs-3 col-sm-3 col-md-4 no-padding-right"><input type="text" class="width-100 input-text margin-bottom" name="store_address_{{ $store->id }}" value="{{ $store->store_address }}"
                                                   required></div>
                                        <div class="col-xs-3 col-sm-3 col-md-2 no-padding-right"><input type="text" class="width-100 input-text margin-bottom city" name="store_region_{{ $store->id }}" value="{{ $store->store_region }}"
                                                   required></div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 no-padding-right">
                                            <input 
                                                type="text" 
                                                class="width-100 input-text margin-bottom @error('store_zip_' . $store->id) is-invalid @enderror" 
                                                name="store_zip_{{ $store->id }}" 
                                                value="{{ old('store_zip_' . $store->id, $store->store_zip) }}" 
                                                required 
                                                pattern="[A-Z]{1,2}[0-9R][0-9A-Z]? [0-9][ABD-HJLNP-UW-Z]{2}"
                                                title="Please enter a valid UK postcode (e.g., SW1A 1AA, M1 1AA, B33 8TH)"
                                                style="text-transform: uppercase;"
                                                maxlength="8"
                                            >
                                            @error('store_zip_' . $store->id)
                                                <span class="field-error" style="display: block; color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-xs-1 col-sm-1 col-md-1"><span class="deleteclass small2" id="{{ $store->id }}"><i class="fa fa-times" title="Remove" aria-hidden="true"></i></span></div>
                                        <input type="hidden" name="store_ids[]" value="{{ $store->id }}">

                                        <div class="col-md-12 store-timing-div">

                                            <div class="col-md-4">
                                                <p>What are your store Opening time(s)?</p>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="col-md-12">
                                                    <div class="col-xs-3 col-sm-3 col-md-3"></div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3" style="text-align: center;">
                                                        <p>Opening time</p>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3" style="text-align: center;">
                                                        <p>Closing time</p>
                                                    </div>
                                                    <div class="col-xs-3 col-sm-3 col-md-3" style="text-align: center;">
                                                        <p>Lunch break (mins)</p>
                                                    </div>
                                                </div>
                                                @foreach (get_days_list() as $day)
                                                    <div class="col-md-12">
                                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                                            <p>{{ $day }}</p>
                                                        </div>
                                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                                            <select name="job_start_time_{{ $store->id }}[{{ $day }}]" class="input-text width-100" id="start_time_day_{{ $day }}_{{ $store->id }}">
                                                                @for ($i = today()->setTime(0, 0); $i->lessThan(today()->setTime(24, 0)); $i->addMinutes(15))
                                                                    <option value='{{ $i->format('H:i') }}' @selected($store->get_store_start_time($day) == $i->format('H:i'))> {{ $i->format('H:i') }} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 col-sm-3 col-md-3" align="center">
                                                            <select name="job_end_time_{{ $store->id }}[{{ $day }}]" class="input-text width-100" id="end_time_day_{{ $day }}_{{ $store->id }}">
                                                                @for ($i = today()->setTime(0, 0); $i->lessThan(today()->setTime(24, 0)); $i->addMinutes(15))
                                                                    <option value='{{ $i->format('H:i') }}' @selected($store->get_store_end_time($day) == $i->format('H:i'))> {{ $i->format('H:i') }} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-3 col-sm-3 col-md-3">
                                                            <select name="job_lunch_time_{{ $store->id }}[{{ $day }}]" class="input-text width-100" id="lunch_time_day_{{ $day }}_{{ $store->id }}">
                                                                @for ($i = today()->setTime(0, 0); $i->lessThan(today()->setTime(1, 0)); $i->addMinutes(5))
                                                                    <option value='{{ $i->format('i') }}' @selected($store->get_store_lunch_time($day) == $i->format('i'))> {{ $i->format('i') }} </option>
                                                                @endfor
                                                                <option value='60' @selected($store->get_store_lunch_time($day) == '60')> 60 </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                                <div class="user-store-list user-store-btn-list" style="display:flex; justify-content:center;">
                                    <div class="col-sm-6 col-md-2 no-padding-right"><button style="border-radius: 10px !important;" class="save-store-btn">Update</button></div>
                                    <div class="col-sm-6 col-md-2"><a href="javascript:void(0);" style="border-radius: 10px !important;" class="save-store-btn" id="add_store_edit">Add another store</a></div>
                                </div>
                            </form>

                            <form id="addstore" action="/employer/manage-store" method="post" class="margin-top" style="display:none;">
                                @csrf
                                <input type="hidden" name="_submission_token" value="{{ uniqid('store_', true) }}" id="submission-token">
                                <div class="col-md-12 margin-top" style="display: flex; justify-content: space-between; align-items: center;">
                                    <h2 style="margin: 0;">Add store details</h2>
                                    <button type="button" id="close-add-store-form" class="btn btn-sm btn-default" style="border-radius: 5px; padding: 5px 15px;">
                                        <i class="fa fa-times"></i> Close
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <div class="store_block add-new-store-form-wrapp">
                                        <div class="store-details add-new-store-inner-scroll">
                                            @php
                                                $unqiue_value_here = uniqid() . time();
                                            @endphp
                                            <input type="hidden" name="total_emp_stores[]" value="{{ $unqiue_value_here }}">
                                            <div class="width-full" id="show_add_button"><a href="javascript:void(0);" class="color-blue" id="add_emp_store"><i class="fa fa-plus" aria-hidden="true" title="Add Employer store"></i></a>
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-3 no-padding-left"><input type="text" minlength="4" maxlength="30" name="emp_store_name_{{ $unqiue_value_here }}" required placeholder="Enter Store name"
                                                       class="input-text width-100 required-field_0"> </div>
                                            <div class="col-xs-4 col-sm-4 col-md-4 no-padding-left"><input type="text" name="emp_store_address_{{ $unqiue_value_here }}" required placeholder="Enter Store address"
                                                       class="input-text width-100 required-field_0">
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2 no-padding-left"><input type="text" name="emp_store_region_{{ $unqiue_value_here }}" required placeholder="Enter Store Region"
                                                       class="input-text width-100 required-field_0 city"></div>
                                            <div class="col-xs-2 col-sm-2 col-md-2 no-padding-left">
                                                <input 
                                                    type="text" 
                                                    name="emp_store_zip_{{ $unqiue_value_here }}" 
                                                    required 
                                                    placeholder="e.g., SW1A 1AA" 
                                                    pattern="[A-Z]{1,2}[0-9R][0-9A-Z]? [0-9][ABD-HJLNP-UW-Z]{2}"
                                                    title="Please enter a valid UK postcode (e.g., SW1A 1AA, M1 1AA, B33 8TH)"
                                                    class="input-text width-100 required-field_0 @error('emp_store_zip_' . $unqiue_value_here) is-invalid @enderror" 
                                                    style="text-transform: uppercase;"
                                                    maxlength="8"
                                                    value="{{ old('emp_store_zip_' . $unqiue_value_here) }}"
                                                >
                                                @error('emp_store_zip_' . $unqiue_value_here)
                                                    <span class="field-error" style="display: block; color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                                                @enderror
                                                <small style="display: block; color: #6c757d; font-size: 11px; margin-top: 3px;">UK format: SW1A 1AA</small>
                                            </div>
                                            <div class="css_error2 required-field-no_0" style="clear:both;"></div>
                                            <div class="col-md-12 store-timing-div store-opening-tdive-wrapp">
                                                <div class="add-store-scroll-wrapp">
                                                    <div class="col-md-4">
                                                        <p>What are your store Opening time(s)?</p>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="col-md-12">
                                                            <div class="col-xs-3 col-sm-3 col-md-3"></div>
                                                            <div class="col-xs-3 col-sm-3 col-md-3" align="center">
                                                                <p>Opening time</p>
                                                            </div>
                                                            <div class="col-xs-3 col-sm-3 col-md-3" align="center">
                                                                <p>Closing time</p>
                                                            </div>
                                                            <div class="col-xs-3 col-sm-3 col-md-3" align="center">
                                                                <p>Lunch break (mins)</p>
                                                            </div>
                                                        </div>

                                                        @foreach (get_days_list() as $day)
                                                            <div class="col-md-12">
                                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                                    <p>{{ $day }}</p>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                                    <select name="job_start_time_{{ $unqiue_value_here }}[{{ $day }}]" class="input-text width-100" id="start_time_day_{{ $unqiue_value_here }}">
                                                                        @for ($i = today()->setTime(0, 0); $i->lessThan(today()->setTime(24, 0)); $i->addMinutes(15))
                                                                            <option value='{{ $i->format('H:i') }}'> {{ $i->format('H:i') }} </option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3" align="center">
                                                                    <select name="job_end_time_{{ $unqiue_value_here }}[{{ $day }}]" class="input-text width-100" id="end_time_day_{{ $unqiue_value_here }}">
                                                                        @for ($i = today()->setTime(0, 0); $i->lessThan(today()->setTime(24, 0)); $i->addMinutes(15))
                                                                            <option value='{{ $i->format('H:i') }}'> {{ $i->format('H:i') }} </option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-xs-3 col-sm-3 col-md-3">
                                                                    <select name="job_lunch_time_{{ $unqiue_value_here }}[{{ $day }}]" class="input-text width-100" id="lunch_time_day_{{ $unqiue_value_here }}">
                                                                        @for ($i = today()->setTime(0, 0); $i->lessThan(today()->setTime(1, 0)); $i->addMinutes(5))
                                                                            <option value='{{ $i->format('i') }}'> {{ $i->format('i') }} </option>
                                                                        @endfor
                                                                        <option value='60'> 60 </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-4 col-md-2 no-padding-left">
                                        <button type="submit" style="border-radius: 10px !important;" class="save-store-btn" name="add_store" id="save-store-btn">
                                            <span class="btn-text">Save Store</span>
                                            <span class="btn-loading" style="display: none;">
                                                <i class="fa fa-spinner fa-spin"></i> Saving...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>

        <div id="alert-confirm-modal" class="alert-modal modal fade">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">LocumKit</h4>
                    </div>
                    <div class="modal-body">
                        <h3 id="alert-message"></h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="confirm">Yes</button>
                        <button type="button" class="close-alert btn btn-default">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // State management for Add Store form
        let addStoreFormState = {
            isOpen: false,
            isAnimating: false
        };
        
        // Function to open the add store form
        function openAddStoreForm() {
            // Prevent if already open or animating
            if (addStoreFormState.isOpen || addStoreFormState.isAnimating) {
                return false;
            }
            
            addStoreFormState.isAnimating = true;
            $('#addstore').slideDown(300, function() {
                addStoreFormState.isOpen = true;
                addStoreFormState.isAnimating = false;
                // Update button text/state
                $('#add_store_edit').html('<i class="fa fa-minus"></i> Hide form');
                // Scroll to form for better UX
                $('html, body').animate({
                    scrollTop: $('#addstore').offset().top - 20
                }, 300);
            });
            return true;
        }
        
        // Function to close the add store form
        function closeAddStoreForm() {
            // Prevent if already closed or animating
            if (!addStoreFormState.isOpen || addStoreFormState.isAnimating) {
                return;
            }
            
            addStoreFormState.isAnimating = true;
            $('#addstore').slideUp(300, function() {
                addStoreFormState.isOpen = false;
                addStoreFormState.isAnimating = false;
                // Reset form fields
                resetAddStoreForm();
                // Update button text/state
                $('#add_store_edit').html('Add another store');
            });
        }
        
        // Function to reset the add store form
        function resetAddStoreForm() {
            const $form = $('#addstore');
            
            // Reset all input fields
            $form.find('input[type="text"]').val('');
            $form.find('select').each(function() {
                $(this).prop('selectedIndex', 0);
            });
            
            // Remove any dynamically added store blocks (keep only the first one)
            $form.find('.store_block .store-details').not(':first').remove();
            
            // Reset error states
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('.field-error, .postcode-error').remove();
            
            // Reset submission state
            $('#save-store-btn').data('submitting', false);
            $('#save-store-btn').prop('disabled', false);
            $('#save-store-btn').find('.btn-text').show();
            $('#save-store-btn').find('.btn-loading').hide();
        }
        
        // Handle "Add another store" button click
        $("#add_store_edit").click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Prevent rapid clicking
            if (addStoreFormState.isAnimating) {
                return false;
            }
            
            if (addStoreFormState.isOpen) {
                // Form is open, close it
                closeAddStoreForm();
            } else {
                // Form is closed, open it (only if not already open)
                openAddStoreForm();
            }
            
            return false;
        });
        
        // Handle "Close" button click
        $("#close-add-store-form").click(function(e) {
            e.preventDefault();
            closeAddStoreForm();
        });
        
        // Initialize form state on page load
        $(document).ready(function() {
            // Check if form should be open (e.g., if there are validation errors)
            const hasErrors = $('#addstore').find('.field-error, .is-invalid').length > 0;
            let hasOldInput = false;
            
            // Check if any input field has a value
            $('#addstore').find('input[type="text"]').each(function() {
                if ($(this).val() && $(this).val().trim() !== '') {
                    hasOldInput = true;
                    return false; // break loop
                }
            });
            
            if (hasErrors || hasOldInput) {
                // Form has errors or old input, keep it open
                addStoreFormState.isOpen = true;
                $('#addstore').show();
                $('#add_store_edit').html('<i class="fa fa-minus"></i> Hide form');
            } else {
                // Form should be closed
                addStoreFormState.isOpen = false;
                $('#addstore').hide();
                $('#add_store_edit').html('Add another store');
            }
        });
        
        // Close form on successful submission (after redirect)
        // This will be handled by page reload, but we can also listen for form submission
        $('#addstore').on('submit', function() {
            // Form is submitting, will reload page on success
            // State will reset on page load
        });

        var i = $(".store-details").size() + 1;
        var m = 0;
        $("#add_emp_store").click(function() {
            if (i > 1) {
                $.ajax({
                    'url': '/ajax/mutli-store-time',
                    'type': 'POST',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                    },
                    success: function(result) {
                        $('.store_block').append(
                            `
                            <div class="store-details add-new-store-inner-scroll">
                                <div class="col-xs-3 col-sm-3 col-md-3 no-padding-left">
                                    <input type="text" name="emp_store_name_${result.key}" required placeholder="Enter Store name" class="input-text width-100 required-field_${m}">
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 no-padding-left">
                                    <input type="text" name="emp_store_address_${result.key}" required placeholder="Enter Store address" class="input-text width-100 required-field_${m}">
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 no-padding-left">
                                    <input type="text" name="emp_store_region_${result.key}" required placeholder="Enter Store Region" class="input-text width-100 required-field_${m} city">
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-2 no-padding-left">
                                    <input 
                                        type="text" 
                                        name="emp_store_zip_${result.key}" 
                                        required 
                                        placeholder="e.g., SW1A 1AA" 
                                        pattern="[A-Z]{1,2}[0-9R][0-9A-Z]? [0-9][ABD-HJLNP-UW-Z]{2}"
                                        title="Please enter a valid UK postcode (e.g., SW1A 1AA, M1 1AA, B33 8TH)"
                                        class="input-text width-100 required-field_${m}" 
                                        style="text-transform: uppercase;"
                                        maxlength="8"
                                    >
                                    <small style="display: block; color: #6c757d; font-size: 11px; margin-top: 3px;">UK format: SW1A 1AA</small>
                                </div>
                                <span class="removeclass small2 "><i class="fa fa-times" title="Remove" aria-hidden="true"></i></span>
                                <div class="css_error2 required-field-no_${m}" style="clear:both;"> </div>
                                ${result.html}
                            </div>
                            `
                        );
                    }
                });
                i++;
                m++;
            }
            return false;
        });

        $("body").on("click", ".removeclass", function(e) {
            if (i > 1) {
                $(this).parent('.store-details').remove();
                i--;
            }
        });

        // Prevent double submission for add store form
        $('#addstore').on('submit', function(e) {
            const $form = $(this);
            const $submitBtn = $('#save-store-btn');
            const $btnText = $submitBtn.find('.btn-text');
            const $btnLoading = $submitBtn.find('.btn-loading');
            
            // Check if form is already being submitted
            if ($submitBtn.data('submitting') === true) {
                e.preventDefault();
                return false;
            }
            
            // Mark as submitting
            $submitBtn.data('submitting', true);
            
            // Regenerate submission token for this attempt
            const newToken = 'store_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            $('#submission-token').val(newToken);
            
            // Disable button and show loading state
            $submitBtn.prop('disabled', true);
            $btnText.hide();
            $btnLoading.show();
            
            // Re-enable after 10 seconds as a safety measure (in case of error or network issue)
            const timeoutId = setTimeout(function() {
                $submitBtn.data('submitting', false);
                $submitBtn.prop('disabled', false);
                $btnText.show();
                $btnLoading.hide();
            }, 10000);
            
            // Clear timeout if form submission completes (handled by page reload or AJAX response)
            // This is a fallback - the page will reload on successful submission
        });

        // UK Postcode auto-formatting and validation
        function formatUKPostcode(input) {
            let value = input.value.replace(/\s+/g, '').toUpperCase();
            
            // Remove any non-alphanumeric characters except spaces
            value = value.replace(/[^A-Z0-9]/g, '');
            
            // Auto-format: Add space before last 3 characters if length > 3
            if (value.length > 3) {
                value = value.slice(0, -3) + ' ' + value.slice(-3);
            }
            
            input.value = value;
        }
        
        // Apply postcode formatting to all postcode inputs
        $(document).on('input', 'input[name^="emp_store_zip_"], input[name^="store_zip_"]', function() {
            formatUKPostcode(this);
        });
        
        // Validate postcode on blur
        $(document).on('blur', 'input[name^="emp_store_zip_"], input[name^="store_zip_"]', function() {
            const postcode = $(this).val().trim();
            const ukPostcodeRegex = /^[A-Z]{1,2}[0-9R][0-9A-Z]? [0-9][ABD-HJLNP-UW-Z]{2}$/i;
            
            if (postcode && !ukPostcodeRegex.test(postcode)) {
                $(this).addClass('is-invalid');
                if (!$(this).next('.postcode-error').length) {
                    $(this).after('<span class="postcode-error field-error" style="display: block; color: #dc3545; font-size: 12px; margin-top: 5px;">Please enter a valid UK postcode format (e.g., SW1A 1AA, M1 1AA, B33 8TH)</span>');
                }
            } else {
                $(this).removeClass('is-invalid');
                $(this).next('.postcode-error').remove();
            }
        });

        $(".deleteclass").click(function() {
            var id = $(this).attr('id');
            $('div#alert-confirm-modal #alert-message').html('Do you really want to delete store?');
            $('div#alert-confirm-modal').addClass('in');
            $('div#alert-confirm-modal').css('display', 'block');
            $('div#alert-confirm-modal #confirm').click(function() {
                $("#loader-div").show();
                $.ajax({
                    'url': `/ajax/employer/manage-store/${id}`,
                    'type': 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                    },
                    success: function(result) {
                        if (result.success) {
                            $("#loader-div").hide();
                            $('div#alert-confirm-modal').removeClass('in');
                            $('div#alert-confirm-modal').css('display', 'none');
                            messageBoxOpen("Store deleted.");
                        } else {
                            $("#loader-div").hide();
                            $('div#alert-confirm-modal').removeClass('in');
                            $('div#alert-confirm-modal').css('display', 'none');
                            messageBoxOpen(result.message, "not-reload");
                        }
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            var availableTags = @json($site_towns_available_tags);
            $(".city").autocomplete({
                source: availableTags
            });
        });
    </script>
@endpush
