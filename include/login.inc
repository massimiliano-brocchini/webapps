<?php

session_start();

function login($username, $password) {
	global $login_table;

	if (!isset($login_table)) die("ERROR: unspecified login_table global variable");

	$valid_tables=array('persone','todo_users');
	$column = $login_table['column'];
	$table  = $login_table['table'];

	if (trim($username)!='' && trim($password)!='' && in_array($table, $valid_tablesa)) {
		$res=query_to_list("select id,password from $table where $column=?",$username);
		if (is_array($res) && count($res)===1 && password_verify($password, $res['password'])) {
			$_SESSION['login_attempt'] = 0;
			$_SESSION['user'] = $res['id'];
		} else {
			sleep(3*$_SESSION['login_attempt']);
			$_SESSION['login_attempt']++;
		}
	}
}

if (isset($_POST['do_login'])) {
	unset($_POST['do_login']);
	login($_POST['user'],$_POST['pass']);
}

if (!isset($_SESSION['user'])) {
	echo ('
			<form name="form" method="post" action="">
				User <input type="text" name="user" id="user"> <br>
				Pass <input type="password" name="pass"> <br>
				<input type="submit" name="do_login" value="login">
			</form>
		');
	exit;
}
