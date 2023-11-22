<?php
function getProductByImage($image)
{
    $sql = "SELECT * FROM products WHERE image = '" . $image . "'";
    return getOne($sql);
}
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
function addProduct($idCategory, $idBrand, $name, $price, $price_sale, $quantity, $description, $image)
{
    $sql = "INSERT INTO products(id_category, id_brand, name, price, price_sale, quantity, description, image) 
    VALUES(" . $idCategory . ", " . $idBrand . " , '" . $name . "'," . $price . ", " . $price_sale . ", " . $quantity . ", '" . $description . "', '" . $image . "')";
    echo $sql;
    return querySql($sql);
}
