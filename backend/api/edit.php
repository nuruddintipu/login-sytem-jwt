<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';

$request = json_decode(file_get_contents('php://input'), true);

require_once '../utils/changePassword.php';
require_once '../utils/getUserByEmail.php';
require_once  '../utils/getUserByGuid.php';
require_once '../utils/updateUser.php';

$response = ['success' => false, 'message' => 'Invalid request'];
if($_SERVER['REQUEST_METHOD'] === 'PUT'){

    $guid = isset($request['guid']) ? trim($request['guid']) : '';
    $email = isset($request['email']) ? trim($request['email']) : '';
    $currentPassword = isset($request['currentPassword']) ? trim($request['currentPassword']) : '';

    $user = getUserByGuid($guid);
    if (!$user) {
        echo json_encode($response);
        exit;
    }

    if (isset($request['type'])) {
        if ($request['type'] == 'password') {
            $newPassword = trim(isset($request['newPassword']) ? $request['newPassword'] : '');
            $confirmPassword = trim(isset($request['confirmPassword']) ? $request['confirmPassword'] : '');

            if (!password_verify($currentPassword, $user['password'])) {
                $response = ['success' => false, 'message' => 'Current password is incorrect'];
            } elseif ($newPassword !== $confirmPassword) {
                $response = ['success' => false, 'message' => 'Passwords do not match'];
            } elseif ($newPassword === $currentPassword) {
                $response = ['success' => false, 'message' => 'New password cannot be the same as current password'];
            } else {
                $response = updateUser($guid, 'password', $newPassword)
                    ? ['success' => true, 'message' => 'Password changed successfully']
                    : ['success' => false, 'message' => 'Password change failed'];
            }
        }
    }
} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
}

echo json_encode($response);