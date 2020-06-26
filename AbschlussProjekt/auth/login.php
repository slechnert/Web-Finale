<?php session_start();

require_once('../inc/dbconnect.inc.php'); ?>
<?php

// Anmeldeprozess

if(isset($_GET['login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    //Validation
    if(!empty($username) && !empty($password)) {
        $sql = 'SELECT username FROM user WHERE username = ? AND password = ?';
        $query = $con->prepare($sql);

        if (!$query) {
            die("Error in Statement: "+$sql);
        }

        // $password = md5($password);
        $query->bind_param('ss', $username, $password);
        $query->execute();
        $query->store_result();
        $query->bind_result($username);
        if($query->num_rows != 1) {
            $log_error_code = 1;
            // $error = 'Ihre Anmeldedaten sind nicht korrekt. Bitte versuchen Sie es erneut.';
            
            $URL = "../index.php?log_error_code=$log_error_code";
            if (headers_sent() ) { echo("<script>location.href='$URL'</script>"); }
            else { header("Location: $URL"); }
            exit;
        } else {
            var_dump($username);
            $_SESSION['username'] = $username;
            //Redirect zu Index.php
         
            $URL = "../index.php?log_error_code=$log_error_code";
            if (headers_sent() ) { echo("<script>location.href='$URL'</script>"); }
            else { header("Location: $URL"); }
            exit;
        }
    } else {
        $log_error_code = 2;
        $error = 'Bitte Eingaben korrigieren.';
    }
} else {
    $log_error_code = 0;
    $error = NULL;
    $email = NULL;
}

?>