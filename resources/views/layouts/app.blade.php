<!DOCTYPE html>
<html lang="en">

<head>

    <title>Locum Optician Agency | Locum Dispensing Optician - Locumkit.Com | Locum Accountant</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description"
        content="LocumKit is a bespoke platform which acts for Locum Optometrists and Locum Dispensing Opticians. We offer it all from Accountancy to locum bookings. We connects locum Optometrists and Opticians with employers">
    <meta name="keywords" content="Locum agency, Locum optician agency, Locum dispensing optician">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Cross-browser compatibility meta tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">

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

    <!-- Modern Footer Styles -->
    <style>
        /* Modern Footer Styles */
        .footer-modern {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #ffffff;
            margin-top: 60px;
            position: relative;
        }

        .footer-main {
            padding: 60px 0 40px;
            background-color: #252525;
        }

        .footer-widget {
            margin-bottom: 30px;
        }

        .footer-logo-modern {
            margin-bottom: 20px;
        }

        .footer-logo-modern img {
            filter: brightness(0) invert(1);
            transition: transform 0.3s ease;
        }

        .footer-logo-modern img:hover {
            transform: scale(1.05);
        }

        .footer-description {
            color: #b0b0b0;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        /* Newsletter Form */
        .newsletter-form-modern {
            margin-top: 20px;
        }

        .newsletter-input-group {
            display: flex;
            gap: 0;
            background: #ffffff;
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .newsletter-input-group:focus-within {
            box-shadow: 0 4px 20px rgba(0, 169, 224, 0.3);
        }

        .newsletter-input {
            flex: 1;
            padding: 14px 20px;
            border: none;
            outline: none;
            font-size: 14px;
            color: #333;
            background: transparent;
        }

        .newsletter-input::placeholder {
            color: #999;
        }

        .newsletter-btn {
            background: linear-gradient(135deg, #00A9E0 0%, #0088b8 100%);
            color: #ffffff;
            border: none;
            padding: 14px 28px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .newsletter-btn:hover {
            background: linear-gradient(135deg, #0088b8 0%, #006a94 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 169, 224, 0.4);
        }

        .newsletter-btn i {
            font-size: 16px;
        }

        .newsletter-responses {
            margin-top: 10px;
        }

        .newsletter-error {
            color: #ff6b6b;
            font-size: 13px;
            padding: 8px;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 4px;
        }

        .newsletter-success {
            color: #51cf66;
            font-size: 13px;
            padding: 8px;
            background: rgba(81, 207, 102, 0.1);
            border-radius: 4px;
        }

        /* Footer Titles */
        .footer-title {
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 12px;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #00A9E0 0%, #0088b8 100%);
            border-radius: 2px;
        }

        /* Footer Links */
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #b0b0b0;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a i {
            font-size: 12px;
            color: #00A9E0;
            transition: transform 0.3s ease;
        }

        .footer-links a:hover {
            color: #00A9E0;
            padding-left: 5px;
        }

        .footer-links a:hover i {
            transform: translateX(3px);
        }

        /* Footer Posts */
        .footer-posts {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-posts li {
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-posts li:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .footer-posts .post-title {
            color: #ffffff;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            transition: color 0.3s ease;
            line-height: 1.5;
        }

        .footer-posts .post-title:hover {
            color: #00A9E0;
        }

        .footer-posts .post-date {
            color: #888;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .footer-posts .post-date i {
            font-size: 11px;
        }

        .footer-posts .no-posts {
            color: #888;
            font-style: italic;
            border: none;
        }

        /* Footer Contact */
        .footer-contact {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
        }

        .footer-contact li {
            margin-bottom: 15px;
        }

        .footer-contact .contact-item {
            color: #b0b0b0;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .footer-contact .contact-item i {
            width: 40px;
            height: 40px;
            background: rgba(0, 169, 224, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00A9E0;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .footer-contact .contact-item:hover {
            color: #00A9E0;
        }

        .footer-contact .contact-item:hover i {
            background: #00A9E0;
            color: #ffffff;
            transform: scale(1.1);
        }

        /* Social Icons */
        .footer-social {
            margin-top: 25px;
        }

        .social-title {
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .social-icons {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 12px;
        }

        .social-icons li {
            margin: 0;
        }

        .social-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 18px;
        }

        .social-icon.facebook {
            background: rgba(59, 89, 152, 0.2);
            color: #3b5998;
        }

        .social-icon.facebook:hover {
            background: #3b5998;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(59, 89, 152, 0.4);
        }

        .social-icon.linkedin {
            background: rgba(0, 119, 181, 0.2);
            color: #0077b5;
        }

        .social-icon.linkedin:hover {
            background: #0077b5;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 119, 181, 0.4);
        }

        /* Copyright Section */
        .footer-copyright {
            background: #141414;
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .copyright-text {
            color: #888;
            font-size: 13px;
            margin: 0;
        }

        .copyright-text strong {
            color: #00A9E0;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-main {
                padding: 40px 0 30px;
            }

            .footer-widget {
                margin-bottom: 40px;
            }

            .newsletter-input-group {
                flex-direction: column;
                border-radius: 8px;
            }

            .newsletter-btn {
                border-radius: 0 0 8px 8px;
                justify-content: center;
            }

            .newsletter-input {
                border-radius: 8px 8px 0 0;
            }

            .footer-title {
                font-size: 16px;
            }

            .social-icons {
                justify-content: flex-start;
            }
        }

        @media (max-width: 576px) {
            .footer-main {
                padding: 30px 0 20px;
            }

            .footer-logo-modern img {
                width: 100px;
            }

            .footer-description {
                font-size: 13px;
            }
        }
    </style>

    @if(config('app.google_tag_manager_id'))
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
    @endif

    <!-- Cross-browser compatibility polyfills -->
    <script>
        // Polyfill for older browsers
        if (!Array.prototype.includes) {
            Array.prototype.includes = function(searchElement, fromIndex) {
                return this.indexOf(searchElement, fromIndex) !== -1;
            };
        }
        
        // Ensure console exists for older browsers
        if (!window.console) {
            window.console = {
                log: function() {},
                warn: function() {},
                error: function() {}
            };
        }
        
        // Fix for IE11 and older browsers - Simple fetch polyfill
        if (!window.fetch) {
            window.fetch = function(url, options) {
                return new Promise(function(resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.open(options ? options.method || 'GET' : 'GET', url);
                    
                    if (options && options.headers) {
                        Object.keys(options.headers).forEach(function(key) {
                            xhr.setRequestHeader(key, options.headers[key]);
                        });
                    }
                    
                    xhr.onload = function() {
                        resolve({
                            ok: xhr.status >= 200 && xhr.status < 300,
                            status: xhr.status,
                            json: function() {
                                return Promise.resolve(JSON.parse(xhr.responseText));
                            },
                            text: function() {
                                return Promise.resolve(xhr.responseText);
                            }
                        });
                    };
                    
                    xhr.onerror = function() {
                        reject(new Error('Network error'));
                    };
                    
                    xhr.send(options ? options.body : null);
                });
            };
        }
    </script>

    <style>
        #mc_embed_signup input.mce_inline_error {
            border-color: #6B0505;
        }

        #mc_embed_signup div.mce_inline_error {
            margin: 0 0 1em 0;
            padding: 5px 10px;
            background-color: #6B0505;
            font-weight: bold;
            z-index: 1;
            color: #fff;
        }

        svg {
            color: #696969;
        }
    </style>

    @stack('styles')
</head>

<body>

    @if(config('app.google_tag_manager_id'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('app.google_tag_manager_id') }}"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <div id="loader-div" style="display: none;">
        <div class="loader"></div>
    </div>

    <header class="header">
        <div class="container-fluid headbar">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="/">
                                    <img src="/frontend/locumkit-template/new-design-assets/img/logo.png"
                                        title="Locumkit" alt="Locumkit" width="80px"
                                        style="width: 60px; transition: all 0.4s ease 0s;">
                                </a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbarmid">
                                    <li class="@if (Route::currentRouteName() === 'index') active @endif"><a
                                            href="/">Home</a>
                                    </li>
                                    <li class="@if (Route::currentRouteName() === 'contact') active @endif"><a
                                            href="/contact">Contact Us</a>
                                    </li>

                                    <li class="@if (Route::currentRouteName() === 'accountancy') active @endif"><a href="/accountancy"
                                            title="Accountancy" alt="Luis">Accountancy</a></li>

                                    @guest
                                        <li><a href="javascript:void(0);" title="Log In" alt="Log In" data-toggle="modal"
                                                data-target="#login-form-model">Log In</a></li>
                                        <li class="@if (Route::currentRouteName() === 'register') active @endif"><a href="/register"
                                                title="Register" alt="Register">Register</a></li>
                                    @else
                                        @can('is_freelancer')
                                            <li><a href="/freelancer/dashboard" title="Dashboard" alt="Dashboard">My
                                                    Dashboard</a></li>
                                        @endcan
                                        @can('is_employer')
                                            <li><a href="/employer/dashboard" title="Dashboard" alt="Dashboard">My Dashboard</a>
                                            </li>
                                        @endcan
                                        <li>
                                            <a href="javascript:void(0);" onclick="$('#logout-form').submit();"
                                                title="Logout" alt="Logout"><i class="fa fa-power-off"
                                                    aria-hidden="true"></i></a>
                                        </li>
                                        <form style="display: none;" aria-hidden="true" action="/logout"
                                            id="logout-form" style="display: inline-block;" method="post" hidden>
                                            @csrf
                                        </form>
                                    @endguest

                                </ul>
                                <ul class="nav navbar-nav navbar-right hidden-xs">
                                    <a href="https://play.google.com/store/apps/details?id=com.FuduGo.Locumkit&amp;hl=en"
                                        target="_blank"><img
                                            src="/frontend/locumkit-template/new-design-assets/images/googleplay.png"
                                            class="Locumkit Google Play"></a>
                                    <a href="https://itunes.apple.com/gb/app/locumkit/id1362518464"
                                        target="_blank"><img
                                            src="/frontend/locumkit-template/new-design-assets/images/appstore.png"
                                            class="Locumkit App Store"></a>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <div class="modal fade-scale" id="sremail" tabindex="-1" role="dialog">
        <div class="modal-dialog cmnpopup bvpop" role="document">
            <div class="modal-content nobshadow col-md-12 col-sm-12 col-xs-12">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <div class="inbox" id="video-iframe">
                </div>
            </div>
        </div>
    </div>

    <div id="login-form-model" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"
                        onclick="close_dive('profession_question');">×</button>
                    <section class="signsc">
                        <div class="innerhead signlft">
                            <div class="container-fluid">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-right">

                                    <div class="center">
                                        <h1>Work the way you <br> want. Find opportunities <br> around you.</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="signrgt">
                            <div class="col-md-12 col-sm-12 col-xs-12 formlft">
                                <h2>Welcome back!</h2>

                                @if (isset($errors) && is_object($errors) && method_exists($errors, 'any') && $errors->any())
                                    <div class="alert alert-danger"
                                        style="margin-bottom: 15px; padding: 10px; border-radius: 5px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24;">
                                        <ul class="mb-0" style="margin-bottom: 0; padding-left: 20px;">
                                            @foreach (is_object($errors) && method_exists($errors, 'all') ? $errors->all() : [] as $error)
                                                @if($error)
                                                    <li>{{ $error }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('login') }}" method="post" id="signinform">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" style="font-weight:800;">Enter your email or
                                            username</label>
                                        <input type="text"
                                            class="form-control @error('login') is-invalid @enderror" id="login-email"
                                            name="login" placeholder="Enter username or email"
                                            value="{{ old('login') }}" required="">
                                        @error('login')
                                            <div class="invalid-feedback"
                                                style="display: block; color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" style="font-weight: 800;">Enter your password</label>
                                        <div class="input-group @error('password') is-invalid @enderror"
                                            style="border: 1px solid grey; display: flex; align-items: center; padding: 0px 10px;">
                                            <input type="password" style="border: none !important; box-shadow: none;"
                                                class="form-control" id="password" name="password"
                                                placeholder="Password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="toggle-password"
                                                    style="cursor: pointer;">
                                                    <i class="bi bi-eye-slash-fill"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback"
                                                style="display: block; color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>




                                    <div class="col-md-6 col-sm-6 col-xs-12 btnbx">
                                        <button type="submit"
                                            class="btn btn-default btn-1 lkbtn"><span>Login</span></button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 linkbx col-xs-12">
                                        <a href="{{ route('password.request') }}" class="simpllink">Forgot
                                            password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var icon = this.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            }
        });

        // Show login modal if there are validation errors
        @if (isset($errors) && is_object($errors) && method_exists($errors, 'any') && $errors->any())
            $(document).ready(function() {
                // Show the modal and prevent it from being hidden
                $('#login-form-model').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });

                // Prevent the modal from being hidden by other scripts
                $('#login-form-model').off('hide.bs.modal');

                // Only allow manual close via the X button
                $('#login-form-model .close').on('click', function() {
                    $('#login-form-model').modal('hide');
                });
            });
        @endif

        // Handle successful login (no errors) - ensure modal can close normally
        @if (!isset($errors) || !is_object($errors) || !method_exists($errors, 'any') || !$errors->any())
            $(document).ready(function() {
                // Allow normal modal behavior when there are no errors
                $('#login-form-model').modal({
                    backdrop: true,
                    keyboard: true
                });
            });
        @endif

        // Additional protection to prevent modal hiding when there are errors
        @if (isset($errors) && is_object($errors) && method_exists($errors, 'any') && $errors->any())
            $(document).on('hide.bs.modal', '#login-form-model', function(e) {
                // Only allow hiding if it's triggered by the close button
                if (!$(e.target).hasClass('manual-close-allowed')) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            });

            // Allow manual close when clicking the X button
            $(document).on('click', '#login-form-model .close', function() {
                $('#login-form-model').addClass('manual-close-allowed');
                $('#login-form-model').modal('hide');
            });
        @endif
    </script>
    @include('components.footer')
    <script type="text/javascript">
        (function($) {
            window.fnames = new Array();
            window.ftypes = new Array();
            fnames[0] = 'EMAIL';
            ftypes[0] = 'email';
            fnames[1] = 'FNAME';
            ftypes[1] = 'text';
            fnames[2] = 'LNAME';
            ftypes[2] = 'text';
        }(jQuery));
        var $mcj = jQuery.noConflict(true);
    </script>

    <!-- Newsletter Form Handler -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterForm = document.querySelector('.newsletter-form');
            const newsletterInput = document.getElementById('newsletter-email');
            const errorDiv = document.getElementById('newsletter-error');
            const successDiv = document.getElementById('newsletter-success');

            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    // Hide previous messages
                    if (errorDiv) errorDiv.style.display = 'none';
                    if (successDiv) successDiv.style.display = 'none';

                    // Basic email validation
                    if (newsletterInput) {
                        const email = newsletterInput.value.trim();
                        if (!email || !email.includes('@')) {
                            e.preventDefault();
                            if (errorDiv) {
                                errorDiv.textContent = 'Please enter a valid email address';
                                errorDiv.style.display = 'block';
                            }
                            return false;
                        }
                    }
                });

                // Handle form submission success/error from server
                @if(session('success'))
                    if (successDiv) {
                        successDiv.textContent = '{{ session('success') }}';
                        successDiv.style.display = 'block';
                        if (newsletterInput) newsletterInput.value = '';
                    }
                @endif

                @if(isset($errors) && $errors->has('email'))
                    if (errorDiv) {
                        errorDiv.textContent = '{{ $errors->first('email') }}';
                        errorDiv.style.display = 'block';
                    }
                @endif
            }
        });
    </script>


    <script type="text/javascript" id="cookieinfo" src="/frontend/locumkit-template/new-design-assets/js/cookieinfo.min.js"
        data-bg="#ffffff" data-fg="#000000" data-link="#00a8dd" data-cookie="CookieInfoScript" data-text-align="left"
        data-close-text="I Agree"></script>

    <div id="alert-modal" class="alert-modal modal fade">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Locumkit</h4>
                </div>
                <div class="modal-body">
                    <h3 id="alert-message"></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-alert btn btn-default" data-dismiss="modal"
                        onclick="window.location.reload()">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div id="alert-confirm-modal" class="alert-modal modal fade">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Locumkit</h4>
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

    <div id="manage-bank-income" class="modal fade financepopup" role="dialog">
        <div class="modal-dialog">
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
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
                                    <input type="text"
                                        class="form-control financein_bankdate readonly hasDatepicker"
                                        name="in_bankdate" id="in_bankdate" placeholder="dd/mm/yyyy" required="">
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
            <form action="" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Locumkit</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 pad0 financeform">
                            <div class="form-group" id="bank_date">
                                <div class="pull-left" style="display:none">
                                    <input name="ex_bank" id="modal-ex_bank" value="1" type="hidden">
                                </div>
                                <div class="input-group" id="for-displayex" style="display:block">
                                    <p>Please enter the date the transaction hit the bank</p>
                                    <input type="hidden" name="ex_bankid" id="ex_bankid">
                                    <input type="text"
                                        class="form-control financeex_bankdate readonly hasDatepicker"
                                        name="ex_bankdate" id="ex_bankdate" placeholder="dd/mm/yyyy" required="">
                                    <button type="submit" class="btn btn-info" id="expense-bank-btn"
                                        name="expense-bank-btn" value="expense-bank-btn">Submit</button>
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
    <a href="javascript:" id="return-to-top" class="onHoverWave" style="display: inline;"><i
            class="fa fa-arrow-up"></i></a>

    <script src="/frontend/locumkit-template/new-design-assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script src="/frontend/locumkit-template/new-design-assets/js/jquery-ui.js" type="text/javascript"></script>
    <script src="/frontend/locumkit-template/new-design-assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/frontend/locumkit-template/new-design-assets/js/animations.min.js" type="text/javascript"></script>
    <script src="/frontend/locumkit-template/new-design-assets/js/theme.js" type="text/javascript"></script>
    <script type="text/javascript" src="/frontend/locumkit-template/new-design-assets/js/jquery.dataTables.min.js"
        charset="UTF-8"></script>
    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: "yy-mm-dd",
                yearRange: '1950:2000', // specifying a hard coded year range
                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });
        });
    </script>

    <script type="text/jscript">
	    $("#loader-div").hide(100);
	</script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    {{-- Notification and error, success messages --}}
    @include('components.validation-notifications')

    @stack('scripts')

    <div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
    </div>
</body>

</html>
