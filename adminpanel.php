<?php
require ('navbar.php');
$admin = new admin();
if(isset($_POST['nyUtover']))
{
$admin->nyUtover($db->escape($_REQUEST['fornavn']), $db->escape($_REQUEST['etternavn']), $db->escape($_REQUEST['idrett']), $db->escape($_REQUEST['nasjonalitet']), $db->escape($_REQUEST['kjonn']));
}


if(isset($_POST['submitnyovelse']))
{
$admin->nyOvelse($db->escape($_POST["navn"]), $db->escape($_POST["sted"]), $db->escape($_POST["dato"]), $db->escape($_POST["tid"]));
}


if(isset($_POST['flushutovere']))
{
$admin->flushUtovere();
}

if(isset($_POST['flushovelser']))
{
$admin->flushOvelser();
}

if(isset($_POST['flushpublikum'])){
$admin->flushPublikum();
}

if(isset($_REQUEST['giveAdmin'])){
  $admin->giveAdmin($db->escape($_REQUEST['newAdmin']));
}
if(isset($_REQUEST['slettovelse'])){
  $admin->slettOvelse($_REQUEST['selectSlett']);
}
?>

<?php
if(isset($_SESSION['userid'])){
	if($_SESSION['isadmin'] == 1){ ?>
		<body>
      <div class="container">
        <div class="row vdivide">
      <div class="col-sm-6 text-left" class="form-inline"><h4>Registrere ny øvelse:</h4>
        <div class="form-group">
          <form action="" name="nyovelse" id="" method="post">

          <label for="navn" class="control-label">Navn:</label>
          <input type="text" class="form-control" name="navn" placeholder="Navn">

          <label for="sted" class="control-label">Sted:</label>
          <input type="text" class="form-control" name="sted" placeholder="Sted">

          <label for="sted" class="control-label">Dato:</label>
          <input type="text" name="dato" class="form-control" placeholder="Dato:" />

          <label for="tid" class="control-label">Tid:</label>
          <input type="text" name="tid" class="form-control" placeholder="00:00"/><br>

          <input type="submit" class="btn btn-primary" name="submitnyovelse" value="Registrer ny øvelse"></button>
          </form>
        </div>
      </div>


          <div class="col-sm-6 text-left"><h4>
            Administrative handlinger:</h4>
            <form>
            <select name = "selectSlett">
            <?php $admin->visOvelseDrop(); ?>
            </select>
            <input type = "submit" name = "slettovelse" value = "Slett øvelse">
            </form>
            <p>Endre bruker-privilegier:</p>
            <form action= "" name= "giveadmin" method= "post">
            <p>
              <input type= "text" name ="newAdmin" placeholder="Bruker-ID">
            </p>
            <p>
              <input type="submit" class="btn btn-primary custom" name="giveAdmin" value="Gi administrative rettigheter"></button>

            </p>
            </form>
            <hr>
            <form action="" name="flushutovere" method="post">
            <input type="submit" class="btn btn-danger custom" name="flushutovere" value="Tøm tabell Utøvere" onclick='if(confirm("Er du sikker på at du vil tømme tabellen utøvere?")){return true}else{ return false};'></button>
            </form>

            <form action="" name="flushpublikum" method="post">
            <input type="submit" class="btn btn-danger custom" name="flushpublikum" value="Tøm tabell Publikum" onclick='if(confirm("Er du sikker på at du vil tømme tabellen publikum?")){return true}else{ return false};'></button>

            </form>

            <form action="" name="flushovelser" method="post">
            <input type="submit" class="btn btn-danger custom" name="flushovelser" value="Tøm tabell Øvelser" onclick='if(confirm("Er du sikker på at du vil tømme tabellen øvelser?")){return true}else{ return false};'></button>

            </form>
          </div>
        </div>
        </div>

<div class="panel-group" id="accordion5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion5" href="#collapseFive"> <strong>Utøvere</strong><br></a></h4>
      </div>
      </div>
      </div>
      <div id="collapseFive" class="panel-collapse collapse">
        <div class="panel-body">
         <div class="panel-group" id="accordion6">
          <table id="RedigerUtovere">
            <th>Fornavn</th>
            <th>Etternavn</th>
            <th>Fullt navn</th>
            <th>Idrett</th>
            <th>Nasjonalitet</th>
            <th>Kjønn</th>
            <th>Slett utøver fra utøverlisten</th>
        <tbody>

          <div class="col-sm-12 text-left" class="form-inline"><h4>Registrer ny utøver:</h4>
            <div class="form-group">
              <form action="" name="nyutover" id="" method="post">

              <label for="navn" class="control-label">Fornavn:</label>
              <input type="text" class="form-control" name="fornavn" placeholder="Fornavn:">

              <label for="sted" class="control-label">Etternavn:</label>
              <input type="text" class="form-control" name="etternavn" placeholder="Etternavn:">

              <label for="sted" class="control-label">Idrett:</label>
              <input type="text" name="idrett" class="form-control" placeholder="Idrett:" />

              <label for="tid" class="control-label">Nasjonalitet:</label>
              <input type="text" name="nasjonalitet" class="form-control" placeholder="Bruk forkortelse på tre bokstaver. For eks: 'NOR')"/><br>


              <label for="kjonn" class="control-label">Velg kjønn</label>

              <select class="form-control" id="kjonn" name="klasse">
                <option value="kvinner">Kvinner</option>
                <option value="menn">Menn</option>
              </select>
<br/>
              <input type="submit" class="btn btn-primary" name="nyUtover" value="Registrer ny utøver"></button>
                      <?php $db->visUtovere(); ?>
                      </table>
                      </form>

            </div>
          </div>
          </div>



<div class="panel-group" id="accordion3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree"> <strong>Øvelser</strong><br></a></h4>
      </div>
      </div>
      </div>
      <div id="collapseThree" class="panel-collapse collapse">
        <div class="panel-body">
         <div class="panel-group" id="accordion4">
          <table id="RedigerOvelser">
            <th>Navn</th>
            <th>Sted</th>
            <th>Dato</th>
            <th>Tid</th>
            <?php $db->visOvelser(); ?>


            </table>

<div class="panel-group" id="accordion11">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion11" href="#collapseEleven"> <strong>Publikum</strong><br></a></h4>
      </div>
      <div id="collapseEleven" class="panel-collapse collapse">
        <div class="panel-body">
         <div class="panel-group" id="accordion11">
          <table id="RedigerPublikum">
            <th>Fornavn</th>
            <th>Etternavn</th>
            <th>Postnr</th>
            <th>Sted</th>
            <th>Telefonnr.</th>
            <th>Email</th>
            <th>Slett publikum fra publikumslisten</th>

        <tbody>
        <?php
            $connect = mysqli_connect('localhost', 'root', '','skivm');
            if (!$connect) {
            }
            $sql = "SELECT * FROM publikum";
            $results = mysqli_query($connect, $sql);
            while($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                <td><?php echo $row['fornavn']?></td>
                <td><?php echo $row['etternavn']?></td>
                <td><?php echo $row['postnr']?></td>
                <td><?php echo $row['sted']?></td>
                <td><?php echo $row['telefonno']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo "<td><input type=\"submit\" name=\"submit\" value=\"Slett\" id=\"submit\"></td></tr>";?></td>
                </tr>

            <?php
            }

            ?>
             </tbody>
            </table>
            <?php
}
	else{
		echo "Du er ikke admin, og har derfor ikke tilgang til denne siden.";
	}
}
else{
	echo "Du er ikke logget inn. Vennligst logg inn på en admin-konto.";
}
?>
</body>
</html>
