<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';
require_once '../utils/authMiddleware.php';
require_once '../utils/getUserByGuid.php';
require_once '../utils/updateUser.php';
require_once '../utils/clearAuthCookies.php';

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $authResponse = authenticateUser();

    if (!$authResponse['success']) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }

    $userData = $authResponse['user'];
    $guid = $userData['sub'];

    $request = json_decode(file_get_contents('php://input'), true);
    $currentPassword = trim(isset($request['currentPassword']) ? $request['currentPassword'] : '');
    $newPassword = trim(isset($request['newPassword']) ? $request['newPassword'] : '');
    $confirmPassword = trim(isset($request['confirmPassword']) ? $request['confirmPassword'] : '');

    $user = getUserByGuid($guid);
    if (!$user) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit;
    }

    if (!password_verify($currentPassword, $user['password'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        exit;
    }

    if ($newPassword === $currentPassword) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'New password cannot be the same as the current password']);
        exit;
    }

    $updated = updateUser($guid, 'password', password_hash($newPassword, PASSWORD_BCRYPT));
    if (!$updated) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to update password']);
        exit;
    }

    clearAuthCookies();

    echo json_encode(['success' => true, 'message' => 'Password changed successfully. Please log in again.']);
} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
}
