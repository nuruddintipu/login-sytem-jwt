export const BASE_URL = 'http://localhost:8000/api';

export const sendRequest = async (endpoint, method, body = null) => {
    const response = await fetch(`${BASE_URL}/${endpoint}`, {
        method: method,
        headers: { 'Content-Type': 'application/json' },
        body: body ? JSON.stringify(body) : null
    });
    return response.json();
};


