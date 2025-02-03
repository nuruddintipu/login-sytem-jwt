<?php

function getUserByEmail($email) {
    $userData = include '../api/userData.php';
    $users = $userData['users'];
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return $user;
        }
    }
    return null;
}