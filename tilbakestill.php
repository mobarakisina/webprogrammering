<?php
require ('navbar.php');
$query = $_SERVER['QUERY_STRING'];
$ok = $db->checkLink($query);
if(isset($_POST['updatePass'])){
	if(validerPassord($_REQUEST['pass1']) == true AND validerPassord($_REQUEST['pass2']) == true){
		$db->updatePassword($query, $_REQUEST['pass1']);
	}
	else{
		echo "Vennligst se over passordene dine igjen.";
	}
}
?>
<body>
<script type= "text/javascript">
function validerPassord1(){
regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
OK = regEx.test(document.tilbakestill.pass1.value);
    if(!OK){
        document.getElementById('feilPassord1').innerHTML='Feil i passord';
        return false;
    }
    document.getElementById('feilPassord1').innerHTML='';
    return true;
}
function validerPassord2(){
regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
OK = regEx.test(document.tilbakestill.pass2.value);
    if(!OK){
        document.getElementById('feilPassord2').innerHTML='Feil i passord';
        return false;
    }
    document.getElementById('feilPassord2').innerHTML='';
    return true;
}
</script>
<?php
if(isset($_SESSION['userid'])){
	echo "Du er allerede logget inn.Du kan gå tilbake til forsiden <a href='index.php'>her</a>";
	die();
}
else{
	if(!$ok){
		echo "Linken din har dessverre utgått. Vennligst be om en ny.";
		die();
	}
?>

<form action="" name="tilbakestill" method="post">
	<table>
		<tr><td>Nytt passord:</td>
		<td><input type="password" name="pass1" onchange='validerPassord1()'/> <br></td>
		<td><div id= "feilPassord1">*</div></td></tr>
		<tr><td>Gjenta nytt passord:</td>
		<td><input type="password" name="pass2" onchange='validerPassord2()'/> <br> </td>
		<td><div id= "feilPassord2">*</div></td></tr><br>
	</table>
	<input type="submit" value="Oppdater" name="updatePass"/>
</form>
<?php 
}
?>
</body>
</html>