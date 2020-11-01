<?php

// Only allow request to an address ending with '/'
if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) != '/'){
	header('HTTP/1.1 404 Not Found');
	exit();
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

function getInvoiceList(){
	$list = query('SELECT DISTINCT
		`number`,
		`cid`,
		`date_issue`
			FROM
		`invoice`
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
		`invoice`
			WHERE
		`number` = "'.$number.'"
	');
	$return = 0;
	foreach($list as $row){
		$return += $row['qty'] * $row['each'];
	}
	return $return;
}

?>
