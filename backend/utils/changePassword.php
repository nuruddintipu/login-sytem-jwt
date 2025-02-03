<?php

function changePassword($guid, $newPassword) {
    $usersData = include '../api/userData.php';

    if(!isset($usersData['users']) || !is_array($usersData['users'])) {
        return false;
    }

    $isPasswordUpdated = false;

    foreach($usersData['users'] as $key => $user) {
        if($user['guid'] === $guid) {
            $usersData['users'][$key]['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $isPasswordUpdated = true;
            break;
        }
    }

    if($isPasswordUpdated) {
        $newContent = '<?php return  ' . var_export($usersData, true) . ';' . PHP_EOL;
        file_put_contents('userData.php', $newContent);
        return true;

    }
    return false;
}