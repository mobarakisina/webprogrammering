<?php
if(isset($_REQUEST["fornavn"]))
{
	$con = new mysqli('localhost' , 'root' , 'root' , 'skivm');
	$con->query("DELETE FROM utovere WHERE fornavn=".$_POST['fornavn']);
}else echo 'Not Deleted Error Occured';
?>