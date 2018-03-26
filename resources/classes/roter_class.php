<?php

/**
* 
*/
class roter {
  var $path = array();
  var $request_path = array();

  function __construct(){
    if (isset($_SERVER['REQUEST_URI'])) {
      $this->request_path = explode('?', $_SERVER['REQUEST_URI']);
      $this->path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
      $this->path['call'] = substr(urldecode($this->request_path[0]), strlen($this->path['base']) + 1);
    }
  }

  function parse_path() {
    if (strpos($this->path['call'], '//') !== false) {
      $this->path['error'] = true;
      return $this->path;
    } else {
      $this->path['error'] = false;
      if ($this->path['call'] == basename($_SERVER['PHP_SELF'])) {
        $this->path['call'] = '';
      }
      $this->path['call_parts'] = explode('/', $this->path['call']);
      if (isset($this->request_path[1])) {
        $this->path['query'] = urldecode($this->request_path[1]);
        $vars = explode('&', $this->path['query']);
        foreach ($vars as $var) {
          $t = explode('=', $var);
          $this->path['query_vars'][$t[0]] = $t[1];
        }
      }
    }
    return $this->path;
  }//end parse_path
}


?>