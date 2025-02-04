import PageTemplate from "../components/PageTemplate";
import {Button, Form} from "react-bootstrap";
import {useEffect, useState} from "react";
import {updatePassword} from "../services/updatePassword";

const ChangePassword = () => {
    const [currentPassword, setCurrentPassword] = useState("");
    const [password, setPassword] = useState("");
    const [confirmPassword, setConfirmPassword] = useState("");
    const [responseMessage, setResponseMessage] = useState("");

    const handleSubmit = async (event) => {
        event.preventDefault();


        const apiResponse = await updatePassword(currentPassword, password, confirmPassword);
        setResponseMessage(apiResponse.message);
    }

    useEffect(() => {
      setResponseMessage("");
    }, [currentPassword, password, confirmPassword]);
    return (
        <PageTemplate pageTitle="Change Password">
            {responseMessage && <div className="alert alert-info">{responseMessage}</div>}
            <Form className="sign-up-form" onSubmit={handleSubmit}>
                <Form.Group className="mb-3" controlId="formBasicEmail">
                    <Form.Label column="lg">Current Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="Current Password"
                        onChange={(e) => setCurrentPassword(e.target.value)}
                        value={currentPassword}
                    />
                </Form.Group>

                <Form.Group className="mb-3" controlId="formBasicPassword">
                    <Form.Label column="lg">New Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="New Password"
                        onChange={(e) => setPassword(e.target.value)}
                        value={password}
                    />
                </Form.Group>

                <Form.Group className="mb-3" controlId="formConfirmPassword">
                    <Form.Label column="lg">Confirm Password</Form.Label>
                    <Form.Control
                        type="password"
                        placeholder="Confirm New Password"
                        onChange={(e) => setConfirmPassword(e.target.value)}
                        value={confirmPassword}
                    />
                </Form.Group>

                <Button variant="primary" type="submit" className="sign-up-button">Save Changes</Button>
            </Form>
        </PageTemplate>
    );
};

export default ChangePassword;