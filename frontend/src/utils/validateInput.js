const PASSWORD_REGEX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$/;
const EMAIL_REGEX = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
export const validateInput = (formData, type = 'login') => {
    const errors = {};

    const emailError = validateEmail(formData.email);
    if(emailError) {
        errors.email = emailError;
    }

    if(!formData.password) {
        errors.password = 'Password is required';
    }

    if(type === 'signup') {
        if(!PASSWORD_REGEX.test(formData.password)) {
            errors.password = 'Password must be 8-16 characters. Must contain at least one uppercase letter, one lowercase letter, one number.';
            return errors;
        }

        if(!formData.confirmPassword){
            errors.confirmPassword = 'Please confirm your password';
        } else if(formData.password !== formData.confirmPassword) {
            errors.confirmPassword = 'Passwords do not match';
        }
    }

    return errors;
}

export const validateEmail = (email) => {
    if(!email){
        return "Email is required";
    } else if(!EMAIL_REGEX.test(email)) {
        return "Invalid email address";
    }

    return null;
}