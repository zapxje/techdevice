<?php
/*
* Get Product By Id Catagory
*/
function getProductByCategory($id)
{
    $sql = "SELECT * FROM products WHERE id_category = " . $id;
    return getAll($sql);
}
function getProductByBrand($id)
{
    $sql = "SELECT * FROM products WHERE id_brand = " . $id;
    return getAll($sql);
}
//Lấy sản phẩm theo id category và id brand
function getProductByBoth($idCategory, $idBrand)
{
    $sql = "SELECT * FROM products WHERE id_category = " . $idCategory . " AND id_brand =" . $idBrand;
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
