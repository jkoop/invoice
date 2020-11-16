<?php

// Only allow request to an address ending with '/'
if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) != '/'){
	header('HTTP/1.1 404 Not Found');
	exit();
}

if($_GET['invoice'] == ''){
	$invoice = getInvoiceList();
	echo '<table class="table table-striped"><thead class="thead-dark"><tr><th>Invoice &#x2116;</th><th>Customer</th><th>Date Issued</th><th>Date Due</th><th>Amount</th><th>Paid?</th></tr></thead><body>';
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
	echo '</body></table>';
}else{
	$invoice = arrayToHtmlEntities(getInvoice($_GET['invoice']));
	$meta = $invoice['meta'];
	$rows = $invoice['rows'];
	unset($invoice);

	echo '<table class="invoice">';
	echo '<tr><th>Issued by</th><td>'.$meta['me']['name_last'].', '.$meta['me']['name_first'].'</td><td colspan="2" rowspan="9" class="invoice_paid"><div>'.paidText($meta).'</div></td><td colspan="4" rowspan="3" class="invoice_text">INVOICE</td></tr>';
	echo '<tr><td></td><td>'.$meta['me']['address'].'</td></tr>';
	echo '<tr><td></td><td>'.$meta['me']['city'].', '.$meta['me']['province'].'</td></tr>';
	echo '<tr><td></td><td>'.$meta['me']['tel_number'].'</td><td colspan="3" rowspan="3" style="padding-right: 0px;">
		<table>
		  <tbody><tr>
			<th>Invoice №</th>
			<td>'.$meta['iid'].'</td>
		  </tr>
		  <tr>
			<th>Date Issued</th>
			<td>'.$meta['date_issue'].'</td>
		  </tr>
		  <tr>
			<th>Date Due</th>
			<td>'.$meta['date_due'].'</td>
		  </tr>
		</tbody></table>
	  </td></tr>';
	echo '<tr><td>&nbsp;</td></tr>';
	echo '<tr><th>Bill to</th><td>'.$meta['customer']['name_last'].', '.$meta['customer']['name_first'].'</td></tr>';
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

	echo '<tr><td colspan="7">&nbsp;</td></tr><tr><td colspan="5"></td><th class="center">Total</th><td>$'.number_format($runningTotal, 2, '.', ',').'</td></tr>';

	echo '</table>';
}

?>
