import HomePage from "../pages/HomePage";
import Login from "../pages/Login";
import SamplePageOne from "../pages/SamplePageOne";
import SamplePageTwo from "../pages/SamplePageTwo";
import SignUp from "../pages/SignUp";
import ProtectedRoute from "./ProtectedRoute";
import PublicRoute from "./PublicRoute";
import ChangePassword from "../pages/ChangePassword";
import {DeleteUser} from "../pages/DeleteUser";





const routes = [
    { path: '/', element: <ProtectedRoute routeElement={<HomePage />} />  , routeName: 'HOME'},
    { path: '/login', element: <PublicRoute routeElement={<Login />} />, routeName: 'LOGIN'},
    { path: '/signup', element: <PublicRoute routeElement={<SignUp />} /> , routeName: 'SIGNUP'},
    { path: '/sample-page-one', element: <ProtectedRoute routeElement={<SamplePageOne />} />,   routeName: 'SAMPLE_PAGE_ONE' },
    { path: '/sample-page-two', element: <ProtectedRoute routeElement={<SamplePageTwo />}/> , routeName: 'SAMPLE_PAGE_TWO' },
    { path: '/change-password', element: <ProtectedRoute routeElement={<ChangePassword />}/> , routeName: 'CHANGE_PASSWORD' },
    { path: '/delete-account', element: <ProtectedRoute routeElement={<DeleteUser />}/> , routeName: 'DELETE_ACCOUNT' },
];

export default routes;