<?php
require ('navbar.php');
$url = $_SERVER['PHP_SELF'];
$token = parse_url($url, PHP_URL_QUERY);
if(isset($_SESSION['userid'])){
	echo "Du er allerede logget inn. Du kan gå tilbake til forsiden <a href='index.php'>her</a>";
	die();
}
else{
?>
<body>
<div class="container">
<span><h3>Uff da, har du glemt passordet ditt? <br> Fortvil ikke, det er kjempelett å tilbakestille det her, bare skriv inn epost-adressen din!</h3></span>
<h5>
<form method = 'post' action= '' id="resetPassword">
	<span>Epost-adresse:</span>
	<input type= 'text' name = 'resetMail'>
	<input type = 'submit' name = 'glemtPassord' value = 'Tilbakestill passord'>
</form>
</h5>
<h5>
<?php
 if(isset($_POST['glemtPassord'])){
 	if(validerMail($_REQUEST['resetMail'])){
 		$db->sendMail($_REQUEST['resetMail']);
 ?>
 Du kan gå tilbake til forsiden <a href="index.php">her</a>
</h5>
</div>
<?php
}
else{
	echo "Vennligst se over e-mailadressen din.<br><br>";
}
}
}
 ?>
 <div style="position:fixed; bottom:0; height:50px; background-color:grey; text-align:center;
 width:100%; padding-top:15px;">Denne siden har blitt laget av <strong>Jonas, Karl og Sina</strong>.</div>
</body>
</html>
