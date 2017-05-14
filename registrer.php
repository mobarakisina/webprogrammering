<?php
require ('navbar.php');
if(isset($_SESSION['userid'])){
	echo "Du er allerede logget inn.Du kan gå tilbake til forsiden <a href='index.php'>her</a>";
}
else{
?>
<script type= "text/javascript">
function validerFornavn(){
regEx = /^[a-zA-ZæøåÆØÅ .\-]{2,20}$/;
OK = regEx.test(document.registrer.fornavn.value);
  if(!OK){
    document.getElementById('feilFornavn').innerHTML='Feil i fornavn';
    return false;
  }
  document.getElementById('feilFornavn').innerHTML='';
  return true;
}

function validerEtternavn(){
regEx = /^[a-zA-ZæøåÆØÅ .\-]{2,20}$/;
OK = regEx.test(document.registrer.etternavn.value);
    if(!OK){
        document.getElementById('feilEtternavn').innerHTML='Feil i etternavn';
        return false;
    }
    document.getElementById('feilEtternavn').innerHTML='';
    return true;
}

function validerPostnr(){
regEx = /^[0-9]{4}$/;
OK = regEx.test(document.registrer.postnr.value);
    if(!OK){
        document.getElementById('feilPostnr').innerHTML='Feil i postnummer';
        return false;
    }
    document.getElementById('feilPostnr').innerHTML='';
    return true;
}

function validerSted(){
regEx = /^[a-zæøåA-ZÆØÅ ,-]{2,20}$/;
OK = regEx.test(document.registrer.sted.value);
    if(!OK){
        document.getElementById('feilSted').innerHTML='Feil i sted';
        return false;
    }
    document.getElementById('feilSted').innerHTML='';
    return true;
}

function validerEmail(){
regEx = /^[a-zæøåA-ZÆØÅ0-9 .-]+@[a-zæøåA-ZÆØÅ0-9.-]+\.[a-zA-z]{2,4}$/;
OK = regEx.test(document.registrer.email.value);
    if(!OK){
        document.getElementById('feilEmail').innerHTML='Feil i E-mail';
        return false;
    }
    document.getElementById('feilEmail').innerHTML='';
    return true;
}

function validerTelefon(){
regEx = /^[0-9]{8}$/;
OK = regEx.test(document.registrer.telefon.value);
    if(!OK){
        document.getElementById('feilTelefon').innerHTML='Feil i telefonnr';
        return false;
    }
    document.getElementById('feilTelefon').innerHTML='';
    return true;
}

function validerPassord(){
regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
OK = regEx.test(document.registrer.passord.value);
    if(!OK){
        document.getElementById('feilPassord').innerHTML='Feil i passord';
        return false;
    }
    document.getElementById('feilPassord').innerHTML='';
    return true;
}
</script>
<body id="registrer">
    <div class="skjema">
        <form action="" method="post" name="registrer"/>
          	<table>
                <th><h3>Registrer deg her:</h3></th>
                <tr><td>Fornavn:</td>
                <td><input type="text" name="fornavn" onchange = 'validerFornavn()' placeholder="Fornavn:"/><br></td>
                <td><div id= "feilFornavn">*</div></td></tr>
                <tr><td>Etternavn:</td>
                <td><input type="text" name="etternavn" onchange = 'validerEtternavn()' placeholder="Etternavn:"/><br></td>
                <td><div id= "feilEtternavn">*</div></td></tr>
                <tr><td>Postnummer:</td>
                <td><input type="text" name="postnr" onchange = 'validerPostnr()' placeholder="Postnr"/><br></td>
                <td><div id= "feilPostnr">*</div></td></tr>
                <tr><td>Sted:</td>
                <td><input type= "text" name= "sted" onchange = 'validerSted()' placeholder="Sted"/><br></td>
                <td><div id= 'feilSted'>*</div></td></tr>
                <tr><td>Telefonnummer:</td>
                <td><input type="text" name="telefon" onchange = 'validerTelefon()' placeholder="Telefonnummer (8 tall)"/><br></td>
                <td><div id= "feilTelefon">*</div></td></tr>
                <tr><td>E-mail:</td>
                <td><input type="text" name="email" onchange = 'validerEmail()' placeholder="eksempel@email.com"/><br></td>
                <td><div id= "feilEmail">*</div></td></tr>
                <tr><td>Passord:</td>
                <td><input type="password" name="passord" onchange = 'validerPassord()' placeholder="Minst 8 tegn, en stor bokstav og 1 tall"/><br></td>
                <td><div id= "feilPassord">*</div></td></tr>
            </table><br>
            <div class="buttonHolder">
				<button onclick="location.href='index.php'" type="button" class="btn btn-danger">Avbryt</button>
                <input type="submit" value="Registrer" name="submit" class="btn btn-success" id="btn"/>
            </div>
        </form>
			<div id="feilmelding">
            <?php
			if(isset($_REQUEST['submit'])){
				$error = validerAlle($_REQUEST['fornavn'], $_REQUEST['etternavn'], $_REQUEST['postnr'], $_REQUEST['sted'], $_REQUEST['telefon'], $_REQUEST['email'], $_REQUEST['passord']);
				if($error != null){
					echo "<script type='text/javascript'>alert('$error')</script>";
				}
				else{
					$dbtilskuer = new DBtilskuer($db->escape($_REQUEST['fornavn']), $db->escape($_REQUEST['etternavn']), $db->escape($_REQUEST['postnr']), $db->escape($_REQUEST['sted']), $db->escape($_REQUEST['telefon']), $db->escape($_REQUEST['email']), $db->escape($_REQUEST['passord']));
					$dbtilskuer->lagreTilskuer();
				}
			}
			?>
			</div>
    </div>

    <div style="position:fixed; bottom:0; height:50px; background-color:grey; text-align:center;
    width:100%; padding-top:15px;">Denne siden har blitt laget av <strong>Jonas, Karl og Sina</strong>.</div>
</body>
</html>
<?php
}
?>
