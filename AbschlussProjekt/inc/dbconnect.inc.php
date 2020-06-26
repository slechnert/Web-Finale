    <?php
    $host = 'localhost:3306';
    $pw ='';
    $user = 'root';
    $db = 'wiki';
    $con = new mysqli($host, $user, $pw, $db);

    if($con->connect_errno) {
        printf("Connect failed: %s\n", $con->connect_error);
        exit();
    }
    ?>