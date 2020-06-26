<?php
  session_start();
if(isset($_SESSION['username'])){
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Roboto:ital@1&display=swap" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>This is ART</title>

</head>

<body class="bg bg-color">
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
  <!-- NAVBAR -->
  <?php
include __DIR__ . '/inc/loggedNav.inc.php';
?>


  <!-- Login Alert -->
  <?php 
if(isset($_GET["log_error_code"])){
if ($_GET["log_error_code"] == '1'){
  echo '<div class="alert alert-danger" role="alert">
  Ihre Anmeldedaten sind nicht korrekt. Bitte versuchen Sie es erneut!
  </div>';
}
}
?>
  <!-- Registry Alerts  -->
  <?php
  if (isset($_GET["registry_status"])) {
    if ($_GET["registry_status"] == '0') {
      echo '<div class="alert alert-success" role="alert">
      Registrierung erfolgreich!
    </div>';
    }

    if ($_GET["registry_status"] == '1') {
      echo '<div class="alert alert-danger" role="alert">
      Beim Abspeichern ist leider ein Fehler aufgreteten!
    </div>';
    }

    if ($_GET["registry_status"] == '2') {
      echo '<div class="alert alert-danger" role="alert">
      Die Email Adresse ist bereits vergeben!
    </div>';
    }
    
  }
?>
  <!------------------------------------------------ KARUSSEL ----------------------------------------------------->
  <div class="fucking-alignment">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/bardrink.jpg" class="d-block w-100" alt="venusorange">
        </div>
        <div class="carousel-item">
          <img src="img/sugar.jpg" class="d-block w-100" alt="feedme">
        </div>
        <div class="carousel-item">
          <img src="img/bloodorange.jpg" class="d-block w-100" alt="drinking">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  </div>

  <div class="header-box">
    <h1 class="hw animated-text txt-cnt">Meine kleine Kunstsammlung :D</h1>
  </div>
  <!----------------------------- BOOTSTRAP CARD DECKS  --------------------------------->
  <div id="container">
    <div class="card-deck pl-5 pr-5">
      <?php 
include('inc/dbconnect.inc.php');
$result = $con->query("SELECT id, title, teaser, imgpath FROM content");
 while($entry = $result -> fetch_assoc()) {
?>
      <!-- CARD BEGINN -->
      <div class="card shadow-lg mb-5 bg-white rounded" id="id<?php echo $entry['id'] ?>">
        <?php if($entry['imgpath']) { ?>
        <img src="upload-img/<?php echo $entry['imgpath'] ?>" class="card-img top" alt="...">
        <?php } ?>
        <div class="card-body">
          <!-- Button Trigger Modal -->
          <button type="button" class="txt-fat card-title btn ajaxModal" data-toggle="modal"
            data-id="<?php echo $entry['id'] ?>">
            <?php echo $entry['title']; ?>
          </button>
          <p class="card-text teaser">
            <?php
          echo $entry['teaser'];
            ?>
          </p>
        </div>
      </div>
      <!-- CARD ENDE  -->
      <?php
            }
    $con->close();
      ?>
    </div>
  </div>

  <!-- LOGIN MODAL  -->
  <div class="modal " tabindex="-1" role="dialog" id="login">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Login</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="auth/login.php?login=1" method="post">
            <div class="form-group">
              <label for="username" class="col-md-6">Username:</label>
              <input type="text" class="col-md-5" name="username" value="" required="required" placeholder="username"
                maxlength="255" id="username" require>
              <label for="username" class="col-md-6">Password:</label>
              <input type="password" class="col-md-5" name="password" value="" required="required"
                placeholder="password" maxlength="255" id="password" require>
              <div class="txt-cnt">
                <button type="submit" class="btn btn-primary mrgn-top">Login</button>
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Registry Modal -->

  <div class="modal" tabindex="-1" role="dialog" id="registry">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <section class="w-100 h-100 mt-0 pt-5">
          <div class="container">
            <h5 class="txt-cnt">Bitte alle Felder ausfüllen</h5>
            <form action="auth/registry.php?register=1" method="post">
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                <input type="text" size="40" maxlength="250" name="username" id="username" require>
                </div>
              </div>
              <div class="form-group row">
                <label for="forename" class="col-sm-2 col-form-label">Vorname:</label>
                <div class="col-sm-10">
                <input type="text" size="40" maxlength="250" name="forename" id="forename" require>
                </div>
              </div>
              <div class="form-group row">
                <label for="familyname" class="col-sm-2 col-form-label">Nachname:</label>
                <div class="col-sm-10">
                <input type="text" size="40" maxlength="250" name="familyname" id="familyname" require>
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email Adresse:</label>
                <div class="col-sm-10">
                <input type="email" size="40" maxlength="250" name="email" id="email" require>
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Passwort:</label>
                <div class="col-sm-10">
                <input type="password" size="40" maxlength="250" name="password" id="password" require>
                </div>
              </div>
              <div class="form-group row">
                <label for="password2" class="col-sm-2 col-form-label">Passwort wiederholen:</label>
                <div class="col-sm-10">
                <input type="password" size="40" maxlength="250" name="password2" id="password2" require>
                </div>
              </div>
              <div class="modal-footer">
              <button class="btn btn-primary" type="submit">Speichern</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="lexikon-entry" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Info Ende -->

  
  <script src="js/liveSearch.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script src="js/modalFunk.js"></script>
  <script src="js/index.js"></script>

</body>

</html>
