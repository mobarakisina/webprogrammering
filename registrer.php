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
<form class="form-horizontal" action="" method="post" name="registrer">
<fieldset>

<!-- Form Name -->
<span><h4>Registrer deg her:</h4></span>
<hr>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="fornavn">Fornavn:</label>
  <div class="col-md-6">
  <input id="fornavn" name="fornavn" type="text" placeholder="Fornavn" class="form-control input-md" name="fornavn" onchange = 'validerFornavn()'>
  </div>
  <div id= "feilFornavn">*</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="etternavn">Etternavn:</label>
  <div class="col-md-6">
  <input id="etternavn" name="etternavn" type="text" placeholder="Etternavn" class="form-control input-md" onchange = 'validerEtternavn()'>
  </div>
  <div id= "feilEtternavn">*</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Postnummer">Postnummer</label>
  <div class="col-md-6">
  <input id="Postnummer" name="postnr" type="text" placeholder="Eks: '0549' " class="form-control input-md" onchange = 'validerPostnr()'>
  </div>
  <div id= "feilPostnr">*</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="sted">Sted:</label>
  <div class="col-md-6">
  <input id="sted" name="sted" type="text" placeholder="Sted" class="form-control input-md" onchange = 'validerSted()'>
  </div>
  <div id= 'feilSted'>*</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telefonnummer">Telefonnummer</label>
  <div class="col-md-6">
  <input id="telefonnummer" name="telefon" type="text" placeholder="F.eks. 22222222" class="form-control input-md" onchange = 'validerTelefon()'>
  </div>
  <div id= "feilTelefon">*</div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">E-mail:</label>
  <div class="col-md-6">
  <input id="email" name="email" type="text" placeholder="F.eks. skivm@mail.com" class="form-control input-md" onchange = 'validerEmail()'>
  </div>
  <div id= "feilEmail">*</div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passord">Passord:</label>
  <div class="col-md-6">
    <input id="passord" name="passord" type="password" placeholder="xxxxxxxx" class="form-control input-md" onchange = 'validerPassord()'>
    <span class="help-block">Må inneholde minst åtte tegn, én stor bokstav og ett tall</span>
  </div>
  <div id= "feilPassord">*</div>
</div>

<div class="buttonHolder">
  <button onclick="location.href='index.php'" type="button" class="btn btn-danger">Avbryt</button>
  <input type="submit" value="Registrer" name="submit" class="btn btn-success" id="btn"/>
</div>

</fieldset>
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
    width:100%;padding-top:15px;">Denne siden har blitt laget av <strong>Jonas, Karl og Sina</strong>.</div>
</body>
</html>
<?php
}
?>
