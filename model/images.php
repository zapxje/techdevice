<?php
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
