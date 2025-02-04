<?php
require_once 'generateGuid.php';
require_once 'getUserByEmail.php';
function registerUser($email, $password) {
    $usersData = include '../storage/userData.php';

    if (!isset($usersData['users']) || !is_array($usersData['users'])) {
        $usersData['users'] = [];
    }

    if (getUserByEmail($email)) {
        return false;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $guid = generateGuid();

    $newUser = [
        'guid' => $guid,
        'email' => $email,
        'password' => $hashedPassword
    ];

    $usersData['users'][] = $newUser;

    $newContent = '<?php return ' . var_export($usersData, true) . ';';
    file_put_contents('../storage/userData.php', $newContent);

    return true;
}