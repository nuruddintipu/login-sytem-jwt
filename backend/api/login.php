<?php
include '../utils/headers.php';
include '../utils/approveOptionsMethod.php';
$request = json_decode(file_get_contents('php://input'), true);

include '../utils/getUserByEmail.php';
$response = ['success' => false, 'message' => 'Invalid request'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = getUserByEmail($request['email']);

    if($user && password_verify($request['password'], $user['password'])) {
        $response = [
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'guid' => $user['guid'],
                'email' => $user['email']
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