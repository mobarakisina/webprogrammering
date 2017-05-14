<?php
require ('navbar.php');
?>
<body>
<?php
if(isset($_SESSION['userid'])){
?>
<h2 id="mineLop">Her kan du se hvilke program du er påmeldt som publikummer til</h2>
<?php
}
else{
	echo "Du har ikke tilgang til å se denne siden.";
}
?>
<div style="position:fixed; bottom:0; height:50px; background-color:grey; text-align:center;
width:100%; padding-top:15px;">Denne siden har blitt laget av <strong>Jonas, Karl og Sina</strong>.</div>
</body>
</html>
