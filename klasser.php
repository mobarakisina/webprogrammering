<?php 
$ini = parse_ini_file("../../../config.ini");
class database {
private $DBhost;
private $DBuser;
private $DBpass;
private $DBname;

public function __construct(){
		$this->DBhost = $ini['DBhost'];
		$this->DBuser = $ini['DBuser'];
		$this->DBpass = $ini['Bpass'];
		$this->DBname = 's315754';
}

public function conn(){
	return new mysqli($this->DBhost, $this->DBuser, $this->DBpass, $this->DBname);
}

public function escape($query){
	return mysqli_real_escape_string($this->conn(), $query);
}
	
public function login($email, $passord){
	$db = $this->conn();
	if($db->connect_error){
		echo "<script type='text/javascript'>alert('Klarte ikke koble til database. Vennligst prøv igjen senere.')</script>";
		trigger_error($db->connect_error);
	}
	$email = $this->escape($email);
	$sql = "SELECT salt, passord FROM bruker WHERE email = '$email' ";
	$result = $db->query($sql);
	if($db->affected_rows==1){
		$row = $result->fetch_object();
		$passHash = $row->passord;
		$salt = $row->salt;
		$hashPass = hash("sha1", $this->escape($passord) . $salt);
		if($hashPass  == $passHash){
			$sql = "SELECT userid, isadmin FROM bruker WHERE email = '$email'";
			$result = $db->query($sql);
			if($db->affected_rows == 1){
				$row = $result->fetch_object();
				$userid = $row->userid;
				$isadmin = $row->isadmin;
			}
			$_SESSION['userid'] = $userid;
			$_SESSION['isadmin'] = $isadmin;
			$url = $_SERVER['PHP_SELF'];
			header("Location: $url");
		}
		else{
			echo "Feil e-mailadresse eller passord.<br><br>";
		}
	}
	else{
		echo "<script type='text/javascript'>alert('Innlogging feilet.');</script>";
	}
	$db->close();
}

public function sendMail($email){
	$email = $this->escape($email);
	$db = $this->conn();
	if($db->connect_error){
		echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
		trigger_error($db->connect_error);
	}
	$sql = "SELECT * FROM bruker WHERE email = '$email' ";
	$result = $db->query($sql);
	if($db->affected_rows == 1){
	$time = $_SERVER['REQUEST_TIME'];
	$sql = "UPDATE bruker SET tstamp = '$time' WHERE email = '$email'";
	$result = $db->query($sql);
	if($db->affected_rows == 1){
		$subject = "Ski-VM - Tilbakestilling av passord";
			function createLink($email){
				$db = new mysqli ($ini['DBhost'], $ini['DBuser'], $ini['DBpass'], "s315754");
				if($db->connect_error){
					echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
					trigger_error($db->connect_error);
				}
				$sql = "SELECT salt, token, tstamp FROM bruker WHERE email = '$email'";
				$result = $db->query($sql);
				if($db->affected_rows == 1){
					$row = $result->fetch_object();
					$token = $row->token;
					$tstamp = $row->tstamp;
					$hashedquery = hash("sha1", $token . $tstamp);
					$sql = "UPDATE bruker SET hashedquery = '$hashedquery' WHERE email = '$email'";
					$result = $db->query($sql);
					if($db->affected_rows){
						return "<a href= 'http://student.cs.hioa.no/~s315754/webprogrammering/skivm/tilbakestill.php?$hashedquery'> Tilbakestill passord</a>";
					}
					else{
						echo "Klarte ikke å opprette en tilbakestillings-link.";
					}
				}
				else{
					echo "Fant ikke e-mailadresse i systemet.";
				}
			}
			$link = createLink($email);
			$body = "Hei $email!\n\n Noen har bedt om å få tilbakestilt passordet på din bruker. For å gjøre dette, vennligst trykk på linken nedenfor. <br><br>$link<br><br> Dersom du ikke har bedt om å tilbakestille passordet ditt kan du ignorere denne mailen.";
			$headers = "Content-Type: text/html;";
			if(mail($email, $subject, $body, $headers)){
				header("Location: sendt.php");
			}
			else{
				echo "Din mail ble ikke sendt. Vennligst prøv igjen senere. <br><br>";
			}
		}
		else{
			echo "Serveren opplever for øyeblikket problemer med å oppdatere brukerkontoen din.<br><br>";
		}
	}
	else{
		echo "Det oppsto en feil og mailen ble ikke sendt. Vennligst prøv igjen senere.<br><br>";
	}
	$db->close();
}

public function checkLink($query){
	$db = $this->conn();
	if($db->connect_error){
		echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
		trigger_error($db->connect_error);
	}
	$query = $this->escape($query);
	$sql = "SELECT tstamp FROM bruker WHERE hashedquery = '$query'";
	$result = $db->query($sql);
	if($db->affected_rows == 1){
		$row = $result->fetch_object();
		$tstamp = $_SERVER['REQUEST_TIME'] - $row->tstamp;
		$day = 86400;
		if( $day > $tstamp){
			return true;
		}
		else{
			return false;
		}
	}
	else{
		echo "Ugyldig link. Sørg for at du ikke har endret på den.";
	}
	$db->close();
}

public function checkPassword($password){
	$userid = $_SESSION['userid'];
	$db = $this->conn();
	if($db->connect_error){
		echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
		trigger_error($db->connect_error);
	}
	$sql = "SELECT salt, passord FROM bruker WHERE userid = '$userid' ";
	$result = $db->query($sql);
	if($db->affected_rows==1){
		$row = $result->fetch_object();
		$passHash = $row->passord;
		$salt = $row->salt;
		$hashPass = hash("sha1", $this->escape($password) . $salt);
		if($hashPass == $passHash){
			return true;
		}
		else{
			return false;
		}
	}
	else{
		echo "Fant ikke din bruker-id.";
	}
	$db->close();
}

public function changePassword($password){
	$userid = $_SESSION['userid'];
	$db = $this->conn();
	if($db->connect_error){
  		echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
    	trigger_error($db->connect_error);
  	}
  	$salt = uniqid(mt_rand(), true);
  	$hashPass = hash("sha1", $this->escape($password) . $salt);
  	$sql = "UPDATE bruker SET passord = '$hashPass', salt = '$salt' WHERE userid = '$userid'";
  	$result = $db->query($sql);
  	if($result){
  		echo "Passord oppdatert";
  	}
  	else{
		$rowAmount= $db->affected_rows;
		if($rowAmount == 0){
			echo "Kunne ikke sette data inn i database.<br>";
			trigger_error("Insert return 0 rows");
		}
	}
 }


public function updatePassword($query, $passord){
	$db = $this->conn();
  	if($db->connect_error){
  		echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
    	trigger_error($db->connect_error);
  	}
  	$query = $this->escape($query);
	$sql = "SELECT salt FROM bruker WHERE hashedquery = '$query'";
	$result = $db->query($sql);
	if($db->affected_rows == 1){
		$row = $result->fetch_object();
		$salt = $row->salt;
		$hashedPass = hash("sha1", $this->escape($passord) . $salt);
		$sql = "UPDATE bruker SET passord = '$hashedPass', tstamp = '', hashedquery = '' WHERE hashedquery = '$query'";
		$result = $db->query($sql);
    	if(!$result){
      		echo "Klarte ikke å oppdatere passord.";
      		mysqli_error($db);
    	}
    	else{
      		header("Location: index.php");
    	}
	}
  	else{
    	echo "Noe gikk galt. Vennligst prøv igjen senere.";
	}
	$db->close();
}

public function visOvelse($ovelse){
	$db = $this->conn();
	if($db->connect_error){
		echo "<script type='text/javascript'>alert('Klarte ikke koble til database. Vennligst prøv igjen senere.')</script>";
		trigger_error($db->connect_error);
	}
	$sql = "SELECT * FROM ovelser";
}

public function visUtovere(){
	$db = $this->conn();
	if($db->connect_error){
		echo "<script type='text/javascript'>alert('Klarte ikke koble til database. Vennligst prøv igjen senere.')</script>";
		trigger_error($db->connect_error);
	}
	$sql = "SELECT * FROM utovere";
	$result = $db->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo "
			<tr>
			<td> " . $row['fornavn'] . " </td>
			<td> " . $row['etternavn'] . " </td>
			<td> " . $row['idrett'] . " </td>
			<td> " . $row['nasjonalitet'] . " </td>
			<td> " . $row['kjonn'] . " </td>
			</tr>
			";
		}
	}
	else{
		echo "Fant ingen utøvere i databasen.";
	}

}

}
class DBtilskuer{
private $DBhost;
private $DBuser;
private $DBpass;
private $DBname;

public function __construct($fornavn, $etternavn, $postnr, $sted, $telefonno, $email, $passord){
	$this->fornavn = $fornavn;
	$this->etternavn = $etternavn;
	$this->postnr = $postnr;
	$this->sted = $sted;
	$this->telefonno = $telefonno;
	$this->email = $email;
	$this->salt = uniqid(mt_rand(), true);
	$this->passord = hash("sha1", $passord . $this->salt);
	$this->token = md5(uniqid());
	$this->DBhost = $ini['DBhost'];
	$this->DBuser = $ini['DBuser'];
	$this->DBpass = $ini['Bpass'];
	$this->DBname = 's315754';
}

public function conn(){
	return new mysqli($this->DBhost, $this->DBuser, $this->DBpass, $this->DBname);
}

public function lagreTilskuer(){
	$db = $this->conn();
	if($db->connect_error){
		echo "Klarte ikke koble til database.<br>";
		trigger_error($db->connect_error);
	}
	$findMail = "SELECT email FROM bruker WHERE email = '$this->email'";
	$checkMail = $db->query($findMail);
	if($db->affected_rows == 1){
		echo "Denne e-mailadressen ligger allerede i våre systemer. Vennligst bruk en annen.";
	}
	else{
		$sql = "INSERT INTO bruker (fornavn, etternavn, postnr, sted, telefonno, email, salt, passord, token)";
		$sql .= "Values ('$this->fornavn', '$this->etternavn', '$this->postnr', '$this->sted', '$this->telefonno', '$this->email', '$this->salt', '$this->passord', '$this->token')";
		$result = $db->query($sql);
		if(!$result){
			echo "Klarte ikke sette inn i databaseeee.<br>";
			mysqli_error($db);
		}
		else{
			$rowAmount= $db->affected_rows;
			if($rowAmount == 0){
				echo "Kunne ikke sette data inn i database.<br>";
				trigger_error("Insert return 0 rows");		
			}
		$db->close();
		header("Location: index.php");
		}
	}
}

public function oppdaterTilskuer(){
	$userid = $_SESSION['userid'];
	$db = $this->conn();
	if($db->connect_error){
		echo "Klarte ikke koble til database.<br>";
		trigger_error($db->connect_error);
	}
	$sql = "UPDATE bruker SET fornavn = '$this->fornavn', etternavn = '$this->etternavn', postnr = '$this->postnr', sted = '$this->sted', telefonno = '$this->telefonno', email = '$this->email' WHERE userid = '$userid'";
	$result = $db->query($sql);
	if($result){
		echo "Data oppdatert.";
	}
	else{
		$rowAmount= $db->affected_rows;
		if($rowAmount == 0){
			echo "Kunne ikke sette data inn i database.<br>";
			trigger_error("Insert return 0 rows");
		}
	}
	$db->close();
}

}

