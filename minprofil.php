<?php
require ('navbar.php');

if(isset($_REQUEST['oppdater'])){
		$error = validerAlle($_REQUEST['fornavn'], $_REQUEST['etternavn'], $_REQUEST['postnr'], $_REQUEST['sted'], $_REQUEST['telefon'], $_REQUEST['email'], $_REQUEST['passord']);
		if($error != null){
			echo "<script type='text/javascript'>alert('$error')</script>";
		}
		else{
			if($db->checkPassword($_REQUEST['passord'])){
				$dbtilskuer = new DBtilskuer($db->escape($_REQUEST['fornavn']), $db->escape($_REQUEST['etternavn']), $db->escape($_REQUEST['postnr']), $db->escape($_REQUEST['sted']), $db->escape($_REQUEST['telefon']), $db->escape($_REQUEST['email']), $db->escape($_REQUEST['passord']));
				$dbtilskuer->oppdaterTilskuer();
			}
			else{
				echo "Du har skrevet inn feil passord. Vennligst prøv igjen.";
			}
		}
}

if(isset($_REQUEST['updatePass'])){
	if($_REQUEST['password1'] == $_REQUEST['password2']){
		if(validerPassord($_REQUEST['password1'])){
			$db->changePassword($_REQUEST['password1']);
		}
		else{
			echo "Sørg for at passordet ditt inneholder et tall og en stor forbokstav.";
		}
	}
	else{
		echo "Sørg for at passordene dine matcher.";
	}
}
?>
<body>
<h5>Du kan her endre din profil:</h5>
<?php
if(isset($_SESSION['userid'])){
?>
<script type= "text/javascript">
function validerFornavn(){
regEx = /^[a-zA-ZæøåÆØÅ .\-]{2,20}$/;
OK = regEx.test(document.oppdaterInfo.fornavn.value);
  if(!OK){
    document.getElementById('feilFornavn').innerHTML='Feil i fornavn';
    return false;
  }
  document.getElementById('feilFornavn').innerHTML='';
  return true;
}

function validerEtternavn(){
regEx = /^[a-zA-ZæøåÆØÅ .\-]{2,20}$/;
OK = regEx.test(document.oppdaterInfo.etternavn.value);
    if(!OK){
        document.getElementById('feilEtternavn').innerHTML='Feil i etternavn';
        return false;
    }
    document.getElementById('feilEtternavn').innerHTML='';
    return true;
}

function validerPostnr(){
regEx = /^[0-9]{4}$/;
OK = regEx.test(document.oppdaterInfo.postnr.value);
    if(!OK){
        document.getElementById('feilPostnr').innerHTML='Feil i postnummer';
        return false;
    }
    document.getElementById('feilPostnr').innerHTML='';
    return true;
}

function validerSted(){
regEx = /^[a-zæøåA-ZÆØÅ ,-]{2,20}$/;
OK = regEx.test(document.oppdaterInfo.sted.value);
    if(!OK){
        document.getElementById('feilSted').innerHTML='Feil i sted';
        return false;
    }
    document.getElementById('feilSted').innerHTML='';
    return true;
}

function validerEmail(){
regEx = /^[a-zæøåA-ZÆØÅ0-9 .-]+@[a-zæøåA-ZÆØÅ0-9.-]+\.[a-zA-z]{2,4}$/;
OK = regEx.test(document.oppdaterInfo.email.value);
    if(!OK){
        document.getElementById('feilEmail').innerHTML='Feil i E-mail';
        return false;
    }
    document.getElementById('feilEmail').innerHTML='';
    return true;
}

function validerTelefon(){
regEx = /^[0-9]{8}$/;
OK = regEx.test(document.oppdaterInfo.telefon.value);
    if(!OK){
        document.getElementById('feilTelefon').innerHTML='Feil i telefonnr';
        return false;
    }
    document.getElementById('feilTelefon').innerHTML='';
    return true;
}

function validerPassord(){
regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
OK = regEx.test(document.oppdaterInfo.passord.value);
    if(!OK){
        document.getElementById('feilPassord').innerHTML='Feil i passord';
        return false;
    }
    document.getElementById('feilPassord').innerHTML='';
    return true;
}
function validerPassord1(){
regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
OK = regEx.test(document.changePass.password1.value);
    if(!OK){
        document.getElementById('feilPassord1').innerHTML='Feil i passord';
        return false;
    }
    document.getElementById('feilPassord1').innerHTML='';
    return true;
}
function validerPassord2(){
regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
OK = regEx.test(document.changePass.password2.value);
    if(!OK){
        document.getElementById('feilPassord2').innerHTML='Feil i passord';
        return false;
    }
    document.getElementById('feilPassord2').innerHTML='';
    return true;
}
</script>
<div class="jumbotron vertical-center">

	<div class="row">
      <div class="col-md-12 personal-info" id="oppdaterInfo">
        <h3>Endre din profil</h3>
					<br>
        <form class="form-horizontal" role="form" action="" method="post" name="oppdaterInfo">
          <div class="form-group">
            <label class="col-lg-3 control-label">Fornavn:</label>
            <div class="col-lg-6">
              <input class="form-control" name="fornavn" placeholder = "vise eksisterende info med ajax" onchange = 'validerFornavn()'/>
            </div>
						<div id= "feilFornavn">*</div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Etternavn:</label>
            <div class="col-lg-6">
              <input class="form-control" type="text" name="etternavn" placeholder = "vise eksisterende info med ajax" onchange = 'validerEtternavn()'/>
            </div>
						<div id= "feilEtternavn">*</div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Postnummer:</label>
            <div class="col-lg-6">
              <input class="form-control" type="text" name="postnr" placeholder = "vise eksisterende info med ajax" onchange = 'validerPostnr()'/>
            </div>
						<div id= "feilPostnr">*</div>
          </div>
					<div class="form-group">
						<label class="col-lg-3 control-label">Sted:</label>
						<div class="col-lg-6">
							<input class="form-control" type="text" name= "sted" placeholder = "vise eksisterende info med ajax" onchange = 'validerSted()'/>
						</div>
						<div id= "feilSted">*</div>
					</div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Telefonnummer:</label>
            <div class="col-lg-6">
              <input class="form-control" type="text" name="telefon" placeholder = "vise eksisterende info med ajax" onchange = 'validerTelefon()'/>
            </div>
						<div id= "feilTelefon">*</div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">E-mail:</label>
            <div class="col-md-6">
              <input class="form-control" type="text" name="email" placeholder = "vise eksisterende info med ajax" onchange = 'validerEmail()'/>
            </div>
						<div id= "feilEmail">*</div>
          </div>
					<br>
					<h5>Vennligst skriv inn passordet ditt for å bekrefte endringer</h5>
          <div class="form-group">
            <label class="col-lg-3 control-label">Passord:</label>
            <div class="col-md-6">
              <input class="form-control" type="password" name="passord" placeholder = "vise eksisterende info med ajax" onchange = 'validerPassord()'/>
            </div>
						<div id= "feilPassord">*</div>
          </div>
          <div class="form-group">
            <label class="col-md-5 control-label"></label>
            <div class="col-md-4">
              <input type="submit" class="btn btn-primary" input type="submit" value="Oppdater" name="oppdater">
              <span></span>
							<button onclick="location.href='index.php'" type="button" class="btn btn-danger">Avbryt</button>
            </div>
          </div>
        </form>
				<br/>
				  <form class="form-horizontal" role="form" action = "" method="post" name="changePass">
						<h5>Skriv inn ditt nye passord for å endre passord:</h5>
						<div class="form-group">
							<label class="col-lg-3 control-label">Passord:</label>
							<div class="col-md-6">
								<input class="form-control" type="password" name="password1" placeholder="Passordet må bestå av minst 8 bokstaver, en stor bokstav og 1 tall" onchange='validerPassord1()'/>
							</div>
							<div id= "feilPassord1">*</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Bekreft passord:</label>
							<div class="col-md-6">
								<input class="form-control" type="password" name="password2" placeholder = "Passordet må bestå av minst 8 bokstaver, en stor bokstav og 1 tall"onchange='validerPassord2()'/>
							</div>
							<div id= "feilPassord2">*</div>
						</div>
						<div class="form-group">
							<label class="col-md-5 control-label"></label>
							<div class="col-md-4">
								<input type="submit" class="btn btn-primary" input type= "submit" name= "updatePass" id="updatePass" value="Oppdater">
							</div>
						</div>
					</form>
  	</div>
	</div>
</div>
 </body>
<?php
}
else{
	echo "Du har ikke tilgang til denne siden.";
	die();
}
?>
<div style="position:fixed; bottom:0; height:50px; background-color:grey; text-align:center;
width:100%; padding-top:15px;">Denne siden har blitt laget av <strong>Jonas, Karl og Sina</strong>.</div>
</body>
</html>
