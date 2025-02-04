<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';
require_once '../utils/authMiddleware.php';

require_once '../utils/deleteUser.php';
require_once '../utils/getUserByGuid.php';

$response = ['success' => false, 'message' => 'Invalid request'];

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $authResponse = authenticateUser();

    if (!$authResponse['success']) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }

    $userData = $authResponse['user'];
    $guid = $userData['sub'];

    if (deleteUser($guid)) {
        clearAuthCookies();
        echo json_encode(['success' => true, 'message' => 'Account deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to delete account']);
    }

} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}