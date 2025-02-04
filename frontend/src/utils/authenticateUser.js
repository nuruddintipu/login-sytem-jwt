import {sendRequest} from "../services/sendRequest";

const isAuthenticated = async () => {
    const response = await sendRequest('auth.php', 'POST');

    return !!response.success;
};
export default isAuthenticated;