class admin {
public function __construct(){
	$this->DBhost = $ini['DBhost'];
	$this->DBuser = $ini['DBuser'];
	$this->DBpass = $ini['Bpass'];
	$this->DBname = 's315754';
}

public function conn(){
	return new mysqli($this->DBhost, $this->DBuser, $this->DBpass, $this->DBname);
}

public function giveAdmin($userid){
	$db = $this->conn();
	if($db->connect_error){
	  	echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
	    trigger_error($db->connect_error);
	}
	$sql = "UPDATE bruker SET isadmin = '1' WHERE userid = '$userid'";
	$result = $db->query($sql);
	if($result){
		echo "Admin-priviliegier gitt.";
	}
	else{
			$rowAmount= $db->affected_rows;
			if($rowAmount == 0){
				echo "Kunne ikke sette data inn i database.<br>";
				trigger_error("Insert return 0 rows");
			}
		}
	$db->close();
}

public function nyUtover($fornavn, $etternavn, $idrett, $nasjonalitet, $kjonn){
	$fulltnavn = $fornavn . " " . $etternavn;
	$db = $this->conn();
	if($db->connect_error){
		echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
		trigger_error($db->connect_error);
	}
	$sql = "INSERT INTO utovere (fornavn, etternavn, fulltnavn, idrett, nasjonalitet, kjonn)";
	$sql .= "VALUES ('$fornavn', '$etternavn', '$fulltnavn', '$idrett', '$nasjonalitet', '$kjonn')";
	$result = $db->query($sql);
	if($result){
		echo "En ny utøver ble lagt til!";
	}
	else{
		$rowAmount= $db->affected_rows;
		if($rowAmount == 0){
			echo "Kunne ikke sette data inn i database.<br>";
			trigger_error("Insert return 0 rows");
		}
	}
	$db->close();
}


public function nyOvelse($navn, $sted, $dato, $tid){
	$db = $this->conn();
	if($db->connect_error){
	  	echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
	    trigger_error($db->connect_error);
	}
	$sql= "INSERT INTO ovelser(navn, sted, dato, tid)";
	$sql .= "VALUES ('$navn', '$sted', '$dato', '$tid')";
	$result = $db->query($sql);
	if($result){
		echo "En ny øvelse ble lagt til!";
	}
	else{
		$rowAmount= $db->affected_rows;
		if($rowAmount == 0){
			echo "Kunne ikke sette data inn i database.<br>";
			trigger_error("Insert return 0 rows");
		}
	}
	$db->close();
}

public function nyttStafettlag($land, $nasjonalitet, $idrett, $klasse){
	$db = $this->conn();
	if($db->connect_error){
	  	echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
	    trigger_error($db->connect_error);
	}
	$sql = "INSERT INTO stafettlag (land, nasjonalitet, idrett, klasse)";
	$sql .= "VALUES ('$land', '$nasjonalitet', '$idrett', '$klasse')";
	$result = $db->query($sql);
	if($result){
		echo "Et nytt lag ble lagt til!";
	}
	else{
		$rowAmount= $db->affected_rows;
		if($rowAmount == 0){
			echo "Kunne ikke sette data inn i database.<br>";
			trigger_error("Insert return 0 rows");
		}
	}
	$db->close();
}

public function flushUtovere(){
	$db = $this->conn();
	if($db->connect_error){
	  	echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
	    trigger_error($db->connect_error);
	}
	$sql= "TRUNCATE TABLE utovere";
	$result = $db->query($sql);
	if($result){
		echo "Tabellen \"Utøvere\" ble tømt!";
	}
	else {
		echo "Det skjedde en feil!";
	}
}

public function flushOvelser(){
	$db = $this->conn();
	if($db->connect_error){
	  	echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
	    trigger_error($db->connect_error);
	}
	$sql= "TRUNCATE TABLE ovelser";
	$result = $db->query($sql);
	if($result){
		echo "Tabellen \"Øvelser\" ble tømt!";
	}
	else {
		echo "Det skjedde en feil!";
	}
}


public function flushPublikum(){
	$db = $this->conn();
	if($db->connect_error){
	  	echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
	    trigger_error($db->connect_error);
	}
	$sql= "TRUNCATE TABLE publikum";
	$result = $db->query($sql);
	if($result){
		echo "Tabellen \"Publikum\" ble tømt!";
	}
	else {
		echo "Det skjedde en feil!";
	}
}

public function flushStafettlag(){
	$db = $this->conn();
	if($db->connect_error){
	  	echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
	    trigger_error($db->connect_error);
	}
	$sql= "TRUNCATE TABLE stafettlag";
	$result = $db->query($sql);
	if($result){
		echo "Tabellen \"Stafettlag\" ble tømt!";
	}
	else {
		echo "Det skjedde en feil!";
	}
}
}

