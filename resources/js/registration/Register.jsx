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
    const [user, setUser] = useState(JSON.parse(localStorage.getItem("user")) ?? {});
    const [step, setStep] = useState(localStorage.getItem("step") ?? 1);
    const [errors, setErrors] = useState({});

    useEffect(() => {
        localStorage.setItem("user", JSON.stringify(user));
    }, [user]);
    useEffect(() => {
        localStorage.setItem("step", step);
        window.scrollTo(0, 140);
    }, [step]);

    useEffect(() => {
        if (ERROR_MESSAGES_BAG && typeof ERROR_MESSAGES_BAG == "object" && Object.keys(ERROR_MESSAGES_BAG).length > 0) {
            let newErrors = {};
            Object.keys(ERROR_MESSAGES_BAG).forEach((name) => {
                let arr = ERROR_MESSAGES_BAG[name];
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

if (document.getElementById("main-react-root")) {
    const Index = ReactDOM.createRoot(document.getElementById("main-react-root"));

    Index.render(
        <React.StrictMode>
            <Register />
        </React.StrictMode>
    );
}
