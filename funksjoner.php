<html>
<script type="text/javascript">
function sorterTabellOvelser(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Ovelser");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}


function sorterTabellUtovere(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Utovere");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}





function sorterTabellLangrenn10(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Langrenn10");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}





function sorterTabellSkihopp11(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Skihopp11");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}




function sorterTabellLangrenn13(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Langrenn13");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}



function sorterTabellSkiskyting14(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Skiskyting14");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}



function sorterTabellSkoyter14(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Skoyter14");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}



function sorterTabellSkihopp13(n) {
  var tabell, rader, switching, i, a, b, skalSwitche, dir, switcheAntall = 0;
  table = document.getElementById("Skihopp13");
  switche = true;
  dir = "asc";
  while (switche) {
    switche = false;
    rader = table.getElementsByTagName("TR");
    for (i = 1; i < (rader.length - 1); i++) {
      skalSwitche = false;
      a = rader[i].getElementsByTagName("TD")[n];
      b = rader[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      } else if (dir == "desc") {
        if (a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
          skalSwitche= true;
          break;
        }
      }
    }
    if (skalSwitche) {
      rader[i].parentNode.insertBefore(rader[i + 1], rader[i]);
      switche = true;
      switcheAntall ++;
    } else {
       if (switcheAntall == 0 && dir == "asc") {
        dir = "desc";
        switche = true;
      }
    }
  }
}

function slettUtover(fornavn) {
  $.post("delete.php" , {fornavn} , function(data){
    $("fornavn").fadeOut('slow' , function(){$(this).remove();if(data)alert(data);});
  });
    }


function meldPaa(){
  ;
}

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
