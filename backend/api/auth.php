<?php
require_once '../utils/headers.php';
require_once '../utils/approveOptionsMethod.php';
require_once '../utils/jwtHelper.php';

$data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_COOKIE['accessToken'])) {
        $accessToken = $_COOKIE['accessToken'];
        $isRefreshToken = false;
        try{
            $userData = verifyToken($accessToken, $isRefreshToken);
            $response = [
                'success' => true,
                'message' => 'User authorized successfully',
                'user' => [
                    'email' => $userData['email'],
                    'guid' => $userData['sub']
                ]
            ];
        } catch (Exception $e) {
            if(isset($_COOKIE['refreshToken'])) {
                $refreshToken = $_COOKIE['refreshToken'];
                $isRefreshToken = true;

                try {
                    $userData = verifyToken($refreshToken, $isRefreshToken);
                    $newAccessToken = createToken($userData);
                    $newRefreshToken = createToken($userData, $isRefreshToken);


                    setcookie('accessToken', $accessToken, [
                        'expires' => time() + ACCESS_TOKEN_EXPIRE,
                        'httponly' => true,
                        'path' => '/',
                        'secure' => true
                    ]);

                    setcookie('refreshToken', $newRefreshToken, [
                        'expires' => time() + REFRESH_TOKEN_EXPIRE,
                        'httponly' => true,
                        'path' => '/',
                        'secure' => true
                    ]);

                    $response = [
                        'success' => true,
                        'message' => 'User authorized successfully',
                        'user' => [
                            'email' => $userData['email'],
                            'guid' => $userData['sub']
                        ]
                    ];
                } catch (Exception $e) {
                    http_response_code(401);
                    $response['message'] = 'Unauthorized';
                }
            } else {
                http_response_code(403);
                $response['message'] = 'Forbidden';
            }
        }
    } else {
        http_response_code(401);
        $response['message'] = 'Unauthorized';
    }

} else {
    http_response_code(405);
    $response['message'] = 'Method not allowed';
}

echo json_encode($response);
