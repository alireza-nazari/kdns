<?php 

function set_crypt($input, $rounds = 10){
  $crypt_options = array(
    'cost' => $rounds
  );
  return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
}
function get_new_crypt($input, $rounds = 59){
	$extract = explode("$2y$10$", $input);
	$new_hash = $extract[1];
	$new_hash .= "$";
	$round_chars = array_merge(range('A','Z'),range('a', 'z'),range(0, 9));
	for ($i=0; $i < $rounds ; $i++) { 
		$new_hash .= $round_chars[array_rand($round_chars)];
	}
	return $new_hash;
}
function regenrat_crypt($input){
	$crypt = explode("$", $input);
	$org_crypt = $crypt[0];
	$org_crypt = "$2y$10$" . $org_crypt;
	return $org_crypt;
}
?>