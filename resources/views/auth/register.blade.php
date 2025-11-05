@extends('layouts.app')
@push('styles')
    <style>
        select.input-text.width-100 {
            color: black !important;
        }

        .form-control {
            color: black !important;
        }
        .formlft{
            padding: 5px 5px !important;
        }
        .lkbtn-1 {
            margin:5px !important;
        }
        .col-md-12.btn-img.paypalbtnn {
    text-align: center;
    margin-bottom: 100px;
    display: flex !important;
    justify-content: center !important;
    gap: 25px !important;
}
@media(max-width:600px){
    .col-md-12.btn-img.paypalbtnn{
        padding-left: 15px !important;
        padding-right: 15px !important;
    }
}

        /* Enhanced validation styles */
        .form-control.error {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
        
        .form-control.success {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
        }
        
        .css_error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }
        
        .password-strength-indicator {
            margin-top: 5px;
            font-size: 12px;
        }
        
        .password-strength-indicator .strength-item {
            display: flex;
            align-items: center;
            margin-bottom: 2px;
        }
        
        .password-strength-indicator .strength-item i {
            margin-right: 5px;
            width: 12px;
        }
        
        .required-stars {
            color: #dc3545;
        }
        
        .field-help-text {
            font-size: 11px;
            color: #6c757d;
            margin-top: 2px;
        }
        
        .validation-summary {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        
        .validation-summary h6 {
            margin: 0 0 5px 0;
            font-weight: bold;
        }
        
        .validation-summary ul {
            margin: 0;
            padding-left: 20px;
        }
        
        .validation-summary li {
            margin-bottom: 2px;
        }

        /* reCAPTCHA responsive styles */
        .g-recaptcha {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        /* Responsive reCAPTCHA scaling */
        @media (max-width: 575px) {
            .g-recaptcha {
                transform: scale(0.77);
                transform-origin: 0 0;
            }
        }

        @media (max-width: 480px) {
            .g-recaptcha {
                transform: scale(0.65);
                transform-origin: 0 0;
            }
        }

        @media (max-width: 360px) {
            .g-recaptcha {
                transform: scale(0.55);
                transform-origin: 0 0;
            }
        }

        /* Cross-browser compatibility for reCAPTCHA */
        .g-recaptcha > div {
            margin: 0 auto;
        }

        /* Ensure reCAPTCHA works in all browsers */
        .recaptcha-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 78px;
            width: 100%;
        }
        
    </style>
@endpush
@section('content')
    <section class="innerhead">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 bannercont animate zoomIn text-center" data-anim-type="zoomIn" data-anim-delay="300">
                        <div class="center">
                            <h1>Register</h1>
                        </div>
                        <div class="breadcrum-sitemap">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="javascript:void(0);">Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="innerlayout" id="main-react-root">

    </section>
@endsection

@push('scripts')

    <script>
        const questions = @json($questions ?? []);
        const roles = @json($roles ?? []);
        const professions = @json($professions ?? []);
        const GOOGLE_RECAPTCHA_SITE_KEY = `{{ config('app.google_recaptcha_site_key') ?? '' }}`;
        const AVAILABLE_TAGS = @json($site_towns_available_tags ?? []);
        const REGISTRATION_VALIDATION_URI = `{{ url('/ajax/registration-info-check') }}`;
        const CSRF_TOKEN = `{{ csrf_token() }}`;
        const REGISTER_FORM_URI = `{{ url('/register') }}`;
        const ERROR_MESSAGES_BAG = @json((isset($errors) && is_object($errors) && method_exists($errors, 'jsonSerialize')) ? $errors->jsonSerialize() : []);
    </script>

    <script>
        function save_list() {
            var store_list = $("input[name*=store_list]:checked");
            let site_town_ids = [];
            store_list.each(function() {
                site_town_ids.push($(this).val());
            });
            localStorage.setItem("site_town_ids", JSON.stringify(site_town_ids));

            $("#getlist-section").hide(1000);
            $('.modal-backdrop').hide(1000);
        }
    </script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   <!-- mix run app.js and build output is in public/build/register.js -->
   <script src="{{ mix('build/register.js') }}"></script>
@endpush
