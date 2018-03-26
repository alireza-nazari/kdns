<?php

$uname = $_POST['usernamesignup'];
$email = $_POST['emailsignup'];
$pass = $_POST['passwordsignup'];
$pass_con = $_POST['passwordsignup_confirm'];



//echo '<pre>'.print_r($db, true).'</pre>';
if ($pass === $pass_con) {
	$db = new db(DSN,DB_U_NAME,DB_PASS);
	$crypted_pass = get_new_crypt(set_crypt($pass));
	$insert = array(
	  "username" => $uname,
	  "email" => $email,
	  "password" => $crypted_pass,
	);
	$db->insert("users", $insert);
	$effecte = $db->lastInsertID();
	echo "New User With ID ( " . $effecte . " ) added to the database!";
	$db = null;
	//var_dump($db);
} else {
	echo "User Nname: " .$uname . 
	"<br/> Email: " . $email . 
	"<br/> Password: " . $new_pass . 
	"<br/>Password Confirm: " . $pass_con ;
}

?>