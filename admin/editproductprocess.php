<?php

	session_start();
	require_once('connector.php');
	
	
	$prodID=$_POST['addID'];
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
		$stmt2 = $dbconn->prepare('UPDATE products SET name = ?, price = ?, image = ?, description = ?, quantity = ?, date_created = ? WHERE productID = ?');
		$stmt2->bind_param('sdbsisi', $prodName, $prodPrice, $prodImage, $prodDesc, $prodQty, $prodCreated, $prodID);
		$stmt2->execute();

		echo"<script>window.alert('Product updated.');</script>";
		echo"<script>location.href='editProductPage.php';</script>";
	} else {
		echo"<script>window.alert('Product Code incorrect');</script>";
		echo"<script>location.href='editProductPage.php';</script>";
	}

?>