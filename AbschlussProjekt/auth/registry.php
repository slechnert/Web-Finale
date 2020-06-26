<?php
session_start();
require_once('../inc/dbconnect.inc.php');
?>

<?php
$showFormular = true;

if(isset($_GET['register'])){
$error = false;
$email = trim(htmlspecialchars($_REQUEST['email']));
$password = trim(htmlspecialchars($_REQUEST['password']));
$password2 = trim(htmlspecialchars($_REQUEST['password2']));
$familyname = trim(htmlspecialchars($_REQUEST['familyname']));
$forename = trim(htmlspecialchars($_REQUEST['forename']));
$username = trim(htmlspecialchars($_REQUEST['username']));
$error_code = 0;

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
    $error = true;
    $error_code = 1;
}
    if(strlen($password) == 0) {
        echo 'Bitte ein Passwort eingeben<br>';
        $error = true;
        $error_code = 1;
    }
    if($password != $password2){
        echo 'Die Passworter müssen übereinstimmen<br>';
        $error =true;
        $error_code = 1;
    }

    //Überprüfe Datenbank auf die email
    if(!$error) {
        $result = $con->query("SELECT * FROM user WHERE email = '" . $email . "'");

        if($result->num_rows){
            //echo '<p class="bg-danger text-white m-5 p-5 text-center">email bereits vergeben</p>';
            $error_code = 2;
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        var_dump($_REQUEST);
        $result = $con->query("INSERT INTO user (email, username, password, forename, familyname) VALUES ('$email', '$username','".$password."', '$forename', '$familyname')");
        var_dump($result);
        if($result){
            //echo 'Registrierung erfolgreich! <a data-toggle="modal" data-target="#login">Zum Login</a>';
            $showFormular = false;
        } else {
           // echo '<p class="bg-danger m-5 p-5 text-center">Beim Abspeichern ist leider ein Fehler aufgreteten</p>';
           $error_code = 1;
        }
    }
}

?>
<?php
     $URL = "../index.php?registry_status=$error_code";
     if (headers_sent() ) { echo("<script>location.href='$URL'</script>"); }
     else { header("Location: $URL"); }
     exit;
?>
