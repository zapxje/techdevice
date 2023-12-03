<?php

function addReview($id_user, $id_product, $comment, $rating)
{
	$sql = "INSERT INTO reviews (id_user, id_product, comment, rating)
	VALUES('$id_user', '$id_product', '$comment', '$rating')";
	return querySql($sql);
}
function getReviewsByProduct($id)
{
	$sql = "SELECT r.*, u.username FROM reviews AS r
	LEFT JOIN users as u ON u.id= r.id_user
	WHERE r.id_product = '$id' ORDER BY r.id desc";
	return getAll($sql);
}
