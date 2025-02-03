<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';

$data = json_decode(file_get_contents('php://input'), true);

require_once '../utils/getUserByEmail.php';
require_once '../utils/getUserByGuid.php';
$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($data['email']) ? trim($data['email']) : '';
    $guid = isset($data['guid']) ? trim($data['guid']) : '';

    if (empty($guid)) {
        http_response_code(400);
        $response['message'] = 'GUID is required';
        echo json_encode($response);
        exit;
    }

    if (empty($email)) {
        http_response_code(400);
        $response['message'] = 'Email is required';
        echo json_encode($response);
        exit;
    }

    $user = getUserByGuid($guid);
    if (!$user) {
        http_response_code(404);
        $response['message'] = 'User not found';
    } elseif ($user['email'] !== $email) {
        http_response_code(403);
        $response['message'] = 'Unauthorized';
    } else {
        $response = ['success' => true, 'message' => 'User authorized successfully'];
    }
} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
}

echo json_encode($response);
