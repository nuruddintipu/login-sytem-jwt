import {sendRequest} from "./sendRequest";

export const signUpUser = async (user) => {
    return await sendRequest('signUp.php', 'POST', {
        email: user.email,
        password: user.password
    });
};