<!DOCTYPE html>
<html>

<head>
    <title>My Dashboard</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="description" content="My Dashboard" />
    <meta name="keywords" content="My Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/frontend/locumkit-template/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/frontend/locumkit-template/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/frontend/locumkit-template/css/style.css" rel="stylesheet" type="text/css">
    <link href="/frontend/locumkit-template/css/responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style type="text/css" src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css"></style>

    <link href="/frontend/locumkit-template/new-design-assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/frontend/locumkit-template/new-design-assets/css/animations.min.css" type="text/css" rel="stylesheet">
    <link href="/frontend/locumkit-template/new-design-assets/css/theme.css" type="text/css" rel="stylesheet">
    <link href="/frontend/locumkit-template/new-design-assets/css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootsrap-5.css') }}">
    <link href="/frontend/locumkit-template/new-design-assets/css/theme-fonts.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/frontend/locumkit-template/new-design-assets/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .toastify {
            background-color: red !important;
        }

        .toastify.on {
            background-color: red !important;
        }
    </style>

    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', `{{ config('app.google_tag_manager_id') }}`);
    </script>

    @stack('styles')

    <style>
        .d-none {
            display: none;
        }

        .d-block {
            display: block;
        }

        footer .recentpost li:before {
            content: "\F309" !important;
            font-family: fontawesome;
            color: #fff;
            font-size: 14px;
            position: absolute;
            left: 0;
        }
        svg {
            color: #696969;
        }
    </style>
</head>

<body>

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('app.google_tag_manager_id') }}"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <div id="loader-div">
        <div class="loader"></div>
    </div>
    <header class="header-wrapper" id="header">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/"><img src="/frontend/locumkit-template/img/logo.png"
                                alt="Locumkit" title="Locumkit"></a>
                    </div>

                    <div class="top-main-nav pull-right">
                        <div class="uploadinfo pull-right">
                            <ul>
                                @guest
                                    <li><a href="javascript:void(0);" title="Log In" alt="Log In" data-toggle="modal"
                                            data-target="#login-form-model">Log In</a></li>
                                    <li><a href="/register" title="Register" alt="Register">Register</a></li>
                                @else
                                    @can('is_employer')
                                        <li><a href="/employer/dashboard" title="My Profile" alt="My Profile">My Dashboard</a>
                                        </li>
                                    @endcan
                                    @can('is_freelancer')
                                        <li><a href="/freelancer/dashboard" title="My Profile" alt="My Profile">My Dashboard</a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a href="javascript:void(0);" onclick="$('#logout-form').submit();" title="Logout"
                                            alt="Logout"><i class="fa fa-power-off" aria-hidden="true"></i></a>
                                    </li>
                                    <form style="display: none;" aria-hidden="true" action="/logout" id="logout-form"
                                        style="display: inline-block;" method="post" hidden>
                                        @csrf
                                    </form>
                                @endguest

                            </ul>
                        </div>
                        <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                            <nav id="nav" style="margin-top:10px;">
                                <ul class="sf-menu navigation">
                                    <li>
                                        <a href="/">Home</a>
                                    </li>
                                    <li>
                                        <a href="/contact">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <section id="profile-banner"
        style="background:url('/media/files/33/245/5765322e4f7ba.jpg') no-repeat center center;-webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;background-attachment: fixed; width:100%;min-height: 350px; max-height:auto;display:none;">
        <div class="container">
            <div class="row">
                <div class="banner-header" align="center">
                    <div class="banner-text-bottom">
                        <div class="profile-banner-head">Discover Locumkit</div>
                        <p>If you need a doctor for to consectetuer Lorem ipsum dolor, consectetur adipiscing elit.
                            Utvolutpat eros adipiscing elit Ut volutpat. aliquam erat volutpat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @yield('content')

    @include('components.footer')

    <div id="alert-modal" class="alert-modal modal fade">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">LocumKit</h4>
                </div>
                <div class="modal-body">
                    <h3 id="alert-message"></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-alert btn btn-default" data-dismiss="modal"
                        onClick="window.location.reload()">Ok</button>
                </div>
            </div>
        </div>
    </div>

    @guest
        <div id="login-form-model" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header no-border-bottom">
                        <button type="button" class="close" data-dismiss="modal"
                            onclick="close_dive('profession_question');">&times;</button>
                        <h4 class="modal-title">Login Form</h4>
                    </div>
                    <div class="modal-body">
                        <form id="one-page-form" action="{{ route('login') }}" method="post" class="login-from"
                            class="login-form-pop">
                            @csrf
                            <fieldset class="has-warning">
                                <span class="input-glyphicon input-glyphicon-right block">
                                    <input name="login" type="text" class="form-control margin-bottom"
                                        placeholder="Enter username or email" autofocus required />
                                </span>
                                <span class="input-glyphicon input-glyphicon-right block">
                                    <input name="password" type="password" class="form-control margin-bottom"
                                        placeholder="Enter Password" required />
                                </span>
                                <div class="clearfix buttons">
                                    <button class="pull-left btn btn-small btn-warning">
                                        <i class="glyphicon glyphicon-log-in"></i>
                                        Log In </button>
                                    <a href="{{ route('password.request') }}" class="pull-right">Forgot Password?</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endguest

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

