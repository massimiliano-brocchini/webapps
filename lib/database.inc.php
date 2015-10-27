<?php

function query($sql,$args=null) {
	global $db, $db_path;
	if (!is_null($args) && !is_array($args)) $args=array($args);
	if (!$statement=$db->prepare($sql)) die("\nERROR1 :".print_r($db->errorInfo(),true)."\n".$sql.' '.print_r($args,true));
	if (is_null($args)) {
		if (!$statement->execute()) $error=true;
	} else {
		if (!$statement->execute($args)) $error=true;
	}

	if ($error) {
		if ($db->getAttribute("PDO::ATTR_DRIVER_NAME")=='sqlite') {
			$d=dirname($db_path);
			if (!is_writable($d)) die ("\nERROR: $d must be writeable"); 
		}
		die("\nERROR3 :".print_r($db->errorInfo(),true)."\n".$sql.' '.print_r($args,true));
	}
	return $statement;
}

function fetch($statement) {
	return $statement->fetch(PDO::FETCH_ASSOC);
}

function query_to_record($sql,$args=null) {
	$st=query($sql,$args);
	while ($data=fetch($st)) $result[]=$data;
	return $result;
}

function query_to_list($sql,$args=null) {
	$st=query($sql,$args);
	while ($data=fetch($st)) $result[]=current($data);
	return $result;
}

function query_to_assoc($key,$values,$sql,$args=null) {
	if (!is_array($values)) $values=array($values);
	$st=query($sql,$args);
	while ($data=fetch($st)) {
		$result[$data[$key]]=array_intersect_key(array_flip($values),$data);
	}
	return $result;
}

function query_to_k_v($key,$value,$sql,$args=null) {
	$st=query($sql,$args);
	while ($data=fetch($st)) {
		$result[$data[$key]]=array_get($value,$data);
	}
	return $result;
}

//preleva dal risultato della funzione query una chiave ed un valore
//record (AKA array array) -> array
//utilizzata per creare le options delle select
function query_result_to_array($array_array,$value,$key=false) {
	if (!is_array($array_array)) return array();
	if ($key!==false) foreach ($array_array as $array) $temp[$array[$key]]=$array[$value];
	else foreach ($array_array as $array) $temp[]=$array[$value];
	return $temp;
}
