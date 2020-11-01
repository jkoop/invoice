<?php

// Startup
include 'functions.php';
$db = new SQLite3('db.sqlite');
$db->query('CREATE TABLE IF NOT EXISTS `invoice` (
	`rid` INTEGER PRIMARY KEY,
	`cid` TEXT NOT NULL,
	`number` TEXT NOT NULL,
	`desc` TEXT NOT NULL,
	`qty` NUMERIC NOT NULL,
	`each` NUMERIC NOT NULL,
	`date_issue` INTEGER NOT NULL,
	`date_due` INTEGER NOT NULL
);');
$db->query('CREATE TABLE IF NOT EXISTS `customer` (
	`cid` INTEGER PRIMARY KEY,
	`name_last` TEXT NOT NULL,
	`name_first` TEXT NOT NULL,
	`address` TEXT,
	`city` TEXT,
	`province` TEXT,
	`post_code` TEXT,
	`tel_number` TEXT NOT NULL,
	`fax_number` TEXT,
	`email` TEXT,
	`is_me` INTEGER
);');
$db->query('CREATE TABLE IF NOT EXISTS `payment` (
	`pid` INTEGER PRIMARY KEY,
	`cid` TEXT NOT NULL,
	`method` TEXT NOT NULL,
	`amount` NUMERIC NOT NULL,
	`ext_id` TEXT
);');

?>
<!DOCTYPE html>
<html>
<head>

<title>Inco</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preload, preconnect, dns-prefetch, shortcut icon" href="favicon.png">
<link rel="preload, preconnect, dns-prefetch, stylesheet" href="main.css">

</head>
<body>

<h1>
	<?= count($_GET) > 0 ? '<a href=".">Inco</a> &gt;' : 'Inco' ?>
	<?= isset($_GET['invoice']) ? '<span>Invoice ' . (
		$_GET['invoice'] != '' ? '#' : ''
		) . $_GET['invoice'] . '</span>' : '' ?>
	<?= isset($_GET['customer']) ? '<span>Customer ' . (
		$_GET['customer'] != '' ? '#' : ''
		) . $_GET['customer'] . '</span>' : '' ?>
	<?= isset($_GET['payment']) ? '<span>Payment ' . (
		$_GET['payment'] != '' ? '#' : ''
		) . $_GET['payment'] . '</span>' : '' ?>
</h1>

<hr>

<p id="navbar">
	<a href="?invoice">Invoices</a>
	<a href="?customer">Customers</a>
	<a href="?payment">Payments</a>
</p>

<hr>

<?php

if(isset($_GET['invoice'])){
	if($_GET['invoice'] == ''){
		$invoice = getInvoiceList();
		echo '<div class="centre"><table><tr><th>Invoice &#x2116;</th><th>CID</th><th>Date Issued</th><th>Amount</th></tr>';
		foreach($invoice as $row){
			$name = getCustomerName($row[1]);
			$name = $name[0].', '.$name[1];
			echo '<tr>
				<td><a href="?invoice='.$row[0].'">'.$row[0].'</a></td>
				<td><a href="?customer='.$row[1].'">'.$name.'</a></td>
				<td>'.date('Y M d', $row[2]).'</td>
				<td>$'.number_format(getInvoiceAmount($row[0]), 2, '.', ',').'</td>
			</tr>';
		}
		echo '</table></div>';
	}else{
		echo '<p class="centre">This block has not been programmed</p>';
	}
}elseif(isset($_GET['customer'])){
	echo '<p class="centre">This block has not been programmed</p>';
}elseif(isset($_GET['payment'])){
	echo '<p class="centre">This block has not been programmed</p>';
}else{
	echo '<p class="centre">This block has not been programmed</p>';
}

?>

<hr>

<address>Inco v0.1.0</address>

</body>
</html>
