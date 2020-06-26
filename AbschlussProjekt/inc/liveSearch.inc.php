
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('dbconnect.inc.php');
//var_dump($_REQUEST);

$q = $_REQUEST['term'];

if(isset($q)){

    //prepare a select statement
    $sql = "SELECT * FROM content WHERE title LIKE '%" . $q . "%' 
    OR description LIKE '%" . $q . "%'";
    $result = $con->query($sql);
    if(mysqli_num_rows($result) > 0) {
        //Fetch result rows as an associative array
        while($row = $result->fetch_assoc()){
            if(mb_detect_encoding($row['title']) != 'UTF-8' || 'ASCII') {$row
                ['title'] = utf8_encode($row['title']);}
                echo '<a class="nav-link" href="#';
                echo $row['id'] . '">';
                echo $row['title'];
                echo '</a>';
            }
        } else {
            echo "<p>Keine Suchtreffer gefunden</p>";
        }
    } else{
        echo "FEHLER! Befehl konnte nicht durchgeführt werden: ". $sql . mysqli_error($con);
    }

    $con->close();

    ?>