import {sendRequest} from "../services/sendRequest";

const isAuthenticated = async () => {
    const user = JSON.parse(localStorage.getItem('user'));
    if(user){

        console.log(user);
        const response = await sendRequest('auth.php', 'POST', {
            guid: user.guid,
            email: user.email
        });

        if(response.success){
            return true;
        } else {
            return false;
        }

    } else {
        return false;
    }

};
export default isAuthenticated;