<?php

// Only allow request to an address ending with '/'
if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) != '/'){
	header('HTTP/1.1 404 Not Found');
	exit();
}

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

?>
