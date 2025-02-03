import {Button} from "react-bootstrap";
import {useNavigate} from "react-router-dom";
import {getRoutePath} from "../routes/NamedLink";

const ChangePasswordButton = () => {
    const navigate = useNavigate();
    const handleNavigate = () => {
        navigate(getRoutePath('CHANGE_PASSWORD'));
    };
    return (
        <Button variant = 'primary' onClick={handleNavigate} className = 'mt-4 mx-2' style={{fontSize: "0.8rem"}}>Change Password</Button>
    );
};

export default ChangePasswordButton;