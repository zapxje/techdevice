<?php
/*
* Get one Subject
*/
function getOneUser($username, $password)
{
    $sql = "SELECT * FROM `users` WHERE username = '" . $username . "' AND password = '" . md5($password) . "'";
    return getOne($sql);
}
