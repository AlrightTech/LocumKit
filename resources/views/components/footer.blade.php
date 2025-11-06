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

        .footer-title {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .newsletter-input-group {
            flex-direction: column;
            border-radius: 10px;
        }

        .newsletter-btn {
            border-radius: 0 0 10px 10px;
            width: 100%;
            justify-content: center;
        }

        .newsletter-input {
            border-radius: 10px 10px 0 0;
        }

        .social-icons {
            justify-content: center;
        }
    }
</style>

<footer class="footer-modern animate fadeInUp" data-anim-type="fadeInUp" data-anim-delay="800">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <!-- Newsletter & About Section -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-md-0">
                    <div class="footer-widget">
                        <div class="footer-logo-modern">
                            <img src="{{ asset('frontend/locumkit-template/img/logo.png') }}" title="Locumkit" alt="Locumkit" width="130px">
                        </div>
                        <p class="footer-description">Stay updated with the latest news, job opportunities, and industry insights. Subscribe to our newsletter today.</p>
                        
                        <!-- Newsletter Form -->
                        <div class="newsletter-form-modern">
                            <form action="{{ route('subscribed-news-letter') }}" method="post" class="newsletter-form" novalidate="novalidate">
                                @csrf
                                <div class="newsletter-input-group">
                                    <input type="email" name="email" class="newsletter-input" id="newsletter-email" 
                                           placeholder="Enter your email" aria-required="true" required>
                                    <button type="submit" class="newsletter-btn">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                        <span>Subscribe</span>
                                    </button>
                                </div>
                                <div id="newsletter-responses" class="newsletter-responses">
                                    <div class="newsletter-error" id="newsletter-error" style="display:none"></div>
                                    <div class="newsletter-success" id="newsletter-success" style="display:none"></div>
                                </div>
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    <input type="text" name="b_41b543e3133f958b3c58df8b5_fb441ef5f1" tabindex="-1" value="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Useful Links -->
                <div class="col-lg-2 col-md-3 col-sm-6 mb-4 mb-md-0">
                    <div class="footer-widget">
                        <h5 class="footer-title">Useful Links</h5>
                        <ul class="footer-links">
                            <li><a href="/about"><i class="fa fa-angle-right" aria-hidden="true"></i> About Us</a></li>
                            <li><a href="/contact"><i class="fa fa-angle-right" aria-hidden="true"></i> Contact Us</a></li>
                            <li><a href="/term-condition"><i class="fa fa-angle-right" aria-hidden="true"></i> Terms of Use</a></li>
                            <li><a href="/privacy-policy"><i class="fa fa-angle-right" aria-hidden="true"></i> Privacy Policy</a></li>
                            <li><a href="/sitemap"><i class="fa fa-angle-right" aria-hidden="true"></i> Sitemap</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="col-lg-3 col-md-3 col-sm-6 mb-4 mb-md-0">
                    <div class="footer-widget">
                        <h5 class="footer-title">Recent Posts</h5>
                        <ul class="footer-posts">
                            @php
                                try {
                                    $latest_blogs = \App\Models\Blog::where('status', 'published')
                                        ->orderBy('created_at', 'desc')
                                        ->limit(3)
                                        ->get();
                                } catch (\Exception $e) {
                                    $latest_blogs = collect([]);
                                }
                            @endphp
                            @if(!empty($latest_blogs) && $latest_blogs->count() > 0)
                                @foreach ($latest_blogs as $blog)
                                    <li>
                                        <a href="/blog/{{ $blog->slug }}" target="_blank" class="post-title">{{ $blog->title }}</a>
                                        <span class="post-date">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ $blog->created_at->format('d M Y') }}
                                        </span>
                                    </li>
                                @endforeach
                            @else
                                <li class="no-posts">No recent posts available</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Contact & Social -->
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h5 class="footer-title">Get In Touch</h5>
                        <ul class="footer-contact">
                            <li>
                                <a href="tel:07452998238" class="contact-item">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>07452 998 238</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:admin@locumkit.com" class="contact-item">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>admin@locumkit.com</span>
                                </a>
                            </li>
                        </ul>
                        
                        <!-- Social Media Icons -->
                        <div class="footer-social">
                            <h6 class="social-title">Follow Us</h6>
                            <ul class="social-icons">
                                <li>
                                    <a href="https://www.facebook.com/share/186z1L65Xg/" target="_blank" 
                                       class="social-icon facebook" aria-label="Facebook">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/company/locumkit/" target="_blank" 
                                       class="social-icon linkedin" aria-label="LinkedIn">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright Section -->
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="copyright-text">
                        Copyright © {{ today()->format('Y') }} <strong>Locumkit</strong> - All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Newsletter Form Script -->
<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
<script>
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
<script>
    $(document).ready(function() {
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var email = form.find('#newsletter-email').val();
            var errorDiv = form.find('#newsletter-error');
            var successDiv = form.find('#newsletter-success');
            
            // Reset messages
            errorDiv.hide().text('');
            successDiv.hide().text('');
            
            // Basic validation
            if (!email || !email.includes('@')) {
                errorDiv.text('Please enter a valid email address.').show();
                return;
            }
            
            // Submit form via AJAX
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success || response.message) {
                        successDiv.text(response.message || 'Thank you for subscribing!').show();
                        form[0].reset();
                    } else {
                        errorDiv.text('Subscription failed. Please try again.').show();
                    }
                },
                error: function(xhr) {
                    var errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                    errorDiv.text(errorMessage).show();
                }
            });
        });
    });
</script>