class createDB{
	//Disse funksjonene ble kjørt via nettsiden for å opprette databasen.
	//De er ikke lenger inkludert i koden, men vi lar de ligge her.

	public function __construct(){
		$this->DBhost = $ini['DBhost'];
		$this->DBuser = $ini['DBuser'];
		$this->DBpass = $ini['Bpass'];
		$this->DBname = 's315754';
	}

	public function conn(){
		return new mysqli($this->DBhost, $this->DBuser, $this->DBpass, $this->DBname);
	}
	//skoleserver lar oss ikke opprette ny database, men inkluderer denne likevel.
	//brukte denne istedenfor:
	// ALTER SCHEMA `s315754`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_danish_ci ;
	function oppretteDB(){
		$db = new mysqli($this->DBhost, $this->DBuser, $this->DBpass);
		if($db->connect_error) {
    		die("Connection failed: " . $db->connect_error);
		}
		$sql = "CREATE SCHEMA `skivm` DEFAULT CHARACTER SET utf8 COLLATE utf8_danish_ci";
		$result= $db->query($sql);
		if($result){
    		echo "Database created successfully";
		} 
		else {
    		echo "Error creating database: " . $db->error;
		}
	$db->close();
	}


	public function createBruker(){
		$db = $this->conn();
		if($db->connect_error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "CREATE TABLE s315754.bruker ( 'userid' INT(4) NOT NULL AUTO_INCREMENT , 'fornavn' VARCHAR(50) NOT NULL , 'etternavn' VARCHAR(50) NOT NULL , 'postnr' INT(4) NOT NULL , 'sted' VARCHAR(50) NOT NULL , 'telefonno' INT(8) NOT NULL , 'email' VARCHAR(100) NOT NULL , 'salt' VARCHAR(50) NOT NULL , 'passord' VARCHAR(200) NOT NULL , 'token' VARCHAR(100) NOT NULL , 'tstamp' VARCHAR(100) NOT NULL , 'isadmin' TINYINT(4) NOT NULL DEFAULT '0' , 'hashedquery' VARCHAR(200) NOT NULL , PRIMARY KEY ('userid)) ENGINE = MyISAM";
		$result = $db->query($sql);
		if($result){
			echo "Tabell opprettet!";
		}
		else{
			echo "Klarte ikke sette tabell inn i database!";
			trigger_error("Klarte ikke sette inn tabell");
		}
		$db->close();
	}

	public function createOvelser(){
		$db = $this->conn();
		if($db->connect_error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "CREATE TABLE 's315754'.'ovelser' ( 'ovelsesid' INT(4) NOT NULL AUTO_INCREMENT , 'navn' VARCHAR(100) NOT NULL , 'sted' VARCHAR(50) NOT NULL , 'dato' VARCHAR(50) NOT NULL , 'tid' VARCHAR(5) NOT NULL , PRIMARY KEY ('ovelsesid')) ENGINE = MyISAM";
		$result = $db->query($sql);
		if($result){
			echo "Tabell opprettet!";
		}
		else{
			echo "Klarte ikke sette tabell inn i database!";
			trigger_error("Klarte ikke sette inn tabell");
		}
		$db->close();
	}
	public function createPublikum(){
		$db = $this->conn();
		if($db->connect_error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "CREATE TABLE 's315754'.'publikum' ( 'ovelsesid' INT(4) NOT NULL , 'userid' INT(4) NOT NULL ) ENGINE = MyISAM";
		$result = $db->query($sql);
		if($result){
			echo "Tabell opprettet!";
		}
		else{
			echo "Klarte ikke sette tabell inn i database!";
			trigger_error("Klarte ikke sette inn tabell");
		}
		$db->close();
	}

	public function createStafettlag(){
		$db = $this->conn();
		if($db->connect_error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "CREATE TABLE `s315754`.`stafettlag` ( `lagid` INT NOT NULL AUTO_INCREMENT , `land` VARCHAR(50) NOT NULL , `nasjonalitet` VARCHAR(3) NOT NULL , `idrett` VARCHAR(50) NOT NULL , `klasse` VARCHAR(10) NOT NULL , PRIMARY KEY (`lagid`)) ENGINE = MyISAM";
		$result = $db->query($sql);
		if($result){
			echo "Tabell opprettet!";
		}
		else{
			echo "Klarte ikke sette tabell inn i database!";
			trigger_error("Klarte ikke sette inn tabell");
		}
		$db->close();
	}

	public function createUtovere(){
		$db = $this->conn();
		if($db->connect_error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "CREATE TABLE `s315754`.`utovere` ( `loperid` INT(4) NOT NULL AUTO_INCREMENT , `fornavn` VARCHAR(50) NOT NULL , `etternavn` VARCHAR(50) NOT NULL , `idrett` VARCHAR(50) NOT NULL , `nasjonalitet` VARCHAR(3) NOT NULL , `kjonn` VARCHAR(10) NOT NULL , PRIMARY KEY (`loperid`)) ENGINE = MyISAM";
		$result = $db->query($sql);
		if($result){
			echo "Tabell opprettet!";
		}
		else{
			echo "Klarte ikke sette tabell inn i database!";
			trigger_error("Klarte ikke sette inn tabell");
		}
		$db->close();
	}

	public function insertOvelser(){
		$db = $this->conn();
		if($db->connect_error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "INSERT INTO `ovelser` (`navn`, `sted`, `dato`, `tid`)";
		$sql .= "VALUES ('Langrenn, 10 km, herrer', 'Seefeld skiarena', 'Tirsdag 10.12', '13:30'), 
						('Skihopp, normalbakke, herrer', 'Seefeld hoppbakke', 'Onsdag 11.12', '18:30'), 
						('Skihopp, lagkonkurranse, mix', 'Seefeld hoppbakke', 'Fredag 13.12', '17:30'), 
						('Langrenn, stafett, kvinner', 'Seefeld skiarena', 'Fredag 13.12', '12:00'),  
						('Skiskyting, fellesstart, kvinner', 'Seefeld skiskytterarena', 'Lørdag 14.12', '14:00'), 
						('Skøyter, 5000 m, herrer', 'Seefeld ishall', 'Lørdag 14.12', '19:00')";
		$result = $db->query($sql);
		if($result){
			echo "Data satt inn i tabell!";
		}
		else{
			echo "Klarte ikke sette data inn i tabell!";
			trigger_error("Klarte ikke sette inn i tabell");
		}
		$db->close();
	}

	public function insertUtovere(){
		$db = $this->conn();
		if($db->connect_error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "INSERT INTO utovere (fornavn, etternavn, idrett, nasjonalitet, kjonn)";
		$sql .= "VALUES ('Petter', 'Northug', 'Langrenn', 'NOR', 'mann'),
						('Sergey', 'Ustyugov', 'Langrenn', 'RUS', 'mann'),
						('Marcus', 'Hellner', 'Langrenn', 'SWE', 'mann'),
						('Federico', 'Pellegrino', 'Langrenn', 'ITA', 'mann'),
						('Marit', 'Bjørgen', 'Langrenn', 'NOR', 'kvinne'),
						('Heidi', 'Weng', 'Langrenn', 'NOR', 'kvinne'),
						('Charlotte', 'Kalla', 'Langrenn', 'SWE', 'kvinne'),
						('Johanna', 'Hagström', 'Langrenn', 'SWE', 'kvinne'),
						('Daniel', 'Tande', 'Skihopp', 'NOR', 'mann'),
						('Kamil', 'Stoch', 'Skihopp', 'POL', 'mann'),
						('Peter', 'Prevc', 'Skihopp', 'SLO', 'mann'),
						('Maren', 'Lundby', 'Skihopp', 'NOR', 'kvinne'),
						('Sven', 'Kramer', 'Skoyter', 'NED', 'mann'),
						('Hege', 'Bøkko', 'Skoyter', 'NOR', 'kvinne'),
						('Håvard', 'Bøkko', 'Skoyter', 'NOR', 'mann'),
						('Tiril', 'Eckhoff', 'Skiskyting', 'NOR', 'kvinne'),
						('Darja', 'Domaratsjeva', 'Skiskyting', 'BLR', 'kvinne'),
						('Ole Einar', 'Bjørndalen', 'Skiskyting', 'NOR', 'mann')";
		$result = $db->query($sql);
		if($result){
			echo "Tabell opprettet!";
		}
		else{
			echo "Klarte ikke sette data inn i tabell!";
			trigger_error("Klarte ikke sette inn i tabell");
		}
		$db->close();
	}

	/*public function insertStafettlag(){
		$db = $this->conn();
		if($db->connect_Error){
			echo "Klarte ikke koble til database. Vennligst prøv igjen senere.<br>";
			trigger_error($db->connect_error);
		}
		$sql = "INSERT INTO stafettlag (land, nasjonalitet, idrett, klasse)";
		$sql .= "VALUES ('Norge', 'NOR', 'Skihopp', 'mix'),
						('Russland', 'RUS', 'Langrenn', 'kvinner'),
						('Russland 2', 'RUS', 'Langrenn', 'menn'),
						('Frankrike', 'FRA', 'Langrenn', 'kvinner'),
						('Østerrike', 'AUS', 'Langrenn', 'kvinner'),
						('Italia', 'ITA', 'Skihopp', 'mix'),
						('Sverige', 'SWE', 'Langrenn', 'mix'),
						('Sverige', 'SWE', 'Skihopp', 'mix')";
		$result = $db->query($sql);
		if($result){
			echo "Tabell opprettet!";
		}
		else{
			echo "Klarte ikke sette tabell inn i database!";
			trigger_error("Klarte ikke sette inn i tabell");
		}
		$db->close();
	}
	*/

}
?>