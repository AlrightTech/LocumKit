@extends('layouts.user_profile_app')
@push('styles')
    <style>
        .ui-datepicker {
            width: 28em !important;
            margin: 0 auto 20px;
        }
        
        .timeline-item {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .timeline-item label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }
        
        .timeline-preview {
            background-color: #e9ecef;
            border-radius: 4px;
            padding: 8px;
            border-left: 3px solid #2dc9ff;
        }
        
        .timeline-preview-text {
            color: #6c757d;
            font-size: 12px;
        }
        
        .timeline-preview .rate-preview,
        .timeline-preview .time-preview,
        .timeline-preview .date-preview {
            font-weight: bold;
            color: #2dc9ff;
        }
        
        /* Checkbox styling */
        .timeline-box input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            margin-right: 10px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border: 2px solid #2dc9ff;
            border-radius: 4px;
            position: relative;
            background-color: white;
            transition: all 0.2s ease;
        }
        
        .timeline-box input[type="checkbox"]:checked {
            background-color: #2dc9ff;
            border-color: #2dc9ff;
        }
        
        .timeline-box input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 14px;
            font-weight: bold;
            line-height: 1;
        }
        
        .timeline-box input[type="checkbox"]:hover {
            border-color: #1fa8d6;
            box-shadow: 0 0 0 2px rgba(45, 201, 255, 0.2);
        }
        
        .timeline-div {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .timeline-text {
            flex: 1;
        }
        
        .removeclass {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .removeclass:hover {
            transform: scale(1.1);
        }
        
        #timeline_box h4 {
            color: #2dc9ff;
            margin-bottom: 10px;
        }
        
        #timeline_box .text-muted {
            margin-bottom: 20px;
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
                        <li><a href="/employer/dashboard">My Dashboard</a></li>
                        <li><a href="#">Post Job</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="breadcrum-title">
            <div class="container">
                <div class="row">
                    <div class="set-icon registration-icon">
                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                    </div>
                    <div class="set-title">
                        <h3>Post Job</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="primary-content" class="main-content post-job">
        <div class="container">
            <div class="row">
                <div class="white-bg contents">
                    <section>
                    </section>
                    <div class="col-sm-9 col-md-8 col-lg-7 post-job-content">
                        <div class="job-content">
                            <form id="mamagejob" @if ($job && $job_edit_action) action="/employer/managejob/{{ $job->id }}" @else action="/employer/managejob" @endif method="post">
                                @csrf
                                @if ($job && $job_edit_action)
                                    @method('PUT')
                                @endif
                                <div class="col-md-12 margin-bottom margin-top">
                                </div>

                                <div class="mar-mins" id="step2" style="display:block;">
                                    <!-- 1. Job Reference -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Job Reference <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input 
                                                type="text" 
                                                name="job_reference" 
                                                class="form-control margin-bottom" 
                                                @if (isset($job) && $job && $job->job_reference) 
                                                    value="{{ $job->job_reference }}" 
                                                @endif
                                                placeholder="e.g., OPT-JAN25-001" 
                                                pattern="[A-Za-z0-9\-]+"
                                                title="Alphanumeric with dashes allowed"
                                                required
                                            >
                                            <small class="text-muted">A short name or code to identify the job.</small>
                                        </div>
                                    </div>

                                    <!-- 2. Location / Store -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Location / Store <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="job_store" id="job_store" class="form-control" required>
                                                <option value="" disabled selected>Select Store</option>
                                                @foreach ($employer_store_list as $store)
                                                    <option value="{{ $store->id }}" @if (isset($job) && $job) @selected($job->employer_store_list_id == $store->id) @endif> {{ $store->store_name }} </option>
                                                @endforeach
                                            </select>
                                            <div id="store-details" class="margin-top" style="display:none;">
                                                <div class="alert alert-info" style="margin-top:10px;">
                                                    <strong>Store Details:</strong><br>
                                                    <span id="store-address"></span><br>
                                                    <span id="store-contact"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3. Date & Time (Multiple Rows) -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Date & Time <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="datetime-rows">
                                                <div class="datetime-row margin-bottom" style="border:1px solid #ddd; padding:15px; border-radius:5px; margin-bottom:10px;">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Date</label>
                                                            <input 
                                                                type="text" 
                                                                name="job_dates[]" 
                                                                class="form-control margin-bottom req-datepicker datetime-date" 
                                                                pattern="\d{2}/\d{2}/\d{4}" 
                                                                placeholder="dd/mm/yyyy" 
                                                                required
                                                                readonly
                                                            >
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Start Time (HH:mm)</label>
                                                            <input 
                                                                type="time" 
                                                                name="job_start_times[]" 
                                                                class="form-control margin-bottom datetime-start-time" 
                                                                required
                                                            >
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>End Time (HH:mm)</label>
                                                            <input 
                                                                type="time" 
                                                                name="job_end_times[]" 
                                                                class="form-control margin-bottom datetime-end-time" 
                                                                required
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-info" id="add-datetime-row">
                                                <i class="fa fa-plus"></i> Add Another Date & Time
                                            </button>
                                        </div>
                                    </div>

                                    <!-- 4. Rate Offered -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Rate Offered (£) <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input 
                                                type="number" 
                                                name="job_rate" 
                                                min="1" 
                                                max="999999" 
                                                step="0.01" 
                                                class="form-control margin-bottom" 
                                                @if (isset($job) && $job) 
                                                    value="{{ $job->job_rate }}" 
                                                @endif
                                                placeholder="Enter rate in (£)" 
                                                required 
                                            />
                                            <small class="text-muted">This is the rate locums will initially see.</small>
                                        </div>
                                    </div>

                                    <!-- 5. Number of Locums Needed -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Number of Locums Needed <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input 
                                                type="number" 
                                                name="num_locums_needed" 
                                                min="1" 
                                                max="100" 
                                                class="form-control margin-bottom" 
                                                @if (isset($job) && $job && $job->num_locums_needed) 
                                                    value="{{ $job->num_locums_needed }}" 
                                                @else
                                                    value="1"
                                                @endif
                                                required 
                                            />
                                        </div>
                                    </div>
                                    <!-- 6. Preset Rate Increase (Optional) -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Preset Rate Increase</label>
                                        </div>
                                        <div class="col-md-8 timeline-div">
                                            <div class="timeline-box">
                                                <input type="checkbox" name="set_timeline" value="1" class="form-control margin-bottom" id="open_timeline" @if (isset($job) && $job && sizeof($job->job_post_timelines) > 0) checked @endif>
                                            </div>
                                            <div class="timeline-text">Enable automatic rate increase if not accepted.</div>
                                            <div class="" id="show_add" @if (isset($job) && $job && sizeof($job->job_post_timelines) > 0) style="" @else style="display:none;" @endif>
                                                <a href="javascript:void(0);" class="color-white" id="add_timeline">
                                                    <i class="fa fa-plus" aria-hidden="true" title="Add Timeline"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="timeline_box" @if (isset($job) && $job && sizeof($job->job_post_timelines) > 0) style="" @else style="display:none;" @endif>
                                        <div class="col-md-12">
                                            <h4>Rate Increase Timeline</h4>
                                            <p class="text-muted">Set up automatic rate increases if the job is not accepted by specific times.</p>
                                        </div>
                                        <div class="col-md-12 list_block">
                                            @if (isset($job) && $job && sizeof($job->job_post_timelines) > 0)
                                                @foreach ($job->job_post_timelines as $timeline)
                                                    <div class="add_block timeline-item">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label>Date</label>
                                                                <input type="date" name="job_date_new[]" value="{{ $timeline->job_date_new->format('Y-m-d') }}" class="form-control margin-bottom timeline-date" placeholder="Enter date" min="{{ date('Y-m-d') }}" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Time</label>
                                                                <select name="job_timeline_time[]" class="form-control margin-bottom timeline-time" required>
                                                                    <option value="">Select Time</option>
                                                                    @for($hour = 9; $hour <= 17; $hour++)
                                                                        @for($minute = 0; $minute < 60; $minute += 30)
                                                                            @php
                                                                                $timeValue = sprintf('%02d:%02d', $hour, $minute);
                                                                                $timeDisplay = sprintf('%02d:%02d', $hour, $minute);
                                                                            @endphp
                                                                            <option value="{{ $timeValue }}" @selected($timeline->job_timeline_time == $timeValue)>{{ $timeDisplay }}</option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Increase Rate</label>
                                                                <input type="number" name="job_rate_new[]" value="{{ $timeline->job_rate_new }}" class="form-control margin-bottom timeline-rate" placeholder="£0" min="0" max="999999" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>&nbsp;</label>
                                                                <div class="timeline-preview">
                                                                    <small class="text-muted">Preview:</small><br>
                                                                    <small class="timeline-preview-text">Increase by £<span class="rate-preview">{{ $timeline->job_rate_new }}</span> if not accepted by <span class="time-preview">{{ $timeline->job_timeline_time ?? '09:00' }}</span> on <span class="date-preview">{{ $timeline->job_date_new->format('d/m/Y') }}</span></small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label>&nbsp;</label>
                                                                <span class="removeclass small2 btn btn-danger btn-sm" style="margin-top: 25px;"><i class="fa fa-times" aria-hidden="true"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="timeline_box_new"></div>
                                    <div class="col-md-12" style="display:none">
                                        <div class="col-md-4">Job type</div>
                                        <div class="col-md-8">
                                            <select id="job_type" name="job_type" class="form-control margin-bottom" required>

                                                <option value="1">First come first serve</option>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- 7. Special Requirements (Optional) -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Special Requirements</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="margin-bottom">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="special_requirements[]" value="Must speak Urdu"> Must speak Urdu
                                                </label><br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="special_requirements[]" value="Must be experienced with OCT scans"> Must be experienced with OCT scans
                                                </label><br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="special_requirements[]" value="Must cover contact lens fitting"> Must cover contact lens fitting
                                                </label>
                                            </div>
                                            <input 
                                                type="text" 
                                                name="special_requirements_custom" 
                                                class="form-control margin-bottom" 
                                                placeholder="Enter custom requirements (comma-separated)"
                                                @if (isset($job) && $job && $job->special_requirements) 
                                                    value="{{ $job->special_requirements }}" 
                                                @endif
                                            >
                                            <small class="text-muted">Only locums meeting these requirements will see the job.</small>
                                        </div>
                                    </div>

                                    <!-- 8. Special Instructions (Optional) -->
                                    <div class="col-md-12">
                                        <div class="col-md-4">
                                            <label>Special Instructions</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea 
                                                name="job_post_desc" 
                                                class="form-control margin-bottom" 
                                                rows="4"
                                                placeholder="Enter any special instructions (e.g., Parking available at rear, bring your own trial frame)"
                                            >@php
                                                if (isset($job) && $job) {
                                                    echo $job->job_post_desc;
                                                }
                                            @endphp</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-12 store-note store-note-click">

                                            <p>To edit your store requirements<a href="javascript:void(0);" onClick="popup();" style=" color: #ffb200;">click here</a></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12" align="center">
                                        <button class="post-job-btn" style="border-radius:10px;">
                                            Save Job & Search for available locums 
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-5 sidebar-right-post-padd">
                        <div class="sidebar-notifications">
                            <div class="notifications">
                                <div class="set-icon"><img alt="" src="/frontend/locumkit-template/img/notification-ico.png" /></div>
                                <div class="set-title">Enter job requirements here .</div>
                                <div class="set-title">Note: All other requisites are automatically incorporated based on your replies upon registration</div>
                            </div>
                            <div class="notifications notf2">
                                <div class="set-icon"><img alt="" src="/frontend/locumkit-template/img/mobile-ico.png" /></div>
                                <div class="set-title">We use all inputs to carefully select all locums who match your requirement</div>
                            </div>
                        </div>

                        <div class="sidebar-help">
                            <h5>Need help? please <a href="/contact" style="color:#00a9e0">click here</a></h5>
                            <ul>
                                <li><a href="tel:07452 998 238"><img src="/frontend/locumkit-template/img/contact-ico.png"> 07452 998 238</a></li>
                                <li> <a href="mailto:admin@locumkit.com"> <img src="/frontend/locumkit-template/img/mail-ico.png"> admin@locumkit.com</a> </li>

                            </ul>
                        </div>
                    </div>
                    <div class="one-page-box widget-box no-border col-xs-12 visible">
                        <div class="widget-body">
                            <div class="widget-main form_settings managejob-frm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        var dateObj = new Date();
        var currentYear = dateObj.getFullYear();
        var rangeYear = currentYear + 3;
        $(document).ready(datePickerCaller);

        (() => {
            // Allow selecting today and future dates (minDate: 0 means today)
            $(".req-datepicker").datepicker({
                minDate: 0, // Allow today and future dates
                maxDate: '+3y',
                defaultDate: 0,
                changeMonth: true,
                changeYear: true,
                beforeShowDay: DisableSpecificDatesReq,
                dateFormat: "dd/mm/yy",
                yearRange: 'c:c+3',
                onSelect: function(dateText) {
                    $(this).val(dateText);
                }
            });
        })();

        function datePickerCaller() {
            $('.datepicker').each(function() {
                // Allow selecting today and future dates (minDate: 0 means today)
                $(this).datepicker({
                    minDate: 0, // Allow today and future dates
                    maxDate: '+3y',
                    defaultDate: 0,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "dd/mm/yy",
                    yearRange: 'c:c+3',
                    onSelect: function(dateText) {
                        $(this).val(dateText);
                    }
                });
            });
        }

        function DisableSpecificDatesReq(date) {
            var string = $.datepicker.formatDate('yy-mm-dd', date);
            var today = $.datepicker.formatDate('yy-mm-dd', new Date());
            if (string >= today) {
                return [true, "available-date", ""];
            } else {
                return [true, " ui-datepicker-unselectable ui-state-disabled", ""];
            }
        }
    </script>
    <script type="text/javascript">
$(document).ready(function() {
    // Store details display
    const storeData = {!! $store_data_json !!};
    
    $('#job_store').on('change', function() {
        const storeId = parseInt($(this).val());
        if (storeId) {
            const store = storeData.find(s => parseInt(s.id) === storeId);
            if (store) {
                $('#store-address').text(store.address + ', ' + store.region + ' ' + store.zip);
                // Note: Contact number would need to come from user_extra_info or another source
                $('#store-contact').text('Contact: Available in store details');
                $('#store-details').slideDown();
            }
        } else {
            $('#store-details').slideUp();
        }
    });
    
    // Initialize store details if editing
    @if (isset($job) && $job)
        $('#job_store').trigger('change');
    @endif
    
    // Dynamic Date-Time Rows
    function addDateTimeRow() {
        const rowHtml = `
            <div class="datetime-row margin-bottom" style="border:1px solid #ddd; padding:15px; border-radius:5px; margin-bottom:10px; position:relative;">
                <button type="button" class="btn btn-sm btn-danger remove-datetime-row" style="position:absolute; top:5px; right:5px;">
                    <i class="fa fa-times"></i>
                </button>
                <div class="row" style="margin-top:20px;">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input 
                            type="text" 
                            name="job_dates[]" 
                            class="form-control margin-bottom req-datepicker datetime-date" 
                            pattern="\\d{2}/\\d{2}/\\d{4}" 
                            placeholder="dd/mm/yyyy" 
                            required
                            readonly
                        >
                    </div>
                    <div class="col-md-4">
                        <label>Start Time (HH:mm)</label>
                        <input 
                            type="time" 
                            name="job_start_times[]" 
                            class="form-control margin-bottom datetime-start-time" 
                            required
                        >
                    </div>
                    <div class="col-md-4">
                        <label>End Time (HH:mm)</label>
                        <input 
                            type="time" 
                            name="job_end_times[]" 
                            class="form-control margin-bottom datetime-end-time" 
                            required
                        >
                    </div>
                </div>
            </div>
        `;
        $('#datetime-rows').append(rowHtml);
        // Initialize datepicker for new row
        $('.req-datepicker').last().datepicker({
            minDate: 0,
            maxDate: '+3y',
            defaultDate: 0,
            changeMonth: true,
            changeYear: true,
            beforeShowDay: DisableSpecificDatesReq,
            dateFormat: "dd/mm/yy",
            yearRange: 'c:c+3',
            onSelect: function(dateText) {
                $(this).val(dateText);
            }
        });
    }
    
    $('#add-datetime-row').on('click', function() {
        addDateTimeRow();
    });
    
    $(document).on('click', '.remove-datetime-row', function() {
        if ($('.datetime-row').length > 1) {
            $(this).closest('.datetime-row').fadeOut(300, function() {
                $(this).remove();
            });
        } else {
            alert('At least one date & time row is required.');
        }
    });
    
    const blockHtml = `
        <div class="add_block timeline-item">
            <div class="row">
                <div class="col-md-3">
                    <label>Date</label>
                    <input type="date" name="job_date_new[]" class="form-control margin-bottom timeline-date" placeholder="Enter date" required>
                </div>
                <div class="col-md-2">
                    <label>Time</label>
                    <select name="job_timeline_time[]" class="form-control margin-bottom timeline-time" required>
                        <option value="">Select Time</option>
                        <option value="09:00">09:00</option>
                        <option value="09:30">09:30</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="12:00">12:00</option>
                        <option value="12:30">12:30</option>
                        <option value="13:00">13:00</option>
                        <option value="13:30">13:30</option>
                        <option value="14:00">14:00</option>
                        <option value="14:30">14:30</option>
                        <option value="15:00">15:00</option>
                        <option value="15:30">15:30</option>
                        <option value="16:00">16:00</option>
                        <option value="16:30">16:30</option>
                        <option value="17:00">17:00</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Increase Rate</label>
                    <input type="number" name="job_rate_new[]" class="form-control margin-bottom timeline-rate" placeholder="£0" min="0" max="999999" required>
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label>
                    <div class="timeline-preview">
                        <small class="text-muted">Preview:</small><br>
                        <small class="timeline-preview-text">Increase by £<span class="rate-preview">0</span> if not accepted by <span class="time-preview">09:00</span> on <span class="date-preview">--/--/----</span></small>
                    </div>
                </div>
                <div class="col-md-1">
                    <label>&nbsp;</label>
                    <span class="removeclass small2 btn btn-danger btn-sm" style="margin-top: 25px;"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    `;

    function addBlock() {
        // Get today's date in YYYY-MM-DD format for min attribute
        const today = new Date().toISOString().split('T')[0];
        
        $('.list_block').append(blockHtml);
        
        // Set min date attribute for the newly added date input to prevent past dates
        $('.add_block:last-child .timeline-date').attr('min', today);
        
        // Hide the fa-times icon for the first block
        if ($('.add_block').length === 1) {
            $('.add_block:last-child .removeclass').hide();
        } else {
            $('.add_block:last-child .removeclass').show();
        }
        
        // Add event listeners for preview updates
        updateTimelinePreview($('.add_block:last-child'));
    }

    function updateTimelinePreview(block) {
        const date = block.find('.timeline-date').val();
        const time = block.find('.timeline-time').val();
        const rate = block.find('.timeline-rate').val();
        
        // Format date properly
        let datePreview = '--/--/----';
        if (date) {
            const dateObj = new Date(date + 'T00:00:00');
            if (!isNaN(dateObj.getTime())) {
                const day = String(dateObj.getDate()).padStart(2, '0');
                const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                const year = dateObj.getFullYear();
                datePreview = `${day}/${month}/${year}`;
            }
        }
        
        const timePreview = time || '09:00';
        const ratePreview = rate || '0';
        
        block.find('.date-preview').text(datePreview);
        block.find('.time-preview').text(timePreview);
        block.find('.rate-preview').text(ratePreview);
    }

    // Add event listeners for existing blocks
    $(document).on('change', '.timeline-date, .timeline-time, .timeline-rate', function() {
        updateTimelinePreview($(this).closest('.add_block'));
    });

    // Click event for adding new blocks
    $("#add_timeline").click(function() {
        addBlock();
    });

    // Checkbox toggle functionality
    $('input[name="set_timeline"]').on('change', function() {
        if (this.checked) {
            $('.timeline-date').attr('required', 'required');
            $('.timeline-rate').attr('required', 'required');
            $('.timeline-time').attr('required', 'required');
            $("#timeline_box").slideDown(300);
            $("#show_add").slideDown(300);
            if ($('.list_block .add_block').length === 0) {
                addBlock(); // Append the first block
            }
        } else {
            $('.timeline-date').removeAttr('required');
            $('.timeline-rate').removeAttr('required');
            $('.timeline-time').removeAttr('required');
            $("#timeline_box").slideUp(300);
            $("#show_add").slideUp(300);
            $('.list_block').html(""); // Clear the blocks
        }
    });
    
    // Initialize checkbox state on page load
    if ($('input[name="set_timeline"]').is(':checked')) {
        $('.timeline-date').attr('required', 'required');
        $('.timeline-rate').attr('required', 'required');
        $('.timeline-time').attr('required', 'required');
    }

    // Remove block when the remove button is clicked
    $("body").on("click", ".removeclass", function(e) {
        e.preventDefault();
        const block = $(this).closest('.add_block');
        if ($(".add_block").length > 1) {
            block.fadeOut(300, function() {
                $(this).remove();
            });
        }
    });

    // Initialize existing blocks on page load
    $('.add_block').each(function() {
        updateTimelinePreview($(this));
        
        // Add event listeners to existing blocks
        $(this).find('.timeline-date, .timeline-time, .timeline-rate').on('change', function() {
            updateTimelinePreview($(this).closest('.add_block'));
        });
    });
});

        $('.numbersOnly').keyup(function() {
            if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
                this.value = this.value.replace(/[^0-9\.]/g, '');
            }
        });

        function popup() {
            var w = 560;
            var h = 560;
            var left = Number((screen.width / 2) - (w / 2));
            var tops = Number((screen.height / 2) - (h / 2));
            var popper = window.open("/employer/edit-questions?popup=yes",
                "Store Requirements Window",
                `width=${w}, height=${h}, top=${tops}, left=${left}, menubar=no,status=no,scrollbars=yes`
            );
            popper.focus();
        }
    </script>
@endpush
