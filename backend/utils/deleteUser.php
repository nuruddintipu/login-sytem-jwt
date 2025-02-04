<?php

function deleteUser($guid) {
    $usersData = include '../storage/userData.php';

    if(!isset($usersData['users']) || !is_array($usersData['users'])) {
        return false;
    }

    $updatedUsers = array_filter($usersData['users'], function ($user) use ($guid) {
        return $user['guid'] !== $guid;
    });

    if (count($updatedUsers) === count($usersData['users'])) {
        return false;
    }

    $usersData['users'] = array_values($updatedUsers);
    $newUserData = '<?php return ' . var_export($usersData, true) . ';';
    file_put_contents('../storage/userData.php', $newUserData);

    return true;
}