<?php
function getOneCategory($id)
{
    $sql = "SELECT * FROM categories WHERE id=" . $id;
    return getOne($sql);
}
function getAllCategories()
{
    $sql = "SELECT * FROM categories ORDER BY ordinal_number asc";
    return getAll($sql);
}
function addCategory($name, $ordinal_number, $description)
{
    $sql = "INSERT INTO categories(name, ordinal_number, description) VALUES('" . $name . "','" . $ordinal_number . "', '" . $description . "')";
    return querySql($sql);
}
function delCategory($id)
{
    $sql = "DELETE FROM categories WHERE id=" . $id;
    return querySql($sql);
}
function updateCategory($id, $name, $ordinal_number, $description)
{
    $sql = "UPDATE categories
    SET name = '" . $name . "', ordinal_number = '" . $ordinal_number . "', description = '" . $description . "'
    WHERE id =" . $id;
    return querySql($sql);
}
function validateNameCategory($name)
{
    $sql = "SELECT * FROM categories WHERE name = '" . $name . "'";
    return getAll($sql);
}
