<?php
include '../utils/headers.php';
include '../utils/approveOptionsMethod.php';
include '../utils/getUserByEmail.php';
include '../utils/jwtHelper.php';
require_once '../utils/authMiddleware.php';

$request = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false, 'message' => 'Invalid request'];


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = getUserByEmail($request['email']);

    if($user && password_verify($request['password'], $user['password'])) {
        $accessToken = createToken($user);
        $refreshToken = createToken($user, $isRefresh = true);

        setAuthCookies($accessToken, $refreshToken);

        $response = [
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'email' => $user['email'],
                'guid' => $user['guid']
            ]
        ];
    } else {
        $response['message'] = 'Invalid credentials';
    }
    echo json_encode($response);
} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
    echo json_encode($response);
}