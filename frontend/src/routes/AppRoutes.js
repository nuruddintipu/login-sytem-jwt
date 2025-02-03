import {Route, Routes} from "react-router-dom";
import routes from "./routes";

const generateRoutes = (routes) =>
    routes.map(({ path, element }, index) => (
       <Route key={index} path={path} element={element}></Route>
    ));


const AppRoutes =() => <Routes>{ generateRoutes(routes)}</Routes>;

export default AppRoutes;