<?php

function clearAuthCookies() {
    setcookie('accessToken', '', time() - 3600, '/', '', true, true);
    setcookie('refreshToken', '', time() - 3600, '/', '', true, true);
}
