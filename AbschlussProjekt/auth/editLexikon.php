<?php 
include("auth.php");
define('SECURE', true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Roboto:ital@1&display=swap" rel="stylesheet">
  <link href="../css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Einträge editieren</title>
</head>

<body class="bg bg-color">
  <?php include("../inc/loggedNav.inc.php"); ?>
  <?php
  if(isset($_GET['uploadOK'])){
    if($_GET['uploadOK'] == '0'){
      echo '<div class="alert alert-danger" role="alert">
      Tut uns Leid, es gab ein Problem beim Hochladen Ihrer Datei!
      </div>';
    }
  }
  ?>
  


 <!-- Add Entry Top -->

  <section class="pt-5 mt-5 txt-cnt" id="lexikon">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEntry">
    Neuer Eintrag
</button>
    <div class="modal fade" tabindex="-1" role="dialog" id="addEntry" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Neuer Eintrag</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="../inc/saveEntry.inc.php" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">Titel (max. 550 Zeichen)</label>
                <input type="text" class="form-control" name="title" required>
              </div>
              <div class="form-group">
                <label for="teaser">Teaser (max. 550 Zeichen)</label>
                <textarea class="form-control" name="teaser" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="description">Beschreibung*</label>
                <textarea class="form-control" name="description" rows="3" required></textarea>
              </div>
              <div class="form-group">
                <label for="fileUpload">File Upload</label>
                <input type="file" class="form-control-file" name="fileUpload">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Änderungen speichern</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Icons  -->
  <section class="container pt-2 mt-3 h-100 txt-cnt">
    <div class="table-responsive" id="lexikon_table">
      <table class="table table-striped table-dark">
        <tbody>
          <?php 
          include('../inc/dbconnect.inc.php');
          $result = $con->query("SELECT id, title FROM content ORDER BY id DESC");
          while($entry = $result -> fetch_assoc()) {
            if(mb_detect_encoding($entry['title']) != 'UTF-8' || 'ASCII') {$entry['title'] = utf8_encode($entry['title']);}
          ?>
          <tr>
            <td><?php echo $entry['id']; ?></td>
            <td><?php echo $entry['title']; ?></td>
            <td>
              <button type="button" class="card-title btn edit_data" name="edit" value="Edit" data-toggle="modal"
                id="<?php echo $entry['id'] ?>">
                <i class="fas fa-edit white"></i>
              </button>
            </td>
            <td>
              <button type="button" class="card-title btn delete_data" name="delete" value="Löschen" data-toggle="modal"
                id="<?php echo $entry['id'] ?>">
                <i class="fas fa-trash white"></i>
              </button>
            </td>
          </tr>

          <?php } $con->close(); ?>
        </tbody>
      </table>
    </div>
  </section>

<!-- Add Entry Bot -->
  <section class="txt-cnt mt-3" id="lexikon">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEntry">
    Neuer Eintrag
</button>
    <div class="modal fade" tabindex="-1" role="dialog" id="addEntry" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Neuer Eintrag</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="../inc/saveEntry.inc.php" enctype="multipart/form-data" class="needs-validation" novalidate>
              <div class="form-group">
                <label for="validationTitle">Titel (max. 550 Zeichen)</label>
                <input type="text" class="form-control" id="validationTitle" name="title" required="required">
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
              <div class="form-group">
                <label for="validationteaser">Teaser (max. 550 Zeichen)</label>
                <textarea class="form-control" id="validationteaser" name="teaser" rows="3" required="required"></textarea>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
              <div class="form-group">
                <label for="validationdescription">Beschreibung</label>
                <textarea class="form-control" id="validationdescription" name="description" rows="3" required="required"></textarea>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
              <div class="form-group">
                <label for="fileUpload">File Upload</label>
                <input type="file" class="form-control-file" name="fileUpload">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <!-- edit Modal -->
  <div class="modal fade txt-cnt" tabindex="-1" role="dialog" id="add_data_Modal" aria-labelledby="lexikon-entry"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form method="post" id="insert_form" class="needs-validation" novalidate>
            <input type="hidden" name="entry_id" id="entry_id" />
            <div class="form-group">
              <label for="title">Titel</label>
              <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="form-group">
              <label for="teaser">Teaser</label>
              <textarea class="form-control" name="teaser" type="text" id="teaser"></textarea>
            </div>
            <div class="form-group">
              <label for="description">Beschreibung</label>
              <textarea class="form-control" name="description" type="text" id="description"></textarea>
            </div>
            <div class="form-group">
              <img src="" class="img-fluid" id="imgOld">
            </div>
            <div class="form-group">
              <label for="description">Neues Bild</label>
              <!-- ^^^^ ??????? ^^^^ -->
              <input type="file" class="form-control-file" name="fileUpdate" id="fileUpdate">
            </div>
            <button type="button" class="btn btn-success" name="insert" id="insert">Speichern</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- delete_data Modal -->
  <div id="delete_data_Modal" class="modal fade txt-cnt">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Löschen</h4>
        </div>
        <div class="modal-body">
          <p id="titleDelete"></p>
          <p id="descriptionDelete"></p>
          <p id="teaserDelete"></p>
          <p id="imgDelete"></p>
          <form method="post" id="delete_form">
            <input type="hidden" id="deleteIMG" name="entry_id" id="entryDelete_id" />
            <input type="hidden" name="entry_id" id="entryDelete_id" />
            <button class="btn btn-default" type="button" name="delete" id="delete"
              class="btn btn-danger">Löschen</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



  <script src = "https://code.jquery.com/jquery-3.5.1.js"
    integrity = "sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin = "anonymous" >
  </script>
  <script>
    $(document).on('click', '.edit_data', function () {
      var entry_id = $(this).attr("id");
      console.log(entry_id);
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {
          entry_id: entry_id
        },
        dataType: 'json',
        success: function (data) {
          $('#title').val(data.title);
          $('#teaser').val(data.teaser);
          $('#description').val(data.description);
          $('#entry_id').val(data.id);
          $('imgOld').attr("src", '../upload-img/' + data.imgpath);
          $('#insert').val("Update");
          $('#add_data_Modal').modal('show');
        },
        error: function (req, err) {
          console.log('my message ' + err);
        }
      });
    });


    $(document).on('click', '#insert', function (event) {
      event.preventDefault();
      if ($('#title').val() == "") {
        alert("Name is required");
      } else if ($('#teaser').val() == '') {
        alert("teaser is required");
      } else if ($('#description').val() == '') {
        alert("description is required");
      } else {
        $.ajax({
          url: "insert.php",
          method: "POST",
          data: $('#insert_form').serialize(),
          beforeSend: function () {
            $('#insert').val("Inserting");
          },
          success: function (data) {

            $('#insert_form')[0].reset();
            $('#add_data_Modal').modal('hide');
            $('#lexikon_table').html(data);
          }
        });

      }
    });

    $(document).on('click', '.delete_data', function(){
      var entryDelete_id = $(this).attr("id");
      console.log(entryDelete_id);
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {
          entry_id: entryDelete_id
        },
        dataType: 'json',
        success: function (data) {
          $('#titleDelete').html(data.title);
          $('#teaserDelete').html(data.teaser);
          $('#descriptionDelete').html(data.description);
          $('#imgDelete').html(data.imgpath);
          $('#deleteIMG').val(data.imgpath);
          $('#entryDelete_id').val(data.id);
          $('#delete').html("Delete");
          $('#delete_data_Modal').modal('show');
        }
      });
    });
    $(document).on('click', '#delete_form', function (event) {
      event.preventDefault();

      $.ajax({
        url: "delete.php",
        method: "POST",
        data: $('#delete_form').serialize(),
        beforeSend: function () {
          $('#delete').val("Deleting");
        },
        success: function (data) {
          $('#delete_form')[0].reset();
          $('#delete_data_Modal').modal('hide');
          $('#lexikon_table').html(data);
        }
      });
    });


</script>

<script src="../js/liveSearch.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="../js/modalFunk.js"></script>
</body>
</html>
