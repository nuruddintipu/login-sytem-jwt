<?php
require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$config = require '../config/config.php';

define("SECRET_KEY", $config['SECRET_KEY']);
define("REFRESH_SECRET_KEY", $config['REFRESH_SECRET_KEY'] );
define("ALGORITHM", $config['ALGORITHM']);
define("ACCESS_TOKEN_EXPIRE", $config['ACCESS_TOKEN_EXPIRE']);
define("REFRESH_TOKEN_EXPIRE", $config['REFRESH_TOKEN_EXPIRE']);

function createToken($user, $isRefresh = false){
    $sub = isset($user['sub']) ? $user['sub'] : (isset($user['guid']) ? $user['guid'] : null);
    $payload = [
      'iss' => 'login-system',
      'iat' => time(),
      'exp' => time() + ($isRefresh ? REFRESH_TOKEN_EXPIRE : ACCESS_TOKEN_EXPIRE),
      'sub' => $sub,
      'email' => $user['email'],
      'type' => $isRefresh ? 'refresh' : 'access'
    ];

    $key = $isRefresh ? REFRESH_SECRET_KEY : SECRET_KEY;
    return JWT::encode($payload, $key, ALGORITHM);
}

function verifyToken($token, $isRefresh = false){
    try {
        $key = $isRefresh ? REFRESH_SECRET_KEY : SECRET_KEY;
        $decoded = JWT::decode($token, new Key($key, ALGORITHM));
        return (array) $decoded;

    } catch (Exception $e) {
        return null;
    }
}


function blackListToken($token){
    $blacklistFile = '../storage/blacklist.php';
    $blacklist = json_decode(file_get_contents($blacklistFile), true) ?: [];
    $blacklist[] = $token;
    file_put_contents($blacklistFile, json_encode($blacklist, JSON_PRETTY_PRINT));
}


function isTokenBlacklisted($token){
    $blacklistFile = '../storage/blacklist.php';
    $blacklist = json_decode(file_get_contents($blacklistFile), true) ?: [];
    return in_array($token, $blacklist);
}

