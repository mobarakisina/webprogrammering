<?php
require ('navbar.php');
?>
<style>
	table {
  		font-family: arial, sans-serif;
  		border-collapse: collapse;
  		width: 100%;
	}

	td, th {
  	border: 1px solid #dddddd;
  	text-align: left;
  	padding: 8px;
	}

	tr:nth-child(even) {
  	background-color: #dddddd;
	}
</style>
<body>
<?php
if(isset($_SESSION['userid'])){
?>
<h2>Her kan du melde deg opp som publikummer til ulike programmer</h2>
<?php
}
else{
	echo "Du har ikke tilgang til å se denne siden. Vennligst logg inn.";
	die();
}
?>
<div style="position:fixed; bottom:0; height:50px; background-color:grey; text-align:center;
width:100%; padding-top:15px;">Denne siden har blitt laget av <strong>Jonas, Karl og Sina</strong>.</div>
</body>
</html>
