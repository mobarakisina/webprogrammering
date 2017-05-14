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
<br><h3 align="center"><strong>Oversikt over lister for SKI-VM 2019</strong></h3><br>

<div class="panel-group" id="accordion5">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion13" href="#collapseThirteen"> <strong>List alle øvelser</strong> </a></h4>
</div>
<div id="collapseThirteen" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion13">
    <table id="Ovelser">
        <th onclick="sorterTabellOvelser(0)">Øvelse</th>
        <th onclick="sorterTabellOvelser(1)">Dato</th>
        <th onclick="sorterTabellOvelser(2)">Tid</th>
        <th onclick="sorterTabellOvelser(3)">Sted</th>
        <th>Meld på</th>
        <?php if(isset($_SESSION['userid'])){?>
        <th>Meld på</th> <?php } ?>
        <tbody>
        <?php
        $connect = mysqli_connect('localhost', 'root', '','skivm');
        if (!$connect) {
        }
        $sql = "SELECT * FROM ovelser";
        $result = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $row['navn']?></td> 
                <td><?php echo $row['dato']?></td>
                <td><?php echo $row['tid']?></td>
                <td><?php echo $row['sted']?></td>          
                <td><a class="meldpalink" onclick="meldPa('.$_SESSION['userid'].')"><img src="meldpa.png" width="25px" height="20px" name="MeldPaa" alt="MeldPaa" />Meld på</a></td>
                 


                <?php if(isset($_SESSION['userid']))
                { ?>
                <?php } ?>          
                <?php if(isset($_SESSION['userid'])){?><td><form> 
                    <input type= "submit" name = <?php echo "meld" . $counter; ?> value = "Meld deg på">
                    </form></td>
                <?php } ?>               
            </tr>
        <?php
        }
        function signUp($navn){
            $userid = $_SESSION['userid'];
            $db = $this->conn();
            $sql = "SELECT ovelsesid FROM ovelser WHERE navn = '$navn'";
            $sql = "INSERT INTO ovelser (ovelsesid, userid)";
            $sql .= "VALUES ('$ovelsesid', '$userid')";
        }
        ?>
        </tbody>
    </table><br/>
</div>
</div>
</div>
</div>
</div>
<div class="panel-group" id="accordion1">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo"> <strong>List alle utøvere</strong> </a> </h4>
</div>
<div id="collapseTwo" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion2">
    <table>
    <th> Fornavn </th>
    <th>Etternavn </th>
    <th> Idrett </th>
    <th> Nasjonalitet </th>
    <th> Kjønn </th>
    <?php $db->visUtovere(); ?>
    </table>
   <br/>        
