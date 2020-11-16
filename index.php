<?php // Startup
include 'private/functions.php'; ?>
<!DOCTYPE html>
<html>
<head>

<title>
<?= isset($_GET['invoice']) ? 'Invoice ' . (
	$_GET['invoice'] != '' ? '#' : ''
	) . $_GET['invoice'] . ' - ' : '' ?>
<?= isset($_GET['customer']) ? 'Customer ' . (
	$_GET['customer'] != '' ? '#' : ''
	) . $_GET['customer'] . ' - ' : '' ?>
<?= isset($_GET['payment']) ? 'Payment ' . (
	$_GET['payment'] != '' ? '#' : ''
	) . $_GET['payment'] . ' - ' : '' ?>Inco</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preload, preconnect, dns-prefetch, shortcut icon" href="public/favicon.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="preload, preconnect, dns-prefetch, stylesheet" href="public/main.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

</head>
<body>

<?php

include 'private/header.php';

if(isset($_GET['invoice'])){
	include 'private/invoice.php';
}elseif(isset($_GET['customer'])){
	include 'private/customer.php';
}elseif(isset($_GET['payment'])){
	include 'private/payment.php';
}else{
	echo '<p class="centre">Dashboard block not yet implemented</p>';
}

?>

<hr>

<address>Inco v0.1.0</address>

</body>
</html>
