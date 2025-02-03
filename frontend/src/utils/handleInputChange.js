const handleInputChange = (field, value, callback) => {
    callback(prevData => ({
        ...prevData,
        [field]: value
    }));
};
export default handleInputChange;