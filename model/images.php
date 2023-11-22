<?php
function getImageByProduct($id)
{
    $sql = "SELECT * FROM images_product WHERE id_product = " . $id;
    return getAll($sql);
}
// function addProduct($idCategory, $idBrand, $name, $price, $price_sale, $quantity, $description, $image)
// {
//     $sql = "INSERT INTO products(id_category, id_brand, name, price, price_sale, quantity, description, image) 
//     VALUES(" . $idCategory . ", " . $idBrand . " , '" . $name . "'," . $price . ", " . $price_sale . ", " . $quantity . ", '" . $description . "', '" . $image . "')";
//     echo $sql;
//     return querySql($sql);
// }
