<?php 
/**
* This file is for connect to DSN in secure way
* All other use this file as try/catch method 
* By alireza nazari
* Date 29 Nov 2017
* File version 1
*/
//$db = new db(DSN, DB_U_NAME, DB_PASS); 
/* 
  Creating constants for heavily used paths makes things a lot easier.
  ex. require_once(LIBRARY_PATH . "Paginator.php")
*/
//require_once(realpath(dirname(__FILE__) . "/../classes/db_class.php"));

define("SITE_TITLE", "Kabul DNS");




defined("HOST")
  or define("HOST", "localhost");
defined("DB_NAME")
  or define("DB_NAME", "php_kdns");
defined("DB_U_NAME")
  or define("DB_U_NAME", "root");
defined("DB_PASS")
  or define("DB_PASS", "");
defined("DSN")
  or define("DSN", "mysql:host=" . HOST . ";dbname=" . DB_NAME);



defined("LIBRARY_PATH")
  or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/../library'));
defined("TEMPLATES_PATH")
  or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/../templates'));
defined("CONFIG_PATH")
  or define("CONFIG_PATH", realpath(dirname(__FILE__) . '/../config'));
defined("CLASSES_PATH")
  or define("CLASSES_PATH", realpath(dirname(__FILE__) . '/../classes'));

/*
  Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
?>