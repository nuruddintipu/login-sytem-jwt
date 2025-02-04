<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';
require_once '../utils/jwtHelper.php';

function logoutUser() {
    setcookie('accessToken', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true,
        'secure' => true,
    ]);

    setcookie('refreshToken', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'httponly' => true,
        'secure' => true,
    ]);

    return ['success' => true, 'message' => 'User logged out successfully'];
}

$response = ['success' => false, 'message' => 'Invalid request'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $response = logoutUser();
} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
}

echo json_encode($response);