<html>
<script type="text/javascript">
</script>
</html>
<?php
function validerFornavn($fornavn){
    return preg_match("/^[a-zæøåA-ZÆØÅ -]{2,20}$/", $fornavn);
}
function validerEtternavn($etternavn){
  return preg_match("/^[a-zæøåA-ZÆØÅ -]{2,20}$/", $etternavn);
}
function validerPostnr($postnr){
  return preg_match("/^[0-9]{4}$/", $postnr);
}
function validerSted($sted){
 return preg_match("/^[a-zæøåA-ZÆØÅ ,-]{2,20}$/", $sted);
}
function validerTelefon($telefonno){
  return preg_match("/^[0-9]{8}$/", $telefonno);
}
function validerMail($email){
  return preg_match("/^[a-zæøåA-ZÆØÅ0-9 .-]+@[a-zæøåA-ZÆØÅ0-9.-]+\.[a-zæøåA-ZÆØÅ]{2,4}$/i", $email);
}
function validerPassord($passord){
  return preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/", $passord);
}

function validerAlle($fornavn, $etternavn, $postnr, $sted, $telefonno, $email, $passord){
  $error = null;
  if(!validerFornavn($fornavn)){
    $error .= "Feil i fornavn.\\n";
  }
  if(!validerEtternavn($etternavn)){
    $error .= "Feil i etternavn. \\n";
  }
  if(!validerPostnr($postnr)){
    $error .= "Feil i postnummer. \\n";
  }
  if(!validerSted($sted)){
    $error .= "Feil i sted. \\n";
  }
  if(!validerTelefon($telefonno)){
    $error .= "Feil i telefonnummer. \\n";
  }
  if(!validerMail($email)){
    $error .= "Feil i e-mailadresse. \\n";
  }
  if(!validerPassord($passord)){
    $error .= "Feil i passord. ";
  }
  return $error;
}
