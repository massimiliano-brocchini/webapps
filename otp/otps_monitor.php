<?php

$no_javascript=true;
require_once('../lib/stdlib.inc.php');
require_once('../include/database.inc');

$q=query("select risorsa, count(otp) as ct from join otp group by risorsa having count(otp) < 20");

while($data=fetch($q)) {
	echo "\n".$data['risorsa'];
}
