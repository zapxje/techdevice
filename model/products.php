<?php
/*
* Get Product By Id Catagory
*/
function getProductByCatagory($id)
{
    $sql = "SELECT * FROM products WHERE id_category = " . $id;
    return getAll($sql);
}
function getProductByBrand($id)
{
    $sql = "SELECT * FROM products WHERE id_brand = " . $id;
    return getAll($sql);
}
function getAllProducts()
{
    $sql = "SELECT * FROM products";
    return getAll($sql);
}
function getOneProduct($id)
{
    $sql = "SELECT * FROM products WHERE id=" . $id;
    return getOne($sql);
}
