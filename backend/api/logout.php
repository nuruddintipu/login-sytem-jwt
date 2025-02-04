<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';
require_once '../utils/jwtHelper.php';
require_once '../utils/clearAuthCookies.php';
function logoutUser() {
    clearAuthCookies();
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