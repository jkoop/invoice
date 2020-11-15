<?php

// Startup
include 'functions.php';
$db = new SQLite3('db.sqlite');
$db->query('CREATE TABLE IF NOT EXISTS `invoice` (
	`iid` TEXT PRIMARY KEY,
	`cid` TEXT NOT NULL,
	`date_issue` INTEGER NOT NULL,
	`date_due` INTEGER NOT NULL,
	`paid` INTEGER DEFAULT 0,
	`pid` INTEGER
);');
$db->query('CREATE TABLE IF NOT EXISTS `invoice_row` (
	`row` INTEGER PRIMARY KEY,
	`iid` TEXT NOT NULL,
	`desc` TEXT NOT NULL,
	`qty` NUMERIC NOT NULL,
	`each` NUMERIC NOT NULL
);');
$db->query('CREATE TABLE IF NOT EXISTS `customer` (
	`cid` INTEGER PRIMARY KEY,
	`name_last` TEXT NOT NULL,
	`name_first` TEXT NOT NULL,
	`address` TEXT,
	`city` TEXT,
	`province` TEXT,
	`post_code` TEXT,
	`tel_number` INTEGER NOT NULL,
	`fax_number` INTEGER,
	`email` TEXT,
	`is_me` INTEGER
);');
$db->query('CREATE TABLE IF NOT EXISTS `payment` (
	`pid` INTEGER PRIMARY KEY,
	`cid` TEXT NOT NULL,
	`method` TEXT NOT NULL,
	`amount` NUMERIC NOT NULL,
	`ext_id` TEXT,
	`date` INTEGER NOT NULL
);');
define("NOW", time());

?>
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
<link rel="preload, preconnect, dns-prefetch, shortcut icon" href="favicon.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="preload, preconnect, dns-prefetch, stylesheet" href="main.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

</head>
<body>

<?php include 'header.php'; ?>

<hr>

<?php

if(isset($_GET['invoice'])){
	include 'invoice.php';
}elseif(isset($_GET['customer'])){
	include 'customer.php';
}elseif(isset($_GET['payment'])){
	if($_GET['payment'] == ''){
		$invoice = getPaymentList();
		echo '<table><tr><th>Payment &#x2116;</th><th>Customer</th><th>Method</th><th>Amount</th><th>Date</th></tr>';
		foreach($invoice as $row){
			$name = getCustomerName($row['cid']);
			$name = $name['name_last'].', '.$name['name_first'];
			echo '<tr>
				<td><a href="?payment='.$row['pid'].'">'.$row['pid'].'</a></td>
				<td><a href="?customer='.$row['cid'].'">'.$name.'</a></td>
				<td>'.$row['method'].'</td>
				<td>$'.number_format($row['amount'], 2, '.', ',').'</td>
				<td>'.date('Y M d', $row['date']).'</td>
			</tr>';
		}
		echo '</table>';
	}else{
		echo '<p class="centre">Payment &#x2116; block has not been programmed</p>';
	}
}else{
	echo '<p class="centre">Dashboard block has not been programmed</p>';
}

?>

<hr>

<address>Inco v0.1.0</address>

</body>
</html>