<style>
        #ui-datepicker-div {
            width: 420px;
        }
        .financeform .input-group button {
            width: 17%;
        }
        .financeform .input-group input {
            width: 80%;
        }
        
        .btn {
            padding: 8px 30px;
        }
    </style>
    <div id="manage-bank-income" class="modal fade financepopup" role="dialog">
        <div class="modal-dialog">
            <form action="/freelancer/income/update-bank-detail" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Locumkit</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 pad0 financeform">
                            <div class="form-group" id="bank_date">
                                <div class="pull-left" style="display: none;">
                                    <input name="in_bank" id="modal-in_bank" value="1" type="hidden">
                                </div>
                                <div class="input-group" id="for-display" style="display: block;">
                                    <p>Please enter the date the transaction hit the bank</p>
                                    <input type="hidden" name="in_bankid" id="in_bankid">
                                    <input type="date" class="form-control" name="in_bankdate" id="in_bankdate"
                                        required>
                                    <button type="submit" class="btn btn-info" name="income-bank-btn"
                                        value="income-bank-btn" id="income-bank-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="manage-bank-expense" class="modal fade financepopup" role="dialog">
        <div class="modal-dialog">
            <form action="/freelancer/expense/update-bank-detail" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Locumkit</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 pad0 financeform">
                            <div class="form-group" id="bank_date">
                                <div class="input-group" id="for-displayex" style="display:block">
                                    <p>Please enter the date the transaction hit the bank</p>
                                    <input type="hidden" name="ex_bankid" id="ex_bankid">
                                    <input type="date" class="form-control" name="ex_bankdate" required>
                                    <button type="submit" class="btn btn-info" id="expense-bank-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (Auth::check() && Auth::user()->user_acl_role_id == 2)
        <div id="locum-manage-financial-type" class="modal fade financepopup" role="dialog">
            <div class="modal-dialog">
                <form action="/freelancer/update-employment-status" method="post">
                    @csrf
                    <div class="modal-content first-model d-block" id="model-1">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"> Employment status </h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 pad0 financeform">
                                <div class="form-group" id="bank_date">
                                    <div class="col-md-5">Who are you?</div>
                                    <div class="col-md-7">
                                        <select name="user_finance_type" id="user_finance_type" class="form-control"
                                            onchange="limitedCompany()" required id="employmentStatus">
                                            <option value="">Select</option>
                                            <option value="soletrader">Sole trader</option>
                                            <option value="limitedcompany">Limited company</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: center" class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-content second-model d-none" id="model-2">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"> Select End Month </h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 pad0 financeform">
                                <div class="form-group" id="bank_date">
                                    <div class="col-md-5">Select the Start Month</div>
                                    <div class="col-md-7">
                                        <select name="start_month" onchange="remove_disabled()" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">January</option>
                                            <option value="2">Febrary</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: center" class="form-group">
                                    <button type="button" id="backbutton" class="btn btn-primary"
                                        style="margin-right:2px !important;">Back</button>
                                    <button type="submit" id="savebtn"
                                        class="btn btn-primary disabled">Save</button>
                                </div>
                                <div style="display: flex; justify-content: center" class="form-group">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <a href="javascript:void(0);" class="scrollToTop"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i></a>

    <script src="/frontend/locumkit-template/js/jquery-1.10.2.min.js"></script>
    <script src="/frontend/locumkit-template/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="/frontend/locumkit-template/js/jquery-ui.multidatespicker.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript" src="/frontend/locumkit-template/js/jquery.dataTables.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script>
        window.defaultDateFormat = `{{ get_web_default_date_format() }}`;
    </script>

    {{-- Scroll manager --}}
    <script>
        function limitedCompany() {
            var limitedCompany = document.getElementById('user_finance_type').value;
            if (limitedCompany === 'limitedcompany') {
                var element = document.getElementById("model-2");
                element.classList.remove("d-none");
                element.classList.add("d-block");

                var element2 = document.getElementById("model-1");
                element2.classList.remove("d-block");
                element2.classList.add("d-none");
            }
        }

        $('#backbutton').click(function goBack() {
            var element2 = document.getElementById("model-1");
            element2.classList.remove("d-none");
            element2.classList.add("d-block");

            var element = document.getElementById("model-2");
            element.classList.remove("d-block");
            element.classList.add("d-none");
        })
        $('#month_start').click(function remove_disabled() {})

        function remove_disabled() {
            var savebtn = document.getElementById("savebtn");
            savebtn.classList.remove("disabled");
        }
    </script>
    <script type="text/javascript">
        $(function() {
            var headerTop = $('#header').offset().top + 5;
            $(window).scroll(function() {
                if ($(window).scrollTop() > headerTop) {
                    $('#header').css({
                        position: 'fixed',
                        top: '0px'
                    });
                    $('#header').addClass('fixed-header-wrapper');
                    $('#header .navbar-default .navbar-brand img').css({
                        width: '70px',
                        transition: 'all 0.4s ease 0s'
                    });
                    $('#header .navbar-default .navbar-brand ').css({
                        padding: '5px 15px',
                        transition: 'all 0.4s ease 0s'
                    });
                    $('#header .navbar-default .top-main-nav').css({
                        padding: '15px 0 10px',
                        transition: 'all 0.4s ease 0s'
                    });
                } else {
                    $('#header').css({
                        position: 'static',
                        top: '0px'
                    });
                    $('#header').removeClass('fixed-header-wrapper');
                    $('#header .navbar-default .navbar-brand img').css({
                        width: '80px',
                        transition: 'all 0.4s ease 0s'
                    });
                    $('#header .navbar-default .navbar-brand ').css({
                        padding: '15px',
                        transition: 'all 0.4s ease 0s'
                    });
                    $('#header .navbar-default .top-main-nav').css({
                        padding: '30px 0 15px',
                        transition: 'all 0.4s ease 0s'
                    });
                }
            });
        });

        $(document).ready(function() {
            //Check to see if the window is top if not then display button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.scrollToTop').fadeIn();
                } else {
                    $('.scrollToTop').fadeOut();
                }
            });

            //Click event to scroll to top
            $('.scrollToTop').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

        });
    </script>

    {{-- Model and bank manager --}}
    <script type="text/javascript">
        /*use for manage bank status*/
        $('input#modal-in_bank').change(function() {
            var c = this.checked ? '1' : '0';
            if (c == 1) {
                $('#fordisplay').show();
            } else {
                $('#fordisplay').hide();
            }
        });

        $('input#modal-ex_bank').change(function() {
            var c = this.checked ? '1' : '0';
            if (c == 1) {

                $('#fordisplayex').show();
            } else {
                $('#fordisplayex').hide();
            }
        });

        $(document).ready(function() {
            $('input.financein_bankdate').datepicker({
                maxDate: '0',
                dateFormat: window.defaultDateFormat
            });
        });
        $(document).ready(function() {
            $('input.financeex_bankdate').datepicker({
                maxDate: '0',
                dateFormat: window.defaultDateFormat
            });
        });

        function managebankincome(id) {
            $('#fordisplay').hide();
            $('#in_bankdate').val('');
            $('#modal-in_bank').attr('checked', false);
            $('#in_bankid').val(id);
            $('#manage-bank-income').modal('show');
        }

        function managebankexpanse(id) {
            $('#fordisplayex').hide();
            $('#ex_bankdate').val('');
            $('#modal-ex_bank').attr('checked', false);
            $('#ex_bankid').val(id);
            $('#manage-bank-expense').modal('show');
        }
        /*use for manage bank status end*/

        $('div.alert-modal button.close-alert').click(function() {
            messageBoxClose();
        });
        $('div.alert-modal button.close.hide-pop-up').click(function() {
            messageBoxClose();
        });

        function messageBoxClose() {
            $('div#alert-modal').removeClass('in');
            $('div#alert-modal').css('display', 'none');
            $('div#alert-confirm-modal').removeClass('in');
            $('div#alert-confirm-modal').css('display', 'none');
        }

        function messageBoxOpen(msg, url) {
            $('div#alert-modal #alert-message').html(msg);
            $('div#alert-modal').addClass('in');
            $('div#alert-modal').css('display', 'block');
            $('button.close-alert').attr('onClick', 'window.location.reload()');
            if (url != null) {
                $('button.close-alert').attr('onClick', 'window.location.replace("' + url + '")');
            }
            if (url == 'not-reload') {
                $('button.close-alert').removeAttr("onClick");
                $('button.close-alert').removeAttr("onclick");
            }
        }

        $("#loader-div").hide(100);
    </script>

    @if (Auth::check() && Auth::user()->user_acl_role_id == 2 && Auth::user()->financial_year()->count() == 0)
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <p>Copyright © {{ today()->format('Y') }} Locumkit - All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#locum-manage-financial-type").modal("show");
            })
        </script>
    @endif

    {{-- Notification and error, success messages --}}
    @include('components.validation-notifications')

    @stack('scripts')
</body>

</html>
