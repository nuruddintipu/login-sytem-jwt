import {Button, Form} from "react-bootstrap";
import {validateInput} from "../utils/validateInput";
import {useEffect, useRef, useState} from "react";
import {getRoutePath, NamedLink} from "../routes/NamedLink";
import handleInputChange from "../utils/handleInputChange";
import {useNavigate} from "react-router-dom";
import PageTemplate from "../components/PageTemplate";
import {loginUser} from "../services/loginUser";

function Login() {
    const userRef = useRef();
    const navigate = useNavigate();
    const [user, setUser] = useState({email: "", password: ""});
    const [errors, setErrors] = useState({});
    const [responseMessage, setResponseMessage] = useState("");


    const handleSubmit = async (event) => {
        event.preventDefault();
        const formErrors = validateInput(user, "login");
        if(Object.keys(formErrors).length > 0){
            setErrors(formErrors);
            return;
        }
        setErrors({});

       try{
           const result =await loginUser(user);
           if(result.success){
               localStorage.setItem("user", JSON.stringify(result.user));
               navigate(getRoutePath("HOME"));
           } else {
               setResponseMessage(result.message || "Something went wrong.");
               console.log(responseMessage);
           }
       } catch (error){
           setResponseMessage(error.message);
       }
    };

    useEffect(() => {
        userRef.current.focus();
    }, [])

    useEffect(() => {
        setErrors({});
        setResponseMessage("");
    }, [user])

    return (
        <PageTemplate pageTitle="Login">
            {responseMessage && <div className="alert alert-danger">{responseMessage}</div>}
            <Form className="login-form" onSubmit={handleSubmit}>
                <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label column="lg">Email Address</Form.Label>
                    <Form.Control
                        type="email"
                        ref={userRef}
                        placeholder="Enter email"
                        onChange={(event) => handleInputChange("email", event.target.value, setUser)}
                        value={user.email}
                        isInvalid={!!errors.email}
                    />

                    <Form.Control.Feedback type="invalid">
                        {errors.email}
                    </Form.Control.Feedback>
                </Form.Group>

                <Form.Group className="mb-3" controlId="formBasicPassword">
                    <Form.Label column="lg">Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="Password"
                        onChange={(event) => handleInputChange("password", event.target.value, setUser)}
                        value={user.password}
                        isInvalid={!!errors.password}
                    />
                    <Form.Control.Feedback type="invalid">
                        {errors.password}
                    </Form.Control.Feedback>
                </Form.Group>

                <Button variant="primary" type="submit" className="login-button">Login</Button>
            </Form>
            <p>
                Need an Account?
                <NamedLink routeName='SIGNUP'> Sign Up</NamedLink>
            </p>
        </PageTemplate>
    );
}

export default Login;