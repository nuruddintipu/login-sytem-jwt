import {Button} from "react-bootstrap";
import {useNavigate} from "react-router-dom";
import {getRoutePath} from "../routes/NamedLink";

const DeleteButton = () => {
    const navigate = useNavigate();

    const navigateToDeletePage = () => {
        navigate(getRoutePath('DELETE_ACCOUNT'));
    };
    return (
        <Button variant = 'primary' onClick={navigateToDeletePage} className = 'mt-4 mx-2' style={{fontSize: "0.8rem"}}>Delete User</Button>
    );
};

export default DeleteButton;