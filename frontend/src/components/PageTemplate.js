const PageTemplate = ({pageTitle, children}) => {
    return (
        <div className="page-wrapper">
            <div className="page-container">
                <h2 className="page-title">{pageTitle}</h2>
                {children}
            </div>
        </div>
    );
};

export default PageTemplate;