</div>
</div>
</div>
</div>
</div>
<div class="panel-group" id="accordion3">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion3" href="#collapseThree"><strong>Kl. 13:30 - Tirsdag 10.12</strong><br> Langrenn, 10 km, herrer </a> <a class="meldpalinkstor" onclick="meldPa('.$row['fornavn'].')"><img src="meldpa.png" width="25px" height="20px" name="MeldPaa" alt="MeldPaa" />Meld på</a></h4>
</div>
<div id="collapseThree" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion4">
    <table id="Langrenn10">
        <th onclick="sorterTabellLangrenn10(0)">Utøvere</th>
        <th>Meld på</th>
        <th onclick="sorterTabellLangrenn10(1)">Registrerte publikum</th>
        <tbody>
        <?php
        $connect = mysqli_connect('localhost', 'root', '','skivm');
        if (!$connect) {
        }
        $sql = "SELECT * FROM utovere WHERE idrett = 'Langrenn'";
        $results = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($results)) {
        ?>
            <tr>
                <td><?php echo $row['helt navn']?></td> 
                <td><?php echo $row['nasjonalitet']?></td>
                <td><?php echo $row['nasjonalitet']?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

          
</div>
</div>
</div>
</div>
</div>
<div class="panel-group" id="accordion5">
<div class="panel panel-default">
 <div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion5" href="#collapseFive"> <strong>Kl. 18:30 - Onsdag 11.12</strong><br>Skihopp, normalbakke, herrer </a></h4>
</div>
<div id="collapseFive" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion6">
    <table id="Skihopp11">
        <th onclick="sorterTabellSkihopp11(0)">Utøvere</th>
        <th>Meld på</th>
        <th onclick="sorterTabellSkihopp11(1)">Registrerte publikum</th>
        <tbody>
        <?php
        $connect = mysqli_connect('localhost', 'root', '','skivm');
        if (!$connect) {
        }
        $sql = "SELECT * FROM utovere WHERE idrett = 'Skihopp' AND kjonn = 'mann'";
        $results = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($results)) {
        ?>
            <tr>
                <td><?php echo $row['helt navn']?></td> 
                <td><?php echo $row['nasjonalitet']?></td>
                <td><?php echo $row['nasjonalitet']?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
        </table>
</div><br/>
</div>
</div>
</div>
<div class="panel-group" id="accordion7">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion7" href="#collapseSeven"><strong>Kl. 12:00 - Fredag 13.12</strong><br> Langrenn, stafett, damer </a></h4>
</div>
<div id="collapseSeven" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion7">
    <table id="Langrenn13">
        <th onclick="sorterTabellLangrenn13(0)">Lag</th>
        <th>Meld på</th>
        <th onclick="sorterTabellLangrenn13(1)">Registrerte publikum</th>
        <tbody>
        <?php    
        $connect = mysqli_connect('localhost', 'root', '','skivm');
        if (!$connect) {
        }
        $sql = "SELECT * FROM stafettlag WHERE idrett = 'Langrenn' AND klasse = 'kvinner'";
        $results = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($results)) {
        ?>
            <tr>
                <td><?php echo $row['land']?></td> 
                <td><?php echo $row['nasjonalitet']?></td>
                <td><?php echo $row['nasjonalitet']?></td>
            </tr>

        <?php
        }
        ?>
        </tbody>
    </table><br/>         
