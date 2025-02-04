import {Button} from "react-bootstrap";
import {useNavigate} from "react-router-dom";
import {getRoutePath} from "../routes/NamedLink";
import {logoutUser} from "../services/logoutUser";

const LogoutButton = () => {
    const navigate = useNavigate();
    const handleLogout = async () => {
        const response = await logoutUser();
        if(response.success){
            navigate(getRoutePath('LOGIN'));
        } else {
            console.error(response.message);
        }
    };
    return (
        <Button variant='primary' style={{fontSize: "0.8rem"}} onClick={handleLogout} className='mt-4 mx-2'>Logout</Button>
    );
};

export default LogoutButton;