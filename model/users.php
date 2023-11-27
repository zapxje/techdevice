<?php
/*
* Get one Subject
*/
function getOneUser($username, $password)
{
    $sql = "SELECT * FROM `users` WHERE username = '" . $username . "' AND password = '" . $password . "'";
    return getOne($sql);
}
function getOneUserById($id)
{
    $sql = "SELECT * FROM `users` WHERE id = '" . $id . "'";
    return getOne($sql);
}
function addUser($full_name, $username, $password, $email, $phone)
{
    $sql = "INSERT INTO users(full_name, username, password, email, phone) VALUES ('" . $full_name . "', '" . $username . "', '" . $password . "', '" . $email . "', '" . $phone . "')";
    return querySql($sql);
}
function updateUser($id, $username, $full_name, $phone, $email, $address, $avatar)
{
    $sql = "update users SET 
    username = '" . $username . "', 
    full_name = '" . $full_name . "', 
    phone = " . $phone . ", 
    email = '" . $email . "', 
    address = '" . $address . "', 
    avatar = '" . $avatar . "'  WHERE id =" . $id;
    return querySql($sql);
}
