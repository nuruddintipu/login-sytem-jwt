<?php

function deleteUser($guid) {
    $usersData = include '../api/userData.php';

    if(!isset($usersData['users']) || !is_array($usersData['users'])) {
        return false;
    }

    foreach($usersData['users'] as $key => $user) {
        if($user['guid'] == $guid) {
            array_splice($usersData['users'], $key, 1);

            $newContent = '<?php return ' . var_export($usersData, true) . ';';
            file_put_contents('userData.php', $newContent);

            return true;
        }
    }
    return false;
}