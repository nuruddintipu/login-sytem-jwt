import {Button} from "react-bootstrap";
import {useNavigate} from "react-router-dom";
import {getRoutePath} from "../routes/NamedLink";

const LogoutButton = () => {
    const navigate = useNavigate();
    const handleLogout = () => {
        localStorage.removeItem('user');
        navigate(getRoutePath('LOGIN'));
    };
    return (
        <Button variant='primary' style={{fontSize: "0.8rem"}} onClick={handleLogout} className='mt-4 mx-2'>Logout</Button>
    );
};

export default LogoutButton;