<?php
function getOneBrand($id)
{
    $sql = "SELECT * FROM brands WHERE id=" . $id;
    return getOne($sql);
}
function getAllBrands()
{
    $sql = "SELECT * FROM brands ORDER BY id asc";
    return getAll($sql);
}
function addBrand($name, $image)
{
    $sql = "INSERT INTO brands(name, image) VALUES('" . $name . "','" . $image . "')";
    return querySql($sql);
}
function delBrand($id)
{
    $sql = "DELETE FROM brands WHERE id=" . $id;
    return querySql($sql);
}
function updateBrand($id, $name, $image)
{
    $sql = "UPDATE brands
    SET name = '" . $name . "', image = '" . $image . "'
    WHERE id =" . $id;
    return querySql($sql);
}
