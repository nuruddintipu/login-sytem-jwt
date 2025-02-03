import {Container} from "react-bootstrap";
import {NamedLink} from "../routes/NamedLink";
import LogoutButton from "../components/LogoutButton";
import DeleteButton from "../components/DeleteButton";
import PageTemplate from "../components/PageTemplate";
import ChangePasswordButton from "../components/ChangePasswordButton";

function HomePage() {
    return (
        <PageTemplate pageTitle={ 'Home'}>
            <Container className="mt-5 text-center">
                <div>Go to
                    <NamedLink routeName='SAMPLE_PAGE_ONE'> Sample Page 1</NamedLink>
                </div>
                <div>Go to
                    <NamedLink routeName='SAMPLE_PAGE_TWO'> Sample Page 2</NamedLink>
                </div>
            </Container>
            <div className="justify-content-center d-flex">
                <LogoutButton />
                <DeleteButton />
                <ChangePasswordButton />
            </div>
        </PageTemplate>
    );
}

export default HomePage;