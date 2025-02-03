<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';


$request = json_decode(file_get_contents('php://input'), true);
require_once '../utils/deleteUser.php';
require_once '../utils/getUserByGuid.php';

$response = ['success' => false, 'message' => 'Invalid request'];

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $guid = isset($request['guid']) ? trim($request['guid']) : '';
    $email = isset($request['email']) ? trim($request['email']) : '';
    $password = isset($request['password']) ? trim($request['password']) : '';
    $guid = isset($request['guid']) ? trim($request['guid']) : '';

    $user = getUserByGuid($guid);

    if (!$user) {
        $response = ['success' => false, 'message' => 'User not found'];
    }elseif (!password_verify($password, $user['password'])) {
        $response = ['success' => false, 'message' => 'Password is incorrect'];
    }else{
        $response = deleteUser($guid)
            ? ['success' => true, 'message' => 'User deleted successfully']
            : ['success' => false, 'message' => 'User deletion failed'];
    }

    echo json_encode($response);

}