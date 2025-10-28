import { Tooltip as ReactTooltip } from "react-tooltip";
import ReCAPTCHA from "react-google-recaptcha";
import TextInput from "react-autocomplete-input";
import { useEffect, useRef, useState } from "react";
import axios from "axios";

function Step2({ user, setUser, setStep, errors, setErrors }) {
    const login_controller = useRef();
    const email_controller = useRef();

    useEffect(() => {
        setUser({ ...user, g_recaptcha_response: null });
        if (window.grecaptcha) {
            window.grecaptcha.reset();
        }
        
        // Add fallback for browsers that might have issues with reCAPTCHA
        const checkRecaptchaSupport = () => {
            if (!window.grecaptcha) {
                console.warn('reCAPTCHA not loaded, checking browser compatibility');
                // Add a small delay to allow reCAPTCHA to load
                setTimeout(() => {
                    if (!window.grecaptcha) {
                        setErrors({ ...errors, g_recaptcha_response: "reCAPTCHA is not supported in this browser. Please try a different browser or contact support." });
                    }
                }, 3000);
            }
        };
        
        checkRecaptchaSupport();
    }, []);

    const validateFields = () => {
        let isValid = true;
        let newErrors = {};

        // First name validation
        if (!user.firstname || user.firstname.length < 2) {
            newErrors.firstname = "First name must be at least 2 characters.";
            isValid = false;
        }

        // Last name validation
        if (!user.lastname || user.lastname.length < 2) {
            newErrors.lastname = "Last name must be at least 2 characters.";
            isValid = false;
        }

        // Email validation
        if (!user.email) {
            newErrors.email = "Email address is required.";
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(user.email)) {
            newErrors.email = "Please enter a valid email address.";
            isValid = false;
        } else if (!user.is_email_valid) {
            newErrors.email = "This email address is already registered.";
            isValid = false;
        }

        // Username validation
        if (!user.username) {
            newErrors.username = "Username is required.";
            isValid = false;
        } else if (user.username.length < 6 || user.username.length > 20) {
            newErrors.username = "Username must be 6-20 characters long.";
            isValid = false;
        } else if (!/^[a-zA-Z0-9_-]+$/.test(user.username)) {
            newErrors.username = "Username can only contain letters, numbers, hyphens, and underscores.";
            isValid = false;
        } else if (!user.is_username_valid) {
            newErrors.username = "This username is already taken.";
            isValid = false;
        }

        // Password validation
        if (!user.password) {
            newErrors.password = "Password is required.";
            isValid = false;
        } else if (user.password.length < 8) {
            newErrors.password = "Password must be at least 8 characters.";
            isValid = false;
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/.test(user.password)) {
            newErrors.password = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            isValid = false;
        }

        // Password confirmation validation
        if (!user.password_confirmation) {
            newErrors.password_confirmation = "Please confirm your password.";
            isValid = false;
        } else if (user.password !== user.password_confirmation) {
            newErrors.password_confirmation = "Password confirmation does not match.";
            isValid = false;
        }

        // Store name validation (for employers)
        if (user.role == 3 && (!user.store || user.store.length < 5)) {
            newErrors.store = "Store name must be at least 5 characters.";
            isValid = false;
        }

        // Address validation
        if (!user.address || user.address.length < 10) {
            newErrors.address = "Address must be at least 10 characters.";
            isValid = false;
        }

        // City validation
        if (!user.city || user.city.length < 2) {
            newErrors.city = "Town/City must be at least 2 characters.";
            isValid = false;
        }

        // Postcode validation (UK format)
        if (!user.zip) {
            newErrors.zip = "Postcode is required.";
            isValid = false;
        } else if (!/^[A-Z]{1,2}[0-9R][0-9A-Z]? [0-9][ABD-HJLNP-UW-Z]{2}$/i.test(user.zip)) {
            newErrors.zip = "Please enter a valid UK postcode format.";
            isValid = false;
        }

        // Telephone validation (for employers)
        if (user.role == 3) {
            if (!user.telephone) {
                newErrors.telephone = "Telephone number is required for employers.";
                isValid = false;
            } else if (!/^(\+44|0)[0-9]{10}$/.test(user.telephone)) {
                newErrors.telephone = "Please enter a valid UK telephone number.";
                isValid = false;
            }
        }

        // Mobile validation (for locums)
        if (user.role == 2) {
            if (!user.mobile) {
                newErrors.mobile = "Mobile number is required for locums.";
                isValid = false;
            } else if (!/^(\+44|0)[0-9]{10}$/.test(user.mobile)) {
                newErrors.mobile = "Please enter a valid UK mobile number.";
                isValid = false;
            }
        }

        // CAPTCHA validation
        if (!user.g_recaptcha_response) {
            newErrors.g_recaptcha_response = "Please complete the CAPTCHA verification.";
            isValid = false;
        }

        setErrors(newErrors);

        if (isValid) {
            setStep(3);
        }
    };

    const handleEmailValidation = (email) => {
        const newUser = { ...user, email: email };
        setUser(newUser);

        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            if (email_controller.current) {
                email_controller.current.abort();
            }
            email_controller.current = new AbortController();
            axios
                .post(
                    REGISTRATION_VALIDATION_URI,
                    {
                        check_type: "user_email",
                        email: email,
                    },
                    {
                        headers: {
                            "X-CSRF-TOKEN": CSRF_TOKEN,
                        },
                        signal: email_controller.current.signal,
                    }
                )
                .then((res) => {
                    if (res.data.email_exists == true) {
                        setErrors({ ...errors, email: "This email address is already registered." });
                        setUser({ ...newUser, is_email_valid: false });
                    } else {
                        setErrors({ ...errors, email: "" });
                        setUser({ ...newUser, is_email_valid: true });
                    }
                })
                .catch((err) => { });
        } else if (email.trim() === "") {
            setErrors({ ...errors, email: "Email address is required." });
        } else {
            setErrors({ ...errors, email: "Please enter a valid email address." });
        }
    };

    const onGoogleRecaptchaChange = (value) => {
        setUser({ ...user, g_recaptcha_response: value });
    };

    const handleUsernameValidation = (username) => {
        const newUser = { ...user, username: username };
        setUser(newUser);
        
        if (username.length < 6) {
            setErrors({ ...errors, username: "Username must be at least 6 characters." });
            return;
        }
        if (username.length > 20) {
            setErrors({ ...errors, username: "Username must not exceed 20 characters." });
            return;
        }
        if (!/^[a-zA-Z0-9_-]+$/.test(username)) {
            setErrors({ ...errors, username: "Username can only contain letters, numbers, hyphens, and underscores." });
            return;
        }
        
        if (login_controller.current) {
            login_controller.current.abort();
        }
        login_controller.current = new AbortController();
        axios
            .post(
                REGISTRATION_VALIDATION_URI,
                {
                    check_type: "login_check",
                    login: username,
                },
                {
                    headers: {
                        "X-CSRF-TOKEN": CSRF_TOKEN,
                    },
                    signal: login_controller.current.signal,
                }
            )
            .then((res) => {
                if (res.data.login_exists == true) {
                    setErrors({ ...errors, username: "This username is already taken." });
                    setUser({ ...newUser, is_username_valid: false });
                } else {
                    setErrors({ ...errors, username: "" });
                    setUser({ ...newUser, is_username_valid: true });
                }
            })
            .catch((err) => { });
    };

    const getFieldClassName = (fieldName) => {
        const hasError = errors[fieldName];
        const hasValue = user[fieldName] && user[fieldName].length > 0;
        
        if (hasError) return 'form-control input-text width-100 error';
        if (hasValue && !hasError) return 'form-control input-text width-100 success';
        return 'form-control input-text width-100';
    };

    const renderValidationSummary = () => {
        const errorCount = Object.keys(errors).filter(key => errors[key]).length;
        
        if (errorCount === 0) return null;
        
        return (
            <div className="validation-summary">
                <h6>Please fix the following {errorCount} error{errorCount > 1 ? 's' : ''}:</h6>
                <ul>
                    {Object.entries(errors).map(([field, message]) => {
                        if (!message) return null;
                        return <li key={field}>{message}</li>;
                    })}
                </ul>
            </div>
        );
    };

    const handleConfirmPasswordValidation = (password_confirmation) => {
        setUser({ ...user, password_confirmation: password_confirmation });
        if (user.password != password_confirmation) {
            setErrors({ ...errors, password_confirmation: "Password does not match." });
        } else {
            setErrors({ ...errors, password_confirmation: "" });
        }
    };

    return (
        <div id="step2" className="details-style step2-personal-info">
            <div className="col-md-12">
                <h2 className="reg-step-title text-center">
                    <span>Personal information</span>
                </h2>
            </div>
            
            {renderValidationSummary()}
            
            <div className="col-md-12 pad0 form-group">
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="email">
                        First name<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <input
                        className={getFieldClassName('firstname')}
                        type="text"
                        name="fname"
                        id="fname"
                        minLength={2}
                        maxLength={255}
                        autoComplete="off"
                        onChange={(e) => setUser({ ...user, firstname: e.target.value.trim() })}
                        value={user.firstname ?? ""}
                        placeholder="Enter your first name"
                    />
                    {errors && errors.firstname && (
                        <div className="css_error" id="fname_error">
                            {errors.firstname}
                        </div>
                    )}
                </div>
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="lname">
                        Last name<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <input
                        className={getFieldClassName('lastname')}
                        type="text"
                        name="lname"
                        id="lname"
                        minLength={2}
                        maxLength={255}
                        autoComplete="off"
                        onChange={(e) => setUser({ ...user, lastname: e.target.value.trim() })}
                        value={user.lastname ?? ""}
                        placeholder="Enter your last name"
                    />
                    {errors && errors.lastname && (
                        <div className="css_error" id="lname_error">
                            {errors.lastname}
                        </div>
                    )}
                </div>
            </div>
            <div className="col-md-12 pad0 form-group">
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="email">
                        Your email<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <input className={getFieldClassName('email')} type="email" onChange={(e) => handleEmailValidation(e.target.value.trim())} name="email" id="email" autoComplete="off" value={user.email ?? ""} placeholder="Enter your email address" />
                    {errors && errors.email && (
                        <div className="css_error" id="email_error">
                            {errors.email}
                        </div>
                    )}
                </div>
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="login">
                        Username<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <input
                        className={getFieldClassName('username')}
                        type="text"
                        onChange={(e) => handleUsernameValidation(e.target.value.trim())}
                        name="login"
                        id="login"
                        autoComplete="off"
                        minLength={6}
                        maxLength={20}
                        value={user.username ?? ""}
                        placeholder="Enter username (6-20 characters, letters, numbers, hyphens, underscores only)"
                    />
                    {errors && errors.username && (
                        <div className="css_error" id="login_error">
                            {errors.username}
                        </div>
                    )}
                    <div className="field-help-text">
                        Username must be 6-20 characters long and can only contain letters, numbers, hyphens (-), and underscores (_).
                    </div>
                </div>
            </div>
            <div className="col-md-12 pad0 form-group">
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="login">
                        Password<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <div style={{ position: 'relative' }}>
                        <input 
                            className="form-control input-text width-100" 
                            type={user.showPassword ? "text" : "password"} 
                            name="password" 
                            id="upassword" 
                            onChange={(e) => setUser({ ...user, password: e.target.value.trim() })} 
                            value={user.password ?? ""} 
                        />
                        <button
                            type="button"
                            style={{
                                position: 'absolute',
                                right: '10px',
                                top: '50%',
                                transform: 'translateY(-50%)',
                                background: 'none',
                                border: 'none',
                                cursor: 'pointer',
                                fontSize: '16px',
                                color: '#666'
                            }}
                            onClick={() => setUser({ ...user, showPassword: !user.showPassword })}
                        >
                            <i className={`fa ${user.showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                        </button>
                    </div>
                    {user.password && (
                        <div style={{ marginTop: '5px', fontSize: '12px' }}>
                            <div style={{ display: 'flex', alignItems: 'center', marginBottom: '2px' }}>
                                <span style={{ color: user.password.length >= 8 ? '#28a745' : '#dc3545', marginRight: '5px' }}>
                                    <i className={`fa ${user.password.length >= 8 ? 'fa-check' : 'fa-times'}`}></i>
                                </span>
                                At least 8 characters
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', marginBottom: '2px' }}>
                                <span style={{ color: /[A-Z]/.test(user.password) ? '#28a745' : '#dc3545', marginRight: '5px' }}>
                                    <i className={`fa ${/[A-Z]/.test(user.password) ? 'fa-check' : 'fa-times'}`}></i>
                                </span>
                                One uppercase letter
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', marginBottom: '2px' }}>
                                <span style={{ color: /[a-z]/.test(user.password) ? '#28a745' : '#dc3545', marginRight: '5px' }}>
                                    <i className={`fa ${/[a-z]/.test(user.password) ? 'fa-check' : 'fa-times'}`}></i>
                                </span>
                                One lowercase letter
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', marginBottom: '2px' }}>
                                <span style={{ color: /\d/.test(user.password) ? '#28a745' : '#dc3545', marginRight: '5px' }}>
                                    <i className={`fa ${/\d/.test(user.password) ? 'fa-check' : 'fa-times'}`}></i>
                                </span>
                                One number
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', marginBottom: '2px' }}>
                                <span style={{ color: /[@$!%*?&]/.test(user.password) ? '#28a745' : '#dc3545', marginRight: '5px' }}>
                                    <i className={`fa ${/[@$!%*?&]/.test(user.password) ? 'fa-check' : 'fa-times'}`}></i>
                                </span>
                                One special character (@$!%*?&)
                            </div>
                        </div>
                    )}
                    {errors && errors.password && (
                        <div className="css_error" id="upassword_error">
                            {errors.password}
                        </div>
                    )}
                </div>
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="login">
                        Confirm password<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <div style={{ position: 'relative' }}>
                        <input
                            className="form-control input-text width-100"
                            type={user.showConfirmPassword ? "text" : "password"}
                            name="password_confirmation"
                            id="cpassword"
                            onChange={(e) => handleConfirmPasswordValidation(e.target.value.trim())}
                            value={user.password_confirmation ?? ""}
                        />
                        <button
                            type="button"
                            style={{
                                position: 'absolute',
                                right: '10px',
                                top: '50%',
                                transform: 'translateY(-50%)',
                                background: 'none',
                                border: 'none',
                                cursor: 'pointer',
                                fontSize: '16px',
                                color: '#666'
                            }}
                            onClick={() => setUser({ ...user, showConfirmPassword: !user.showConfirmPassword })}
                        >
                            <i className={`fa ${user.showConfirmPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                        </button>
                    </div>
                    {errors && errors.password_confirmation && (
                        <div className="css_error" id="cpassword_error">
                            {errors.password_confirmation}
                        </div>
                    )}
                </div>
            </div>
            <div className="col-md-12 pad0 form-group">
                {user.role == 2 ? (
                    <div className="col-md-6 col-sm-6">
                        <label htmlFor="company" id="company_txt">
                            Company name
                            <p
                                id="my-company-element"
                                style={{ display: "inline", paddingInlineStart: "10px", cursor: "pointer" }}
                                data-tooltip-content="Question only applicable if you work through a registered company. Not applicable if you are working as a self employed freelancer."
                            >
                                <i className="fa fa-question-circle" aria-hidden="true"></i>
                            </p>
                        </label>
                        <input
                            className="form-control input-text width-100"
                            type="text"
                            name="company"
                            id="company"
                            autoComplete="off"
                            onChange={(e) => setUser({ ...user, company: e.target.value })}
                            value={user.company ?? ""}
                            placeholder="Enter company name (optional)"
                        />
                    </div>
                ) : (
                    <div className="col-md-6 col-sm-6">
                        <label htmlFor="conpany" id="company_txt">
                            Store Name <i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                            <p
                                id="my-store-element"
                                style={{ display: "inline", paddingInlineStart: "10px", cursor: "pointer" }}
                                data-tooltip-content="If you manage more than one store and would like to register multiple stores with Locumkit,you will have the option to do so later in the registration process. Please enter here, what you consider to be your main store from the Group."
                            >
                                <i className="fa fa-question-circle" aria-hidden="true"></i>
                            </p>
                        </label>
                        <input className="form-control input-text width-100" type="text" name="store" id="store" autoComplete="off" onChange={(e) => setUser({ ...user, store: e.target.value })} value={user.store ?? ""} placeholder="Enter store name" />
                        {errors && errors.store && (
                            <div className="css_error" id="store_error">
                                {errors.store}
                            </div>
                        )}
                    </div>
                )}

                <div className="col-md-6 col-sm-6">
                    <label htmlFor="address">
                        Address<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <input
                        className="form-control input-text width-100"
                        type="text"
                        name="address"
                        id="address"
                        autoComplete="off"
                        onChange={(e) => setUser({ ...user, address: e.target.value })}
                        value={user.address ?? ""}
                        placeholder="Enter your full address"
                    />
                    {errors && errors.address && (
                        <div className="css_error" id="address_error">
                            {errors.address}
                        </div>
                    )}
                </div>
            </div>
            <div className="col-md-12 pad0 form-group">
                <div className="col-md-6 col-sm-6 city-selector">
                    <label htmlFor="login">
                        Town/City<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <TextInput
                        trigger={[""]}
                        className="form-control input-text width-100 ui-autocomplete-input"
                        Component="input"
                        options={AVAILABLE_TAGS}
                        onChange={(value) => setUser({ ...user, city: value })}
                        defaultValue={user.city}
                        value={user.city}
                        maxLength={30}
                    />
                    {errors && errors.city && (
                        <div className="css_error" id="city_error">
                            {errors.city}
                        </div>
                    )}
                </div>
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="login">
                        Postcode here<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                    </label>
                    <input
                        className="form-control input-text width-100"
                        type="text"
                        name="zip"
                        id="zip"
                        autoComplete="off"
                        onChange={(e) => setUser({ ...user, zip: e.target.value.toUpperCase() })}
                        value={user.zip ?? ""}
                        placeholder="Enter UK postcode (e.g., SW1A 1AA)"
                        style={{ textTransform: 'uppercase' }}
                    />
                    {errors && errors.zip && (
                        <div className="css_error" id="zip_error">
                            {errors.zip}
                        </div>
                    )}
                    <div className="field-help-text">
                        Enter a valid UK postcode format (e.g., SW1A 1AA, M1 1AA, B33 8TH).
                    </div>
                </div>
            </div>
            <div className="col-md-12 pad0 form-group">
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="telephone" id="telephone_txt">
                        {user.role == 2 ? (
                            <>Home Telephone</>
                        ) : (
                            <>
                                Store Telephone<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                            </>
                        )}
                    </label>
                    <input
                        className="form-control input-text width-100"
                        type="tel"
                        step={1}
                        name="telephone"
                        id="telephone"
                        autoComplete="off"
                        onChange={(e) => setUser({ ...user, telephone: e.target.value.trim() })}
                        value={user.telephone ?? ""}
                        placeholder={user.role == 2 ? "Enter home telephone (optional)" : "Enter store telephone (e.g., 020 1234 5678)"}
                    />
                    {errors && errors.telephone && (
                        <div className="css_error" id="telephone_error">
                            {errors.telephone}
                        </div>
                    )}
                </div>
                <div className="col-md-6 col-sm-6">
                    <label htmlFor="mobile" id="mobile_number">
                        {user.role == 2 ? (
                            <>
                                Mobile number<i className="fa fa-asterisk required-stars required-stars" aria-hidden="true"></i>
                            </>
                        ) : (
                            <>Mobile number(optional)</>
                        )}
                    </label>
                    <input
                        className="form-control input-text width-100"
                        type="tel"
                        step={1}
                        name="mobile"
                        id="mobile"
                        onChange={(e) => setUser({ ...user, mobile: e.target.value.trim() })}
                        value={user.mobile ?? ""}
                        placeholder={user.role == 2 ? "Enter mobile number (e.g., 07123 456789)" : "Enter mobile number (optional)"}
                    />
                    {errors && errors.mobile && (
                        <div className="css_error" id="mobile_error">
                            {errors.mobile}
                        </div>
                    )}
                </div>
            </div>
            <div className="col-md-12 pad0 form-group text-center" style={{ marginTop: "20px", display: "flex", justifyContent: "center", alignItems: "center", flexDirection: "column" }}>
                <div className="recaptcha-container">
                    <ReCAPTCHA 
                        sitekey={GOOGLE_RECAPTCHA_SITE_KEY} 
                        onChange={onGoogleRecaptchaChange}
                        size="compact"
                        theme="light"
                        onErrored={() => {
                            console.error('reCAPTCHA error occurred');
                            setErrors({ ...errors, g_recaptcha_response: "reCAPTCHA failed to load. Please refresh the page and try again." });
                        }}
                        onExpired={() => {
                            console.warn('reCAPTCHA expired');
                            setUser({ ...user, g_recaptcha_response: null });
                            setErrors({ ...errors, g_recaptcha_response: "reCAPTCHA expired. Please complete it again." });
                        }}
                    />
                </div>
                {errors && errors.g_recaptcha_response && (
                    <span className="css_error" id="g_recaptcha_response_error">
                        {errors.g_recaptcha_response}
                    </span>
                )}
            </div>
            <div className="col-md-12 pad0 form-group text-center" style={{ marginTop: "20px" }}>
                <span className="formlft">
                    <button type="button" className="btn btn-default btn-1 lkbtn" onClick={(e) => setStep(1)}>
                        <span>
                            <i className="fa fa-angle-double-left" aria-hidden="true"></i> &nbsp;&nbsp;Back
                        </span>
                    </button>
                </span>
                <span className="formlft">
                    <button type="button" className="btn btn-default btn-1 lkbtn" id="qus_next" onClick={validateFields}>
                        <span>
                            Next &nbsp;&nbsp;<i className="fa fa-angle-double-right" aria-hidden="true"></i>
                        </span>
                    </button>
                </span>
            </div>

            <ReactTooltip style={{ maxWidth: "300px" }} anchorId="my-company-element" />
            <ReactTooltip style={{ maxWidth: "300px" }} anchorId="my-store-element" />
        </div>
    );
}

export default Step2;
