<?php
require_once 'jwtHelper.php';

function authenticateUser() {
    $accessToken = getCookieValue('accessToken');
    $refreshToken = getCookieValue('refreshToken');

    if ($accessToken) {
        $response = handleAccessToken($accessToken);
        if ($response['success']) {
            return $response;
        }
        if($response['invalid'] && $refreshToken){
            return handleRefreshToken($refreshToken);
        }
    }
    if ($refreshToken) {
        return handleRefreshToken($refreshToken);
    }

    return unauthorizedResponse();
}

function handleAccessToken($accessToken) {
    $userData = verifyToken($accessToken, false);
    if (!$userData) {
        error_log("Access token expired");
        return ['success' => false, 'invalid' => true];
    }
    return successResponse($userData);
}


function handleRefreshToken($refreshToken) {
    $isRefreshToken = true;
    $userData = verifyToken($refreshToken, $isRefreshToken);
    if (!$userData) {
        error_log("Refresh token expired");
        return unauthorizedResponse();
    }

    return regenerateTokens($userData);
}

function regenerateTokens($userData){
    try {

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
    setSecureCookie('accessToken', $accessToken, 3600);
    setSecureCookie('refreshToken', $refreshToken, 3600);
}


function setSecureCookie($name, $value, $expiry) {
    setcookie($name, $value, [
        'expires' => time() + $expiry,
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

function getCookieValue($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}