<?php
function updateUser($guid, $keyToUpdate, $updatedValue){
    $usersData = include '../api/userData.php';

    if(!isset($usersData['users']) || !is_array($usersData['users'])){
        return false;
    }

    $isUserUpdated = false;
    $users = $usersData['users'];

    foreach ($users as $index => $user) {
        if ($user['guid'] === $guid){
            $user[$index][$keyToUpdate] = $updatedValue;
            $isUserUpdated = true;
            break;
        }
    }
    if($isUserUpdated){
        $newUser = '<?php return ' . var_export($usersData, true) . ';';
        file_put_contents('../api/userData.php', $newUser);
        return true;
    }

    return false;
}