</div>
</div>
</div>
</div>
</div>
<div class="panel-group" id="accordion5">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion9" href="#collapseNine"><strong>Kl. 17:30 - Fredag 13.12</strong><br>Skihopp, lagkonkurranse, mix </a></h4>
</div>
<div id="collapseNine" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion9">
    <table id="Skihopp13">
        <th onclick="sorterTabellSkihopp13(0)">Lag</th>
        <th>Meld på</th>
        <th onclick="sorterTabellSkihopp13(1)">Registrerte publikum</th>
        <tbody>
        <?php
        $connect = mysqli_connect('localhost', 'root', '','skivm');
        if (!$connect) {
        }
        $sql = "SELECT * FROM stafettlag WHERE idrett = 'Skihopp' AND klasse= 'mix'";
        $results = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($results)) {
        ?>
            <tr>
                <td><?php echo $row['land']?></td> 
                <td><?php echo $row['nasjonalitet']?></td>
                <td><?php echo $row['nasjonalitet']?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
    </table><br/>
</div>
</div>
</div>
<div class="panel-group" id="accordion5">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion11" href="#collapseEleven"> <strong>Kl. 14:00 - Lørdag 14.12</strong><br>Skiskyting, fellesstart, kvinner </a></h4>
</div>
<div id="collapseEleven" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion11">
    <table id="Skiskyting14">
        <th onclick="sorterTabellSkiskyting14(0)">Utøvere</th>
        <th>Meld på</th>
        <th onclick="sorterTabellSkiskyting14(1)">Registrerte publikum</th>
        <tbody>
        <?php   
        $connect = mysqli_connect('localhost', 'root', '','skivm');
        if (!$connect) {
        }
        $sql = "SELECT * FROM utovere WHERE idrett = 'skiskyting' AND kjonn='kvinne'";
        $results = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($results)) {
        ?>
            <tr>
                <td><?php echo $row['helt navn']?></td> 
                <td><?php echo $row['nasjonalitet']?></td>
                <td><?php echo $row['nasjonalitet']?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>          
</div>
</div>
</div>
</div>
</div>
<div class="panel-group" id="accordion5">
<div class="panel panel-default">
<div class="panel-heading">
    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion17" href="#collapseSeventeen"> <strong>Kl. 19:00 - Lørdag 14.12</strong><br>Skøyter, 5000 meter, menn </a></h4>
</div>
<div id="collapseSeventeen" class="panel-collapse collapse">
<div class="panel-body">
<div class="panel-group" id="accordion17">
    <table id="Skoyter14">
        <th onclick="sorterTabellSkoyter14(0)">Utøvere</th>
        <th>Meld på</th>
        <th onclick="sorterTabellSkoyter14(0)">Registrerte publikum</th>
        <tbody>
        <?php
        $connect = mysqli_connect('localhost', 'root', '','skivm');
        if (!$connect) {
        }
        $sql = "SELECT * FROM utovere WHERE idrett = 'skoyter' and kjonn='mann'";
        $results = mysqli_query($connect, $sql);
        while($row = mysqli_fetch_array($results)) {
        ?>
            <tr>
                <td><?php echo $row['helt navn']?></td> 
                <td><?php echo $row['nasjonalitet']?></td>
                <td><?php echo $row['nasjonalitet']?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table><br/>
</div>
</div>
</div>
</div>
</div>
 <!--
  <div class="panel-group" id="accordion5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion19" href="#collapseNineteen"> (ØVELSE) </a></h4>
      </div>
      <div id="collapseNineteen" class="panel-collapse collapse">
        <div class="panel-body">

        

          <div class="panel-group" id="accordion19">
              <table>
              <tr>
                <th>Utøver</th>
                <th>Nasjonalitet</th>
                <th>Sted</th>
                <th>Dato</th>
                <th>Tid</th>
              </tr>
              <tr>
                <td>Alfreds Futterkiste</td>
                <td>Brasil</td>
                <td>Bane 3</td>
                <td>17/05</td>
                <td>14:00</td>
              </tr>
              </table>
              <br/>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion20" href="#collapseInnerTwenty"> Publikummere </a></h4>
              </div>
              <div id="collapseInnerTwenty" class="panel-collapse collapse in">
                <div class="panel-body">
                  <table>
                  <tr>
                    <th>Navn</th>
                    <th>Valgt konkurranse</th>
                  </tr>
                  <tr>
                    <td>Alfreds Mutterkiste</td>
                    <td>Skiskyting</td>

                  </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

         

        </div>
      </div>
    </div>
  </div>

  <div class="panel-group" id="accordion5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion21" href="#collapseTwentyone"> (ØVELSE) </a></h4>
      </div>
      <div id="collapseTwentyone" class="panel-collapse collapse">
        <div class="panel-body">

         

          <div class="panel-group" id="accordion19">
              <table>
              <tr>
                <th>Utøver</th>
                <th>Nasjonalitet</th>
                <th>Sted</th>
                <th>Dato</th>
                <th>Tid</th>
              </tr>
              <tr>
                <td>Alfreds Futterkiste</td>
                <td>Brasil</td>
                <td>Bane 3</td>
                <td>17/05</td>
                <td>14:00</td>
              </tr>
              </table>
              <br/>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion22" href="#collapseInnerTwentytwo"> Publikummere </a></h4>
              </div>
              <div id="collapseInnerTwentytwo" class="panel-collapse collapse in">
                <div class="panel-body">
                  <table>
                  <tr>
                    <th>Navn</th>
                    <th>Valgt konkurranse</th>
                  </tr>
                  <tr>
                    <td>Alfreds Mutterkiste</td>
                    <td>Skiskyting</td>

                  </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

          
        </div>
      </div>
    </div>
  </div>

</div>
</div>-->
</body>
</html>
