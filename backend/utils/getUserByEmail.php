<?php

function getUserByEmail($email) {
    $userData = include '../storage/userData.php';
    $users = $userData['users'];
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return $user;
        }
    }
    return null;
}