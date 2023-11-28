<?php

function addOrder($id_user,$name,$email,$address,$city,$phone,$note,$payment_method,$total_order){
	$sql="INSERT INTO orders(id_user, name, email, address, city, phone, note, payment_method, total_order)
	VALUES('$id_user', '$name', '$email', '$address', '$city', '$phone', '$note',  
          '$payment_method', $total_order)";
	return querySql($sql);

	
}
function getOneOrderLimit(){
	$sql="SELECT * FROM orders ORDER BY id DESC LIMIT 1;";
	return getAll($sql);
}

function addCart($id_product, $id_order, $price, $quantity, $name){
	// Chọn một giá trị từ mảng $id_order (ví dụ: lấy giá trị đầu tiên)
    $selected_order_id = is_array($id_order) ? reset($id_order) : $id_order;

    $sql = "INSERT INTO carts(id_product, id_order, price, quantity, name)
            VALUES('$id_product', '$selected_order_id', '$price', '$quantity', '$name')";
    return querySql($sql);
}