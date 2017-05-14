<?php
error_reporting(0);
register_shutdown_function(shutdown);
function shutdown(){
	$lastError = error_get_last();
	if($lastError['type'] == E_ERROR){
		warningHandler(E_ERROR, $lastError['message'], $lastError['file'], $lastError['line']);
		header("Location: oops.php");
		ob_flush();
	}
	ob_end_flush();
}

set_error_handler(warningHandler);
function warningHandler($errno, $errstr, $errfile, $errline){
	$date = date("d-m-Y H:i");
	$error= $date . " " . $errfile . " " . $errline . " " . $errno . " " . $errstr . "\n\n";
	error_log($error, 3, "feil.txt");
}