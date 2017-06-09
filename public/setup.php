<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('html_errors', 1);

//$root = dirname(__FILE__) . "/sessions";
//session_save_path($root);

session_start();

// Returns true if the user is logged in
function is_logged_in() {
  if(isset($_SESSION['type'])) {
	return True;
  } else {
  	return False;
  }
  //return array_key_exists('user_id', $_SESSION);
}

function get_logged_in_user_id() {
  if (is_logged_in()) {
    return $_SESSION['user_id'];
  }
  return 0;
}
