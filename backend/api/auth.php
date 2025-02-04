<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';
require_once '../utils/jwtHelper.php';
require_once '../utils/authMiddleware.php';

$data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authResponse = authenticateUser();

    if ($authResponse['success']) {
        $userData = $authResponse['user'];
        $response = [
            'success' => true,
            'message' => 'User authorized successfully',
            'user' => [
                'email' => $userData['email'],
                'guid' => $userData['sub']
            ]
        ];
    } else {
        http_response_code(401);
        $response['message'] = $authResponse['message'];
    }
} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
}

echo json_encode($response);
