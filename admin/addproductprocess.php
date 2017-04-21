<?php

	session_start();
	require_once('connector.php');
	
	$prodName=$_POST['addname'];
	$prodPrice=$_POST['addprice'];
	$prodImage=$_POST['fileToUpload'];
	$prodDesc=$_POST['adddescription'];
	$prodQty=$_POST['addquantity'];
	$prodCreated=$_POST['adddate_created'];

	$stmt = $dbconn->prepare('SELECT * FROM products WHERE productID = ?');
	$stmt->bind_param('s', $prodID);
	$stmt->execute();
	$result = $stmt->get_result();
	if($rows = $result->fetch_assoc()) {
		header("Content-Type: text/html; charset=UTF-8");
		echo "<script>alert('Product already exists.');history.back();</script>";
		$stmt->close();
		exit;
	} else {
		$stmt2 = $dbconn->prepare('INSERT INTO products (productID, name, price, image, description, quantity, date_created) VALUES (?, ?, ?, ?, ?, ?, ?)');
		$stmt2->bind_param('isdbsis', $prodID, $prodName, $prodPrice, $prodImage, $prodDesc, $prodQty, $prodCreated);
		$stmt2->execute();
		echo"<script>window.alert('Product added.');</script>";
		echo"<script>location.href='addproductpage.php';</script>";
	}

?>