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
	if($_GET['invoice'] == ''){
		$invoice = getInvoiceList();
		echo '<table><tr><th>Invoice &#x2116;</th><th>Customer</th><th>Date Issued</th><th>Date Due</th><th>Amount</th><th>Paid?</th></tr>';
		foreach($invoice as $row){
			$name = getCustomerName($row['cid']);
			$name = $name['name_last'].', '.$name['name_first'];
			echo '<tr>
				<td><a href="?invoice='.$row['iid'].'">'.$row['iid'].'</a></td>
				<td><a href="?customer='.$row['cid'].'">'.$name.'</a></td>
				<td>'.date('Y M d', $row['date_issue']).'</td>
				<td'.($row['date_due']<NOW&&!$row['paid']?' class="highlight"':'').'>'.date('Y M d', $row['date_due']).'</td>
				<td>$'.number_format(getInvoiceAmount($row['iid']), 2, '.', ',').'</td>
				<td'.(!$row['paid']?' class="highlight"':'').'>'.($row['paid']?'Yes':'No').'</td>
			</tr>';
		}
		echo '</table>';
	}else{
		$invoice = arrayToHtmlEntities(getInvoice($_GET['invoice']));
		$meta = $invoice['meta'];
		$rows = $invoice['rows'];
		unset($invoice);

		echo '<table class="invoice">';
		echo '<tr><th>Issued by</th><td>'.$meta['me']['name_last'].', '.$meta['me']['name_first'].'</td><td rowspan="9" class="invoice_paid"><div>'.paidText($meta).'</div></td><td colspan="4" rowspan="3" class="invoice_text">INVOICE</td></tr>';
		echo '<tr><td></td><td>'.$meta['me']['address'].'</td></tr>';
		echo '<tr><td></td><td>'.$meta['me']['city'].', '.$meta['me']['province'].'</td></tr>';
		echo '<tr><td></td><td>'.$meta['me']['tel_number'].'</td><th colspan="2">Invoice &#x2116;</th><td colspan="2">'.$meta['iid'].'</td></tr>';
		echo '<tr><td></td><td></td><th colspan="2">Date Issued</th><td colspan="2">'.$meta['date_issue'].'</td></tr>';
		echo '<tr><th>Bill to</th><td>'.$meta['customer']['name_last'].', '.$meta['customer']['name_first'].'</td><th colspan="2">Date Due</th><td colspan="2">'.$meta['date_due'].'</td></tr>';
		echo '<tr><td></td><td>'.$meta['customer']['address'].'</td><td colspan="4"></td></tr>';
		echo '<tr><td></td><td>'.$meta['customer']['city'].', '.$meta['customer']['province'].'</td><td colspan="4"></td></tr>';
		echo '<tr><td></td><td>'.$meta['customer']['tel_number'].'</td><td colspan="4"></td></tr>';
		echo '<tr class="row_head"><th colspan="2">Description</th><td class="invoice_wide"></td><th>QTY</th><th>Each</th><th>Line<br>Total</th><th>Running<br>Total</th></tr>';

		$runningTotal = 0;
		foreach($rows as $row){
			$lineTotal = $row['qty'] * $row['each'];
			$runningTotal += $lineTotal;
			echo '<tr class="invoice_row"><td colspan="3">'.$row['desc'].'</td><td>'.number_format($row['qty'], 2, '.', ',').'</td><td>'.number_format($row['each'], 2, '.', ',').'</td><td>'.number_format($lineTotal, 2, '.', ',').'</td><td>'.number_format($runningTotal, 2, '.', ',').'</td></tr>';
		}

		echo '<tr><td colspan="7">&nbsp;</td></tr><tr><td colspan="5"></td><th>Total</th><td>$'.number_format($runningTotal, 2, '.', ',').'</td></tr>';

		echo '</table>';
	}
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
