<?php

// Only allow request to an address ending with '/'
if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) != '/'){
	header('HTTP/1.1 404 Not Found');
	exit();
}

function getAmountBilledByCustomer($cid){
	$list = query('SELECT DISTINCT
		`number`
			FROM
		`invoice`
			WHERE
		`cid` = "' . $cid . '"
	');
	$billed = 0;
	foreach($list as $row){
		$billed += getInvoiceAmount($row['number']);
	}
	return $billed;
}
function getAmountPaidByCustomer($cid){
	$list = query('SELECT DISTINCT
		`amount`
			FROM
		`payment`
			WHERE
		`cid` = "' . $cid . '"
	');
	$paid = 0;
	foreach($list as $row){
		$paid += $row['amount'];
	}
	return $paid;
}
function getAmountOutstandingByCustomer($cid){
	$paid = getAmountPaidByCustomer($cid);
	$overdue = getAmountOverdue($cid);
	$underdue = getAmountUnderdue($cid);
	$tmp = $underdue - $paid;
	if($tmp < 0){
		$tmp = 0;
	}
	return $tmp + $overdue;
}
function getAmountOverdue($cid){
	$list = query('SELECT DISTINCT
		`number`
			FROM
		`invoice`
			WHERE
		`cid` = "' . $cid . '" AND
		`paid` = 0 AND
		`date_due` < "'.NOW.'"
	');
	$billed = 0;
	foreach($list as $row){
		$billed += getInvoiceAmount($row['number']);
	}
	return $billed;
}
function getAmountUnderdue($cid){
	$list = query('SELECT DISTINCT
		`number`
			FROM
		`invoice`
			WHERE
		`cid` = "' . $cid . '" AND
		`date_due` >= "'.NOW.'"
	');
	$billed = 0;
	foreach($list as $row){
		$billed += getInvoiceAmount($row['number']);
	}
	return $billed;
}
function getAmountOwingByCustomer($cid){
	$billed = getAmountBilledByCustomer($cid);
	$paid = getAmountPaidByCustomer($cid);
	return $billed - $paid;
}
function getCustomerList(){
	$list = query('SELECT DISTINCT
		`cid`
			FROM
		`customer`
	');
	return $list;
}
function getCustomerName($cid){
	$list = query('SELECT
		`name_last`,
		`name_first`
			FROM
		`customer`
			WHERE
		`cid` = '.$cid.'
	');
	return $list[0];
}
function getInvoiceAmount($number){
	$list = query('SELECT
		`qty`,
		`each`
			FROM
		`invoice_row`
			WHERE
		`number` = "'.$number.'"
	');
	$return = 0;
	foreach($list as $row){
		$return += $row['qty'] * $row['each'];
	}
	return $return;
}
function getInvoiceList(){
	$list = query('SELECT DISTINCT
		`number`,
		`cid`,
		`date_issue`,
		`date_due`,
		`paid`
			FROM
		`invoice`
	');
	usort($list, function($a, $b){
		return $b['number'] <=> $a['number'];
	});
	return $list;
}
function getPaymentList(){
	$list = query('SELECT DISTINCT
		`pid`,
		`cid`,
		`method`,
		`amount`,
		`date`
			FROM
		`payment`
	');
	usort($list, function($a, $b){
		return $b['date'] <=> $a['date'];
	});
	return $list;
}
function getLatestInvoiceOfCustomer($cid){
	$list = query('SELECT DISTINCT
		`number`,
		`date_issue`
			FROM
		`invoice`
			WHERE
		`cid` = "'.$cid.'"
	');
	usort($list, function($a, $b){
		return $b['date_issue'] <=> $a['date_issue'];
	});
	return $list[0];
}

function query($query, $return = true){
	global $db;
	$result = $db->query($query);
	if($return){
		$return = [];
		while($res = $result->fetchArray(SQLITE3_BOTH)){
			$return[] = $res;
		}
		return $return;
	}
}

?>
