@extends('layouts.user_profile_app')

@push('styles')
<style>
    /* Modern Accountancy Page Styles */
    .accountancy-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
    }

    .accountancy-hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .accountancy-hero p {
        font-size: 1.3rem;
        opacity: 0.95;
        margin-bottom: 0;
    }

    .accountancy-intro {
        padding: 60px 0;
        text-align: center;
        background: #f8f9fa;
    }

    .accountancy-intro h2 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .accountancy-intro h3 {
        font-size: 1.8rem;
        color: #555;
        font-weight: 400;
        margin-top: 30px;
    }

    .img-area {
        background: linear-gradient(to bottom, #f4f6f8 0%, #e9ecef 100%);
        padding: 60px 40px;
        margin: 40px 0;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .img-area img {
        width: 16%;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 5px;
    }

    .img-area img:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }

    .features-section {
        padding: 60px 0;
    }

    .feature-card {
        background: white;
        border-radius: 12px;
        padding: 0;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .feature-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }

    .feature-btn {
        width: 100%;
        padding: 20px 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px 12px 0 0;
        font-size: 1.2rem;
        font-weight: 600;
        text-align: left;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .feature-btn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        color: white;
    }

    .feature-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
    }

    .feature-btn::after {
        content: '+';
        font-size: 1.5rem;
        transition: transform 0.3s ease;
    }

    .feature-btn[aria-expanded="true"]::after {
        content: '−';
        transform: rotate(180deg);
    }

    .feature-content {
        padding: 30px;
        background: white;
    }

    .feature-content h3 {
        color: #333;
        font-size: 1.8rem;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .account-custom {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 0;
    }

    .feature-content img {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .benefits-section {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .benefits-section h2 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 40px;
        font-weight: 600;
        text-align: center;
    }

    .benefits-list {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .benefits-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .benefits-list li {
        padding: 12px 0;
        padding-left: 30px;
        position: relative;
        font-size: 1.05rem;
        color: #555;
        line-height: 1.6;
    }

    .benefits-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #28a745;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .why-section {
        padding: 60px 0;
        background: white;
    }

    .why-section h2 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 30px;
        font-weight: 600;
        text-align: center;
    }

    .why-section p {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #555;
        max-width: 900px;
        margin: 0 auto;
    }

    .working-process {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        position: relative;
        overflow: hidden;
    }

    .working-process .section-title h2 {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 50px;
        font-weight: 600;
    }

    .working-item {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        height: 100%;
    }

    .working-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .working-item img {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        object-fit: contain;
    }

    .working-item h5 {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .working-item p {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
        margin: 0;
    }

    .intro-area {
        padding: 60px 0;
    }

    @media (max-width: 768px) {
        .accountancy-hero h1 {
            font-size: 2rem;
        }

        .accountancy-hero p {
            font-size: 1.1rem;
        }

        .accountancy-intro h2 {
            font-size: 1.8rem;
        }

        .img-area {
            padding: 30px 20px;
        }

        .img-area img {
            width: 30%;
            margin: 5px;
        }

        .feature-btn {
            font-size: 1rem;
            padding: 15px 20px;
        }

        .feature-content {
            padding: 20px;
        }

        .benefits-section h2,
        .why-section h2,
        .working-process .section-title h2 {
            font-size: 1.8rem;
        }
    }

    .collapse {
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="accountancy-hero">
    <div class="container">
        <h1>Revolutionising the way locums manage their finances</h1>
        <p>On the go bookkeeping, invoice management and much more....</p>
    </div>
</div>

<!-- Intro Section -->
<div class="accountancy-intro">
    <div class="container">
        <h2>The first accounting management platform that interacts with your locum bookings</h2>
    </div>
</div>

<!-- Image Gallery Section -->
<div class="container">
    <div class="img-area text-center">
        <img class="fst-bg float-left" src="/frontend/locumkit-template/new-design-assets/images/account/L3.png" alt="Accounting feature">
        <img class="trd-bg float-left" src="/frontend/locumkit-template/new-design-assets/images/account/L2.jpg" alt="Accounting feature">
        <img class="snd-bg float-left" src="/frontend/locumkit-template/new-design-assets/images/account/L1.jpg" alt="Accounting feature">
        <img class="main-bg text-center" src="/frontend/locumkit-template/new-design-assets/images/account/Centre.png" alt="Locumkit Accounting">
        <img class="snd-bg float-right" src="/frontend/locumkit-template/new-design-assets/images/account/R1.jpg" alt="Accounting feature">
        <img class="trd-bg float-right" src="/frontend/locumkit-template/new-design-assets/images/account/R2.png" alt="Accounting feature">
        <img class="fst-bg float-right" src="/frontend/locumkit-template/new-design-assets/images/account/R3.png" alt="Accounting feature">
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="container">
        <!-- Locumkit Accounting -->
        <div class="feature-card">
            <button class="feature-btn" type="button" data-toggle="collapse" data-target="#demo1" aria-expanded="false" aria-controls="demo1">
                Locumkit Accounting
            </button>
            <div class="collapse" id="demo1">
                <div class="feature-content">
                    <div class="row">
                        <div class="col-md-6">
                            <img class="w-100" src="/frontend/locumkit-template/new-design-assets/images/account/Centre.png" alt="Locumkit Accounting">
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div>
                                <h3>Locumkit Accounting</h3>
                                <p class="account-custom">
                                    Are you starting in the world of locuming or are you just looking to switch Accountants?<br><br>
                                    Whether you trade as a sole trader or a limited company, Locumkit has all the expertise to free you to focus on your locuming. A bespoke service and platform built solely for locums by people who are locums themselves.<br><br>
                                    At Locumkit we aim to bring you up to date with the digital age - which means saying goodbye to those spreadsheets, notes & paperwork. The platform is very easy to use and interprets how well you are trading. You will need to provide some information but we have made this as effortless as possible.<br><br>
                                    Our accounting platform is available to use via desktop or through an app and comes with the support of a team who are specialists in locum accounting led by a dual qualified locum and chartered accountant. Register now for free and see how Locumkit can simplify your life.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Locumkit Invoice Management -->
        <div class="feature-card">
            <button class="feature-btn" type="button" data-toggle="collapse" data-target="#demo2" aria-expanded="false" aria-controls="demo2">
                Locumkit Invoice Management
            </button>
            <div class="collapse" id="demo2">
                <div class="feature-content">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="w-100">
                                <img class="w-75 mb-3" src="/frontend/locumkit-template/new-design-assets/images/account/area2-1.png" alt="Invoice Management">
                                <img class="area2-img2 d-block mb-3" src="/frontend/locumkit-template/new-design-assets/images/account/L3.png" alt="Invoice feature">
                                <img class="area2-img1 d-block" src="/frontend/locumkit-template/new-design-assets/images/account/area2-2.png" alt="Invoice feature">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div>
                                <h3>Locumkit Invoicing</h3>
                                <p class="account-custom">
                                    In addition to logging your income and expenses you can also send and manage your invoices. Most locums leave their invoicing for later, often last minute and it can turn out to become an unappealing task.<br><br>
                                    With our Open Invoices report you can track down who is yet to pay and also how overdue the invoice is (we even tell you if the invoice has been sent or not)<br><br>
                                    You can do this all on the move or even your lunch time, all within a few clicks.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Locumkit Reports -->
        <div class="feature-card">
            <button class="feature-btn" type="button" data-toggle="collapse" data-target="#demo3" aria-expanded="false" aria-controls="demo3">
                Locumkit Reports
            </button>
            <div class="collapse" id="demo3">
                <div class="feature-content">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div>
                                <h3>Locumkit Reports</h3>
                                <p class="account-custom">
                                    Track your trading patterns with Locumkit reporting. You can assess your trading patterns and make more informed business choices.<br><br>
                                    Always get an estimation of how much tax you will need to pay - With Locumkit cloud Accounting you can calculate how much dividends you can take from your company without falling foul of HMRC rules.<br><br>
                                    Our platform is customised to the exact needs of a locum, therefore enabling you to have better reporting and efficiency of locuming. Reports are live and instantly updated with the latest input. Over time you can even compare to see your month to month or even year to year trading comparisons.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <img class="area3-2 mb-3" src="/frontend/locumkit-template/new-design-assets/images/account/area3-0.png" alt="Reports">
                                <img class="area3-1" src="/frontend/locumkit-template/new-design-assets/images/account/area3-1.png" alt="Reports">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Locumkit Support -->
        <div class="feature-card">
            <button class="feature-btn" type="button" data-toggle="collapse" data-target="#demo4" aria-expanded="false" aria-controls="demo4">
                Locumkit Support
            </button>
            <div class="collapse" id="demo4">
                <div class="feature-content">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div>
                                <h3>Locumkit Support</h3>
                                <p class="account-custom">
                                    You have our team of Accountants with you at every step of the way. You can contact us via email, on the telephone, our social media platforms or even grab one of us a CET events as we go about getting our points also.<br><br>
                                    We will always keep you updated with the latest tax news, budgets, IR35 etc. and how it can affect you in your day to day trading.<br><br>
                                    We are not any Accountants. We pride ourselves on being specialist Accountants for Opticians. That's because our in-house Accounting team is led by someone who is just like you, a locum, so knows the industry inside out. In addition he is also a Chartered Accountant; knowing how to be the most tax efficient.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <img class="w-100 none-shadow" src="/frontend/locumkit-template/new-design-assets/images/account/area4.png" alt="Support">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Locumkit Mobile -->
        <div class="feature-card">
            <button class="feature-btn" type="button" data-toggle="collapse" data-target="#demo5" aria-expanded="false" aria-controls="demo5">
                Locumkit Mobile
            </button>
            <div class="collapse" id="demo5">
                <div class="feature-content">
                    <div class="row">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <img class="area5" src="/frontend/locumkit-template/new-design-assets/images/account/R3.png" alt="Mobile App">
                        </div>
                        <div class="col-md-9 d-flex align-items-center">
                            <div>
                                <h3>Locumkit Mobile</h3>
                                <p class="account-custom">
                                    You can access Locumkit via our app (available on iOS and Android).<br><br>
                                    Receive pop ups for income and expenses, which automatically update your tax figures.<br><br>
                                    Receive reminders for your upcoming locum bookings on the go.<br><br>
                                    All these features allow you to be in control of your finances 24/7 and save you the need to set time aside for any admin work.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="benefits-section">
    <div class="container">
        <h2>What you get with Locumkit Accounting</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="benefits-list">
                    <ul>
                        <li>Instant set up - Register and get going</li>
                        <li>24/7 access to our online bookkeeping tool</li>
                        <li>Unlimited accountancy support from industrial specialist</li>
                        <li>Add unlimited number of transaction (income, expenses)</li>
                        <li>Dashboard summarising your financial situation</li>
                        <li>Send invoices within a few clicks</li>
                        <li>Real time review of your tax liability</li>
                        <li>Up to date reports on how changes in the financial landscape can effect you as a locum</li>
                        <li>Review up to date trading patterns (Income by area/supplier, expenses by category/etc., no of days worked, etc.)</li>
                        <li>Search transactions by description</li>
                        <li>Instant update on invoicing report</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="benefits-list">
                    <ul>
                        <li>Assistance in setting up a limited company</li>
                        <li>Register with HMRC for Tax and NI</li>
                        <li>Personal Self-Assessment Tax Returns</li>
                        <li>Financial Accounts and Corporation Tax Returns</li>
                        <li>Pay tax on any profit</li>
                        <li>Set up a PAYE system for any employees & manage payroll</li>
                        <li>Register for VAT if necessary</li>
                        <li>Assistance with HMRC records check</li>
                        <li>Tax planning advise to maximise tax efficiency</li>
                        <li>Advanced Tax Planning (Capital Gains Tax including Entrepreneurs Relief, Inheritance Tax & Residency Tax)</li>
                        <li>Be prepared for Making Tax Digital</li>
                        <li>IR35 review</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Locumkit Section -->
<div class="why-section">
    <div class="container">
        <h2>Why Locumkit</h2>
        <p class="account-custom">
            Locumkit is a bespoke platform designed solely for locums. We continuously improve our platform from feedback from locums such as you. As we have been working with locums for years, we are confident in our services. In addition many of our staff are locums too so have the same working patterns as you, allowing us to perfect the platform.<br><br>
            Locumkit has been working with locums like yourself for some time, so we are confident we can offer you the very best. Add to that the fact we are locums ourself so have the same trading mechanism as you, we are confident in saying we are specialist for you.<br><br>
            Take the stress out of your all your admin duties, ultimately allowing you to focus on taking care of your patients. We at Locumkit are continuously looking to innovate and therefore ensure you have the latest technologies enabling you to work in the most cost effective and efficient manner.<br><br>
            We have our own in-house Accountants - there is no affiliation, no partnership. We help you right from start to finish, from your locum bookings right through to filing with HMRC and Companies House. Spend more quality time with friends & family. Do the things you want to do rather than dealing with tedious admin work.<br><br>
            If you are ready to get started with Locumkit Accounting then why not contact us. We serve nationwide so someone from our team will contact you to discuss your situation and the best plan for you.
        </p>
    </div>
</div>

<!-- Working Process Section -->
<div class="working-process">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center col-12">
                <h2 class="title">Locumkit simplifies Accounting</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-7">
                <div class="working-item item-1 text-center">
                    <p><img src="/frontend/locumkit-template/new-design-assets/images/account/doctor.png" alt="Bespoke for locums"></p>
                    <h5 class="title">Bespoke for locums</h5>
                    <p>Built on first-hand experience of locuming</p>
                    <div class="dot-1"><img src="/frontend/locumkit-template/new-design-assets/images/account/working-dot-1.png" alt="working"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-7">
                <div class="working-item item-2 text-center">
                    <p><img src="/frontend/locumkit-template/new-design-assets/images/account/cloud-account.png" alt="Cloud"></p>
                    <h5 class="title">Cloud</h5>
                    <p>Works wherever you are - download our Android or iOS app now</p>
                    <div class="dot-2"><img src="/frontend/locumkit-template/new-design-assets/images/account/working-dot-2.png" alt="working"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-7">
                <div class="working-item item-3 text-center">
                    <p><img src="/frontend/locumkit-template/new-design-assets/images/account/support.png" alt="Unlimited Support"></p>
                    <h5 class="title">Unlimited Support</h5>
                    <p>With you every step of the way</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-7">
                <div class="working-item item-4 text-center">
                    <p><img src="/frontend/locumkit-template/new-design-assets/images/account/relax.png" alt="Sit back and relax"></p>
                    <h5 class="title">Sit back and relax</h5>
                    <p>Let us take care of your accounting and admin work</p>
                    <div class="dot-3"><img src="/frontend/locumkit-template/new-design-assets/images/account/working-dot-1.png" alt="working"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
