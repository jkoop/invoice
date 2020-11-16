<?php

// Only allow request to an address ending with '/'
if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) != '/'){
	header('HTTP/1.1 404 Not Found');
	exit();
}

if($_GET['payment'] == ''){
	$invoice = getPaymentList();
	echo '<table class="table table-striped"><thead class="thead-dark"><tr><th>Payment &#x2116;</th><th>Customer</th><th>Method</th><th>Amount</th><th>Date</th></tr></thead><tbody>';
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
	echo '</tbody></table>';
}else{
	echo '<p class="centre">Payment &#x2116; block not yet implemented</p>';
}

?>
