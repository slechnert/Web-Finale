<?php
define('SECURE', true);
include('../inc/dbconnect.inc.php');
if(!empty($_POST)) {
    $output = '';
    $message = '';
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $teaser = mysqli_real_escape_string($con, $_POST["teaser"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    var_dump($_POST);
    if($_POST["entry_id"] != '') {
        $query = "UPDATE content SET title='$title', teaser='$teaser', description='$description' WHERE id=".$_POST["entry_id"];
        // $message = 'Data Updated';
    } else {
        $query = "INSERT INTO content(title, teaser, description)
        VALUES('$title', '$teaser', '$description');";
        // $message = 'Data Inserted';
    }


    $result = $con->query($query);
//var_dump($result);
    if($result) {
    $output .= '<label class="text-success">' . $message . '</label>';
    $result = $con->query("SELECT * FROM content ORDER BY id DESC");
    $output .= '<table class="table table-striped table-dark">';
    while($row = mysqli_fetch_array($result)) {
        $output .= '
        <tr>
            <td>' . $row["id"] . '</td>
            <td>' . $row["title"] . '</td>
            <td><button type="button"
            class="card-title btn edit_data"
            name="edit"
            id="'.$row["id"] . '"
            data-toggle="modal">
            <i class="fas fa-edit"></i>
            </button></td>
            <td><button type="button"
            class="card-title btn edit_data"
            name="delete"
            id="'.$row["id"].'"
            data-toggle="modal">
            <i class="fas fa-trash"></i>
            </button></td>
            </tr>
         ';
    }
    $output .= '</table>';
    }
    echo $output;
}
?>
