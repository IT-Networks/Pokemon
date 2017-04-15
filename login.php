<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=pokemon',"root", "");

// try {
// 	$dbh = new PDO('mysql:host=instanz1.cf6ecdewusof.eu-central-1.rds.amazonaws.com:3306;dbname=php','benutzer', 'passwort');
// 	foreach ($dbh->query('SELECT * FROM POKEMON') as $row){
// 		print_r($row);
// 	}
// } catch (Exception $e) {
// 	print "Error!:" . $e->getMessage() . "<br/>";
// 	die();
// }

/**
 * Der übergebene Username und das Passwort werden gespeichert.
 * Anschließend wird der Username in ein Prepared Statement übergeben und die Userdaten abgefragt.
 * Das Passwort wird über die password_verify-Funktion verifiziert. Bei korrektem Passwort wird auf die loggedin-Seite weitergeleitet.
 * Bei falschem Passwort oder nicht vorhandenem Username wird eine Fehlermeldung ausgegeben.
 */
if(isset($_GET['login'])) {
	$username = $_POST['username'];
	$passwort = $_POST['passwort'];
	
	$statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");
	$result = $statement->execute(array('username' => $username));
	$user = $statement->fetch();
	
	//Überprüfung des Passworts
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['userid'] = $user['id'];
		die('Login erfolgreich. <a href="loggedin.php">Spiel starten!</a>');
	} else {
		$errorMessage = "Benutzername oder Passwort war ungültig<br>";
	}
	
}
?>
<!DOCTYPE html> 
<html>
<head>
<link href="background.css" rel="stylesheet">
<style>
body{
  display: flex;
  align-items: center;
  justify-content: center;
  flex-flow: row wrap;
}
 
header, nav, footer {
  flex: 1 100%;
}
 
article {
  flex: 3 1 0%;
}
 
aside {
  flex: 1 1 0%;
}
</style>
  <title>Login</title> 
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
 echo $errorMessage;
}
?>

<form action="?login=1" method="post">
Benutzername:<br>
<input type="text" size="40" maxlength="250" name="username"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="passwort"><br>
 
<input type="submit" value="Abschicken">
<br><br>
<a href="pwvergessen.php">Passwort vergessen</a>
<a href="register.php">Registrieren</a>

</form> 


</body>
</html>