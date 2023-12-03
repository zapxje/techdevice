<?php

function addOrder($id_user, $code_order, $name, $email, $address, $city, $phone, $note, $payment_method, $total_order)
{
	$sql = "INSERT INTO orders(id_user, code_order, name, email, address, city, phone, note, payment_method, total_order)
	VALUES('$id_user', '$code_order', '$name', '$email', '$address', '$city', '$phone', '$note',  
          '$payment_method', $total_order)";
	return querySql($sql);
}
function getOrderByUser($idUser)
{
	$sql = "SELECT * FROM orders WHERE id_user = $idUser";
	return getAll($sql);
}
function getOneOrderLimit()
{
	$sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 1;";
	return getOne($sql);
}

function addCart($id_product, $id_order, $price, $quantity)
{
	// Chọn một giá trị từ mảng $id_order (ví dụ: lấy giá trị đầu tiên)
	$selected_order_id = is_array($id_order) ? reset($id_order) : $id_order;

	$sql = "INSERT INTO carts(id_product, id_order, price, quantity)
            VALUES($id_product, $selected_order_id, $price, $quantity)";
	return querySql($sql);
}
function getCartByIdProduct($idProduct)
{
	$sql = "SELECT * FROM carts WHERE id_product = $idProduct";
	return getOne($sql);
}
