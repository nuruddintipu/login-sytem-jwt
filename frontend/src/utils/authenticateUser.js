import {sendRequest} from "../services/sendRequest";

const isAuthenticated = async () => {
    const response = await sendRequest('auth.php', 'POST');

    if(response.success){
        return true;
    } else {
        return false;
    }
};
export default isAuthenticated;