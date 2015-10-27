<?php

$no_javascript=true;
require_once('../lib/stdlib.inc.php');
require_once('../include/database.inc');

if (isset($_REQUEST["pc"]) && isset($_REQUEST["otp"])) {
	$id=fetch(query('select id from otp where risorsa=? and otp=?', array($_REQUEST["pc"],$_REQUEST["otp"])))['id'];
	if (!$id) exit; 

	query('delete from otp where id = ?',$id);	

	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARTDED_FOR'] != '') {
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
			$ip_address = $_SERVER['REMOTE_ADDR'];
	}

	query('insert into dns_pc (pc, ip) values (?,?) on duplicate key update ip = values(ip)',array($_REQUEST["pc"],$ip_address));

	echo 'ACK';
}
