<?php
function getCartByOrder($idOrder)
{
    $sql = "SELECT c.*, p.name as product_name
            FROM carts as c
            LEFT JOIN products as p ON c.id_product = p.id
            WHERE c.id_order = $idOrder ";
    return getAll($sql);
}

