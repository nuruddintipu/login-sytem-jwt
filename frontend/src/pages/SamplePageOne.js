import {Container} from "react-bootstrap";
import {NamedLink} from "../routes/NamedLink";
import LogoutButton from "../components/LogoutButton";
import DeleteButton from "../components/DeleteButton";
import PageTemplate from "../components/PageTemplate";
import ChangePasswordButton from "../components/ChangePasswordButton";

function SamplePageOne() {
    return (
        <PageTemplate pageTitle={ 'Sample Page 1' }>
            <Container className="mt-5 text-center">
                <div>Go to
                    <NamedLink routeName='HOME'> Home</NamedLink>
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

export default SamplePageOne;