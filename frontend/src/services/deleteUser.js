import {sendRequest} from "./sendRequest";

export const deleteUser = async (user) => {
    return await sendRequest('delete.php', 'DELETE',  {
        guid: user.guid,
        email: user.email,
        password: user.password
    });
}