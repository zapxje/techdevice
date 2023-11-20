<?php
function getImageByProduct($id)
{
    $sql = "SELECT * FROM images_product WHERE id_product = " . $id;
    return getAll($sql);
}
