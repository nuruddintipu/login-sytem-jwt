import {sendRequest} from "./sendRequest";

export const updatePassword = async (currentPassword, newPassword, confirmPassword) => {

    return await sendRequest('edit.php', 'PUT', {
        type: 'password',
        currentPassword: currentPassword,
        newPassword: newPassword,
        confirmPassword: confirmPassword
    });
};
