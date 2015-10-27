<?php

// zucchero sintattico per $a ? $a : $b (if $a then $a else $b)
function _or ($a,$b) {
	return $a ? $a : $b;
}

// assegna un valore di default ad una variabile non settata (if (!isset($var)) $var=$value;
function _default(&$var,$value) {
	if (!isset($var)) $var=$value;
}

// print_r formattato con <pre>
function debug($x) {
	?> <pre>
	<?php
		print_r($x);
	?> </pre>
	<?php	
}

// valuta una stringa come espressione aritmentica e restituisce un float
function string_to_float($expr) { 
	$expr=str_replace(",",".",$expr);
	$expr = preg_replace('`([^+\-*=/\(\)\d\^<>&|\.]*)`','',$expr);
	if(empty($expr)) $expr = '0';
	else eval('$t='.$expr.';');
	$t=(float) $t;
	return euro_format($t,'.');
}


// currying (aka applicazione parziale)
// es: $imp=curry('implode','#');
//     $stringa=$imp(array(1,2,3,4,5,6);
// $stringa == "1#2#3#4#5#6"
function curry($fnc) {
    $args = func_get_args();
    array_shift($args);

    $lambda = sprintf(
        '$args = func_get_args(); ' .
        'return call_user_func_array(\'%s\', array_merge(unserialize(\'%s\'),
$args));',
         $fnc, serialize($args)
    );
    return create_function('', $lambda);
} 


