<?php
require_once 'jwtHelper.php';

function authenticateUser() {
    $accessToken = isset($_COOKIE['accessToken']) ? $_COOKIE['accessToken'] : null;
    $refreshToken = isset($_COOKIE['refreshToken']) ? $_COOKIE['refreshToken'] : null;

    if ($accessToken) {
        try {
            $userData = verifyToken($accessToken, false);
            return successResponse($userData);
        } catch (Exception $e) {
            error_log("Access token verification failed: " . $e->getMessage());
        }
    }

    if ($refreshToken) {
        return handleRefreshToken($refreshToken);
    }

    return unauthorizedResponse();
}

function handleRefreshToken($refreshToken) {
    try {
        $userData = verifyToken($refreshToken, true);
        $newAccessToken = createToken($userData);
        $newRefreshToken = createToken($userData, true);

        setAuthCookies($newAccessToken, $newRefreshToken);
        return successResponse($userData);
    } catch (Exception $e) {
        error_log("Refresh token verification failed: " . $e->getMessage());
        return unauthorizedResponse();
    }
}

function setAuthCookies($accessToken, $refreshToken) {
    setcookie('accessToken', $accessToken, [
        'expires' => time() + ACCESS_TOKEN_EXPIRE,
        'httponly' => true,
        'path' => '/',
        'secure' => true
    ]);

    setcookie('refreshToken', $refreshToken, [
        'expires' => time() + REFRESH_TOKEN_EXPIRE,
        'httponly' => true,
        'path' => '/',
        'secure' => true
    ]);
}

function successResponse($userData) {
    return [
        'success' => true,
        'user' => $userData
    ];
}

function unauthorizedResponse() {
    return [
        'success' => false,
        'message' => 'Unauthorized'
    ];
}
