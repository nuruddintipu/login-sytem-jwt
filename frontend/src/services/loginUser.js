import {sendRequest} from "./sendRequest";

export const loginUser = async (formData) => {
    return sendRequest('login.php', 'POST',  {
        email: formData.email,
        password: formData.password
    });
};
