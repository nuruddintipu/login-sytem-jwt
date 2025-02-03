<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';

$request = json_decode(file_get_contents('php://input'), true);

require_once '../utils/registerUser.php';

$response = ['success' => false, 'message' => 'Invalid request'];

$email = isset($request['email']) ? $request['email'] : '';
$password = isset($request['password']) ? $request['password'] : '';

if(registerUser($email, $password)) {
    $response = ['success' => true, 'message' => 'User registered successfully.'];
} else {
    $response['message'] = 'User already exists.';
}

echo json_encode($response);