<?php

$interval = '15 MINUTE';
$server_interval = '780 MINUTE';

$dbconn = new mysqli('127.0.0.1', 'oowlisia_v2b', '1q2w3e4r', 'oowlisia_v2b');

$array_value = array(
	'orders_ho_adcab'     => "(null, '#orders_rid#', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', 'auto-approve', 'Terkirim', '1', date_add(now(), interval {$server_interval}), null, null)",
	'orders_adcab_ops'    => "(null, '#orders_rid#', '#id-number#', '#job-number#', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', 'auto-approve', 'Terkirim', '1', date_add(now(), interval {$server_interval}), null, null)",
	'orders_ops_surveyor' => "(null, '#orders_rid#', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', '12', 'auto-approve', 'Terkirim', '1', date_add(now(), interval {$server_interval}), null, null)",
	'orders_surveyor_ops' => "(null, '#orders_rid#', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', 'auto-approve', 'Terkirim', '1', date_add(now(), interval {$server_interval}), null, null)",
	'orders_ops_adcab'    => "(null, '#orders_rid#', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', '{\"original_name\":\"\",\"storage_name\":\"\",\"type\":\"\"}', 'auto-approve', 'Terkirim', '1', date_add(now(), interval {$server_interval}), null, null)"
);

$query  = "SELECT curr_modul, next_modul FROM disposisi_proses WHERE proses = 'orders' AND notes = 'auto-approve'";
$result = $dbconn->query($query);
while ($row = $result->fetch_row()) {

	$curr_modul = $row[0];
	$next_modul = $row[1];

	$query1 = "SELECT rid, orders_rid FROM {$curr_modul} WHERE DATE_ADD(insert_datetime, INTERVAL {$interval}) < DATE_ADD(NOW(), INTERVAL {$server_interval}) AND status = 'Terkirim'";
	$result1 = $dbconn->query($query1);
	while ($row1 = $result1->fetch_row()) {

		$rid = $row1[0];
		$orders_rid = $row1[1];

		$value = str_replace('#orders_rid#', $orders_rid, $array_value[$next_modul]);
		$query2 = "INSERT INTO {$next_modul} VALUES{$value}";
		$dbconn->query($query2);

		$query2 = "UPDATE {$curr_modul} SET status = 'Diproses', update_user = '1', update_datetime = date_add(now(), interval {$server_interval}) WHERE rid = '{$rid}'";
		$dbconn->query($query2);
	}
}

?>