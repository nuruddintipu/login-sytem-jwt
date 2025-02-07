import { useState, useEffect } from "react";
import {Navigate, useLocation} from "react-router-dom";
import { getRoutePath } from "./NamedLink";
import isAuthenticated from "../utils/authenticateUser";

const ProtectedRoute = ({ routeElement }) => {
    const [isAuth, setIsAuth] = useState(null);
    const location = useLocation();

    useEffect(() => {
        const checkAuth = async () => {
            const authStatus = await isAuthenticated();
            setIsAuth(authStatus);
        };
        checkAuth();
    }, [location]);

    if (isAuth === null) {
        return <div>Loading...</div>;
    }

    return isAuth ? routeElement : <Navigate to={getRoutePath('LOGIN')} />;
};

export default ProtectedRoute;
