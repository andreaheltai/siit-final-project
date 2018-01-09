<?php

function passEnc($pass) {
    $salt = '$1$pesmet!';
    return crypt($pass, $salt);
}

function checkMailWithPass($user, $pass) {
    $encPass = passEnc($pass);
    if ($user["password"] === $encPass) {
        return true;
    } else {
        return false;
    }
}

function validEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validPass($pass, $repass) {
    if ($pass === $repass) {
        return true;
    } else {
        return false;
    }
}

function validPassFormat($pass) {
    $condition = preg_match('/^\S*(?=\S{6,})(?=\S*[a-zA-Z])(?=\S*[\d])\S*$/', $pass);
    return $condition;
}

function lowerUsrname ($user) {
    return ctype_lower($user);
}


?>