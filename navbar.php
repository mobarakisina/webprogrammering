<?php
ob_start();
session_start();
require ('funksjoner.php');
require ('feil.php');
require ('klasser.php');
$db = new database();
if(isset($_REQUEST['btnLogin'])){
	if(validerMail($_REQUEST['email']) == true AND validerPassord($_REQUEST['password']) == true){
		$db->login($_REQUEST['email'], $_REQUEST['password']);
		$url = $_SERVER['PHP_SELF'];
	}
	else{
		echo "<script type='text/javascript'>alert('Vennligst se over e-mailadressen og passordet ditt.')</script>";
	}
}
?>
<html lang= "en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content= "IE-edge">
	<meta name= "viewport" content= "width = device-width, initial-scale = 1">
	<title>Ski-VM</title>
	<link rel="stylesheet" type= "text/css" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<nav class="navbar navbar-default" style="position:fixed;z-index:999;top:0;
  width: 100%;float:margin-bottom:10px;">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">SKI-VM</a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<?php if(isset($_SESSION['userid'])){
			?>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Min Konto<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="program.php">Komplett program</a></li>
					<li><a href="minelop.php">Mine løp</a></li>
					<li><a href="publikum.php">Publikum</a></li>
					<li><a href="minprofil.php">Endre brukerinfo</a></li>
					<?php if($_SESSION['isadmin'] == true){
						echo "<li><a href='adminpanel.php'> Adminpanel</a></li>"; } ?>
					<li><a href="loggut.php">Logg ut</a></li>
				</ul>
			</li>
		<?php
		}
		else{
		?>
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Logg inn!<span class="caret"></span></a>
			<ul class="dropdown-menu" style="padding:20px;">
				<h3 style="margin-top:-10px;">Logg inn</h3>
			 	<form class="form" id="formLogin" method = 'post'>
			 		<input name="email" id="email" type="text" placeholder="Epostadresse" style="margin-bottom:15px;">
			 		<input name="password" id="password" type="password" placeholder="Passord" style="margin-bottom:15px;"><br>
			 		<button type="submit" name="btnLogin" class="btn" style="margin-bottom:15px;">Logg inn</button><br>
			 		<span><a href="registrer.php">Registrer ny bruker</a></span><br/><br/>
			 		<span><a href="glemtpassord.php"><i>Glemt passord?</i></a></span><br/>
			 	</form>
			</ul>
		</li>
		</ul>
		<?php
		}
		?>
	</div>
</nav>
