import {sendRequest} from "./sendRequest";

export const logoutUser = async () => {
    return await sendRequest('logout.php', 'POST');
};