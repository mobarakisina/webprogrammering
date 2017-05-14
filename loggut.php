<?php
require ('navbar.php');
$_SESSION = array();
session_regenerate_id();
if(session_destroy()){
	header("Location: index.php");
}
?>