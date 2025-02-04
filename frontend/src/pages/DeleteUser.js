import PageTemplate from "../components/PageTemplate";
import {Button, Form} from "react-bootstrap";
import {useEffect, useState} from "react";
import {validateEmail} from "../utils/validateInput";
import {deleteUser} from "../services/deleteUser";
import {useNavigate} from "react-router-dom";
import {getRoutePath} from "../routes/NamedLink";

export const DeleteUser = () => {
    const navigate = useNavigate();
    const [user, setUser] = useState({guid: "",email: "", password: ""});
    const [responseMessage, setResponseMessage] = useState("");

    useEffect(() => {
        setResponseMessage("");
    }, [user])

    const handleSubmit = async (event) => {
        event.preventDefault();
        const errors = validateEmail(user.email);
        if(errors){
            setResponseMessage(errors);
            return;
        }

        const result = await deleteUser(user);

        if(result.success){
            setResponseMessage(result.message);
            navigate(getRoutePath("LOGIN"));
        } else {
            setResponseMessage(result.message || "Something went wrong.");
        }
    };
    return (
        <PageTemplate pageTitle="Delete User">
            {responseMessage && <div className="alert alert-info">{responseMessage}</div>}

            <Form className={"delete-user-form"} onSubmit={handleSubmit}>
                <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label column="lg">Confirm your Email address</Form.Label>
                    <Form.Control
                        type="email"
                        placeholder="Enter your email"
                        onChange={(e) => setUser({...user, email: e.target.value})}
                        value={user.email}
                    />
                </Form.Group>

                <Form.Group className="mb-3" controlId="formBasicPassword">
                    <Form.Label column="lg">Confirm your Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="Password"
                        onChange={(e) => setUser({...user, password: e.target.value})}
                        value={user.password}
                    />
                </Form.Group>
                <Button variant="primary" type="submit">
                    Delete Account
                </Button>
            </Form>
        </PageTemplate>
    );
};