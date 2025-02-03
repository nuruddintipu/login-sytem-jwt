import {sendRequest} from "./sendRequest";

export const updatePassword = async (user, currentPassword, newPassword, confirmPassword) => {

    return await sendRequest('edit.php', 'PUT', {
        type: 'password',
        guid: user.guid,
        currentPassword: currentPassword,
        newPassword: newPassword,
        confirmPassword: confirmPassword
    });
};
