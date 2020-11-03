<?php

// Only allow request to an address ending with '/'
if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) != '/'){
	header('HTTP/1.1 404 Not Found');
	exit();
}

function getAmountBilledByCustomer($cid){
	$list = query('SELECT DISTINCT
		`iid`
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
	$tmp = $paid - $underdue;
	if($tmp < 0){
		$tmp = 0;
	}
	return $tmp + $overdue;
}
function getAmountOverdue($cid){
	$list = query('SELECT DISTINCT
		`iid`
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
		`iid`
			FROM
		`invoice`
			WHERE
		`cid` = "' . $cid . '" AND NOT (
			`paid` = 0 AND
			`date_due` < "'.NOW.'"
		)
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
		`iid` = "'.$number.'"
	');
	$return = 0;
	foreach($list as $row){
		$return += $row['qty'] * $row['each'];
	}
	return $return;
}
function getInvoiceList(){
	$list = query('SELECT DISTINCT
		`iid`,
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
function getInvoice($iid){
	$meta               = query('SELECT * FROM `invoice` WHERE `iid` = "' . $iid . '"')[0];
	$meta['date_issue'] = date('Y M d', $meta['date_issue']);
	$meta['date_due']   = date('Y M d', $meta['date_due']);
	$meta['payment']    = query('SELECT * FROM `payment` WHERE `pid` = "' . $meta['pid'] . '"')[0];
	$meta['customer']   = query('SELECT * FROM `customer` WHERE `cid` = "' . $meta['cid'] . '"')[0];
	$meta['me']         = query('SELECT * FROM `customer` WHERE `is_me` = "1"')[0];
	$rows               = query('SELECT * FROM `invoice_row` WHERE `iid` = "' . $iid . '"');

	$meta['customer']['tel_number'] = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $meta['customer']['tel_number']);
	$meta['me']['tel_number']       = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $meta['me']['tel_number']);

	return [
		'meta' => $meta,
		'rows' => $rows,
	];
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
		`iid`,
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

function paidText($meta){
	if(!$meta['paid']){
		return;
	}
	$return = '<span>PAID</span><br><span>'.date('Y M d', $meta['payment']['date']).'</span>';

	return $return;
}

function arrayToHtmlEntities($array){
	foreach($array as &$val){
		if(gettype($val) == 'array'){
			$val = arrayToHtmlEntities($val);
		}else{
			$val = htmlentities($val);
		}
	}
	return $array;
}
function query($query, $return = true){
	global $db;
	$result = $db->query($query);
	if($return){
		$return = [];
		while($res = $result->fetchArray(SQLITE3_ASSOC)){
			$return[] = $res;
		}
		return $return;
	}
}

?>
