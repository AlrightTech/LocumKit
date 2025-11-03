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
                                    <div class="col-md-12">
                                        <div class="col-md-4"> Please select store to post job </div>
                                        <div class="col-md-8">
                                            <select name="job_store" id="job_store" class="form-control" required>
                                                <option value="" disabled selected>Select Store</option>
                                                @foreach ($employer_store_list as $store)
                                                    <option value="{{ $store->id }}" @if (isset($job) && $job) @selected($job->employer_store_list_id == $store->id) @endif> {{ $store->store_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4">Job reference </div>
                                        <div class="col-md-8">
                                            <input 
                                                type="text" 
                                                name="job_title" 
                                                minlength="5" 
                                                maxlength="50" 
                                                class="form-control margin-bottom" 
                                                @if (isset($job) && $job) 
                                                    value="{{ $job->job_title }}" 
                                                @endif
                                                placeholder="Enter job title for your reference" 
                                                required
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                        <div class="col-md-4">Date required</div>
                                        <div class="col-md-8">
                                            <input 
                                                type="text" 
                                                name="job_date" 
                                                class="form-control margin-bottom req-datepicker" 
                                                pattern="\d{2}/\d{2}/\d{4}" 
                                                @if (isset($job) && $job) 
                                                    value="{{ get_date_with_default_format($job->job_date) }}" 
                                                @endif
                                                placeholder="dd/mm/yyyy" 
                                                title="Date must be in dd/mm/yyyy format (e.g., 26/02/2024)" 
                                                required
                                                readonly
                                            >
                                            <small class="text-muted">Click to select date (Format: dd/mm/yyyy)</small>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="col-md-4">Rate offered(£)</div>
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
                                                placeholder="Enter job rate in (£)" 
                                                required 
                                            />
                                            <small class="text-muted">Enter rate between £1 and £999,999</small>
                                        </div>


                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8 timeline-div">
                                            <div class="timeline-box"><input type="checkbox" name="set_timeline" value="1" class="form-control margin-bottom" id="open_timeline" @if (isset($job) && $job && sizeof($job->job_post_timelines) > 0) checked @endif></div>
                                            <div class="timeline-text">If you wish to increase the rate if a locum is not booked, please click here.</div>
                                            <div class="" id="show_add" @if (isset($job) && $job && sizeof($job->job_post_timelines) > 0) style="" @else style="display:none;" @endif><a href="javascript:void(0);" class="color-white" id="add_timeline"><i
                                                       class="fa fa-plus" aria-hidden="true" title="Add Timeline"></i></a>
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
                                                                <input type="date" name="job_date_new[]" value="{{ $timeline->job_date_new->format('Y-m-d') }}" class="form-control margin-bottom timeline-date" placeholder="Enter date" required>
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
                                                            <div class="col-md-2">
                                                                <label>Increase Rate</label>
                                                                <input type="number" name="job_rate_new[]" value="{{ $timeline->job_rate_new }}" class="form-control margin-bottom timeline-rate" placeholder="£0" min="0" max="999999" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Hours</label>
                                                                <select name="job_timeline_hrs[]" class="form-control margin-bottom timeline-hrs" required>
                                                                    <option value="">Hours</option>
                                                                    @for($i = 1; $i <= 24; $i++)
                                                                        <option value="{{ $i }}" @selected($timeline->job_timeline_hrs == $i)>{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
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
                                    <div class="col-md-12">
                                        <div class="col-md-4">Job description</div>
                                        <div class="col-md-8">
                                            <textarea name="job_post_desc" class="form-control margin-bottom" placeholder="Enter any special instructions ie: half day / different timings">@php
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
            var min_date = 0;
            var currentTime = new Date(`{{ now() }}`);
            if (currentTime.getHours() > 11) {
                min_date = 1;
            }
            if (currentTime.getHours() == 11 && currentTime.getMinutes() > 30) {
                min_date = 1;
            }
            $(".req-datepicker").datepicker({
                minDate: min_date,
                maxDate: '+3y',
                defaultDate: min_date,
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
                var min_date = 0;
                var currentTime = new Date(`{{ now() }}`);
                if (currentTime.getHours() > 11) {
                    min_date = 1;
                }
                if (currentTime.getHours() == 11 && currentTime.getMinutes() > 30) {
                    min_date = 1;
                }

                $(this).datepicker({
                    minDate: min_date,
                    maxDate: '+3y',
                    defaultDate: min_date,
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
                <div class="col-md-2">
                    <label>Increase Rate</label>
                    <input type="number" name="job_rate_new[]" class="form-control margin-bottom timeline-rate" placeholder="£0" min="0" max="999999" required>
                </div>
                <div class="col-md-2">
                    <label>Hours</label>
                    <select name="job_timeline_hrs[]" class="form-control margin-bottom timeline-hrs" required>
                        <option value="">Hours</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                    </select>
                </div>
                <div class="col-md-2">
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
        $('.list_block').append(blockHtml);
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
        
        const datePreview = date ? new Date(date).toLocaleDateString('en-GB') : '--/--/----';
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

    // Initial block render when checkbox is checked
    $('input[name="set_timeline"]').click(function() {
        if (this.checked) {
            $('.timeline-date').attr('required', 'true');
            $('.timeline-rate').attr('required', 'true');
            $('.timeline-hrs').attr('required', 'true');
            $('.timeline-time').attr('required', 'true');
            $("#timeline_box").show();
            $("#show_add").show();
            if ($('.add_block').length === 0) {
                addBlock(); // Append the first block
            }
        } else {
            $('.timeline-date').removeAttr('required');
            $('.timeline-rate').removeAttr('required');
            $('.timeline-hrs').removeAttr('required');
            $('.timeline-time').removeAttr('required');
            $("#timeline_box").hide();
            $("#show_add").hide();
            $('.list_block').html(""); // Clear the blocks
        }
    });

    // Remove block when the remove button is clicked
    $("body").on("click", ".removeclass", function(e) {
        if ($(".add_block").length > 1) {
            $(this).parent('.add_block').remove();
        }
    });

    // Initialize existing blocks
    $('.add_block').each(function() {
        updateTimelinePreview($(this));
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
