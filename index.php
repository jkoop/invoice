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
	<a href="?invoice">Invoice</a>
	<a href="?customer">Customer</a>
	<a href="?payment">Payment</a>
</p>

<hr>

<?php

if(isset($_GET['invoice'])){
	include 'invoice.php';
}elseif(isset($_GET['customer'])){
	if($_GET['customer'] == ''){
		$customer = getCustomerList();
		echo '<table>
		<tr><th></th><th colspan="2">Latest Invoice</th><th colspan="2">Amount</th></tr>
		<tr><th>Name</th><th>Number</th><th>Date Issued</th><th>Owing</th><th>Over<wbr>due</th></tr>';
		foreach($customer as $row){
			$name = getCustomerName($row['cid']);
			$name = $name['name_last'].', '.$name['name_first'];

			$invoice = getLatestInvoiceOfCustomer($row['cid']);
			$owing = getAmountOwingByCustomer($row['cid']);
			$outstanding = getAmountOutstandingByCustomer($row['cid']);
			echo '<tr>
				<td><a href="?customer='.$row['cid'].'">'.$name.'</a></td>
				<td><a href="?invoice='.$invoice['iid'].'">'.$invoice['iid'].'</a></td>
				<td>'.($invoice['date_issue'] != 0 ? date('Y M d', $invoice['date_issue']) : '').'</td>
				<td>$'.number_format($owing, 2, '.', ',').'</td>
				<td'.($outstanding>0?' class="highlight"':'').'>$'.number_format($outstanding, 2, '.', ',').'</td>
			</tr>';
		}
		echo '</table>';
	}else{
		echo '<p class="centre">Customer &#x2116; block has not been programmed</p>';
	}
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
