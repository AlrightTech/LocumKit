import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom/client";
import Step1 from "./Step1";
import Step2 from "./Step2";
import Step3 from "./Step3";
import Step4Locum from "./Step4Locum";
import Step4Employer from "./Step4Employer";

import "react-tooltip/dist/react-tooltip.min.css";
import "react-autocomplete-input/dist/bundle.css";

/* {
    user.role
    user.profession
} */
function Register() {
    // Initialize step properly - ensure it's always a number, default to 1
    const initialStep = localStorage.getItem("step");
    const parsedStep = initialStep ? parseInt(initialStep, 10) : 1;
    const validStep = (!isNaN(parsedStep) && parsedStep > 0) ? parsedStep : 1;
    
    const [user, setUser] = useState(() => {
        try {
            const stored = localStorage.getItem("user");
            return stored ? JSON.parse(stored) : {};
        } catch (e) {
            return {};
        }
    });
    const [step, setStep] = useState(validStep);
    const [errors, setErrors] = useState({});

    useEffect(() => {
        localStorage.setItem("user", JSON.stringify(user));
    }, [user]);
    useEffect(() => {
        localStorage.setItem("step", step.toString());
        window.scrollTo(0, 140);
    }, [step]);

    useEffect(() => {
        // Access global ERROR_MESSAGES_BAG from window object
        const errorBag = window.ERROR_MESSAGES_BAG || ERROR_MESSAGES_BAG || {};
        
        if (errorBag && typeof errorBag == "object" && Object.keys(errorBag).length > 0) {
           
            let newErrors = {};
            Object.keys(errorBag).forEach((name) => {
                let arr = errorBag[name];
                // Extract first element if it's an array, otherwise use as is
                if (arr && typeof arr == "object" && Array.isArray(arr)) {
                    arr = arr[0] || arr;  // Get first error message from array
                }
                if (arr) {
                    newErrors[name] = arr;
                }
            });

            setErrors(newErrors);
            // Keep user on the step they were on when error occurred
            // Don't force back to step 2 if they're on step 3 or 4
            const currentStep = localStorage.getItem("step");
            if (currentStep && currentStep > 1) {
                setStep(parseInt(currentStep));
            } else {
                setStep(2); // Default to step 2 if no step is stored
            }
        }
        console.log("errors", errors);
        console.log("step", step);
        console.log("user", user);
        console.log("ERROR_MESSAGES_BAG", errorBag);
    }, []);

    return (
        <div className="container">
            <div className="row bgwhite inbox register-page">
                {step == 1 && <Step1 user={user} setUser={setUser} setStep={setStep} errors={errors} setErrors={setErrors} />}
                {step == 2 && <Step2 user={user} setUser={setUser} setStep={setStep} errors={errors} setErrors={setErrors} />}
                {step == 3 && <Step3 user={user} setUser={setUser} setStep={setStep} errors={errors} setErrors={setErrors} />}
                {user.role == 2 && step == 4 && <Step4Locum user={user} setUser={setUser} setStep={setStep} />}
                {user.role == 3 && step == 4 && <Step4Employer user={user} setUser={setUser} setStep={setStep} />}
            </div>
        </div>
    );
}

export default Register;

// Initialize React app when DOM is ready
function initializeRegisterApp() {
    const rootElement = document.getElementById("main-react-root");
    
    if (rootElement) {
        // Clear any existing content
        rootElement.innerHTML = '';
        
        const root = ReactDOM.createRoot(rootElement);
        root.render(
            <React.StrictMode>
                <Register />
            </React.StrictMode>
        );
        
        console.log("Registration form initialized successfully");
    } else {
        console.error("Registration form root element (#main-react-root) not found");
        // Retry after a short delay in case DOM isn't ready yet
        setTimeout(initializeRegisterApp, 100);
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeRegisterApp);
} else {
    // DOM is already ready
    initializeRegisterApp();
}
