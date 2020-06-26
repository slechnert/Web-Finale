<?php
define('SECURE', true);
include('../inc/dbconnect.inc.php');

if(!empty($_POST)) {
    $output = '';
    $message = '';
    if($_POST["entry_id"] != NULL) {
        if($_POST["deleteIMG"] != NULL) {
            $target_dir = "../lexikon_img/";
            $checkFile = $_POST['deleteIMG'];
                if(file_exists($target_dir.$checkFile)) {
                    unlink($target_dir.$checkFile);
                }
        }
    }

    $result = $con->query("DELETE FROM content WHERE id=" . $_POST["entry_id"]);
    $message = 'Daten gelöscht';
        if($result) {
            $output .= '<label class="text-success">' . $message . '</label>';
            $sql = 'SELECT * FROM content ORDER BY id DESC';
            $result = $con->query("$sql");
            $output .= '<table class="table table-striped table-dark">';
            while($row = $result->fetch_assoc())
            {
                $output .= '
                <tr>
                    <td>' . $row["id"] . '</td>
                    <td>' . $row["title"] . '</td>
                    <td><button type="button"
                        class="card-title btn edit_data"
                        name="edit"
                        id="'.$row["id"] .'"
                        data-toggle="modal">
                        <i class="fas fa-edit"></i>
                        </button></td>
                        <td><button type="button"
                        class="card-title btn delete_data"
                        name="delete"
                        id="'.$row["id"] .'"
                        data-toggle="modal">
                        <i class="fas fa-trash"></i>
                        </button></td>
                        </tr>
                        ';
            }
            $output .='</table>';
        }
        echo $output;
}
?>
