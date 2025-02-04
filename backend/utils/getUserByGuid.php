<?php
function getUserByGuid($guid) {
    $users = include '../storage/userData.php';
    $users = $users['users'];
    foreach ($users as $user) {
        if ($user['guid'] == $guid) {
            return $user;
        }
    }
    return null;
}
