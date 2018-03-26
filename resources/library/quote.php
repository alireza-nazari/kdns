<?php 
function db_quote($value) {
    $connection = db_connect();
    $string = trim($value, " \t\n\r");
    $string = implode("",explode("\\",$string));
    $string = implode("",explode("/",$string));
    $string = preg_replace('/\s+/', '', $string);
    $string = str_replace('!', '', $string);
    $string = str_replace('~', '', $string);
    $string = str_replace('#', '', $string);
    $string = str_replace('$', '', $string);
    $string = str_replace('%', '', $string);
    $string = str_replace('^', '', $string);
    $string = str_replace('&', '', $string);
    $string = str_replace('*', '', $string);
    $string = str_replace('(', '', $string);
    $string = str_replace(')', '', $string);
    $string = str_replace('+', '', $string);
    $string = str_replace('=', '', $string);
    $string = str_replace('_', '', $string);
    $string = str_replace('-', '', $string);
    $string = str_replace('`', '', $string);
    $value = stripslashes($string);
    return "'" . mysqli_real_escape_string($connection,$value) . "'";
}
function db_quote_password($value) {
    $connection = db_connect();
    return "'" . mysqli_real_escape_string($connection,$value) . "'";
}
?>