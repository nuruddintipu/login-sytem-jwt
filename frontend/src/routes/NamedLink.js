import {Link} from "react-router-dom";
import routes from "./routes";

export const getRoutePath = (routeName, routeList = routes) => {
    for (const route of routeList) {
        if(route.routeName === routeName) return route.path;
    }
};

export const NamedLink = ({routeName, children, ...props}) => {
    const path = getRoutePath(routeName);
    return <Link to={path} {...props}>{children}</Link>;
};