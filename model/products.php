<?php
/*
* Get Product By Id Catagory
*/
function getProductByCatagory($id)
{
    $sql = "SELECT * FROM products WHERE id_category = " . $id;
    return getAll($sql);
}
