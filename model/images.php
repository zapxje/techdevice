<?php
function getOneImage($idImage)
{
    $sql = "SELECT * FROM images_product WHERE id = $idImage";
    return getOne($sql);
}
function getImageByProduct($id)
{
    $sql = "SELECT * FROM images_product WHERE id_product = " . $id;
    return getAll($sql);
}
function addImage($idProduct, $name)
{
    $sql = "INSERT INTO images_product(id_product, name) VALUES(" . $idProduct . ", '" . $name . "')";
    return querySql($sql);
}
function delImage($idImage)
{
    $sql = "DELETE FROM images_product WHERE id= $idImage";
    return querySql($sql);
}
