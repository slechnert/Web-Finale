<?php
if(isset($_SESSION['username'])){
    $NavItem1 = '<a class="btn btn-secondary" href="/php/Abschlussprojekt/auth/editLexikon.php">Editieren</a>';
    $NavItem2 = '<a class="btn btn-primary" href="/php/Abschlussprojekt/auth/logout.php">Logout</a>';
}
else{
    $NavItem1 = '<a class="btn btn-secondary" data-toggle="modal" data-target="#registry">Registrieren</a>';
    $NavItem2 = '<a class="btn btn-primary" data-toggle="modal" data-target="#login">Login</a>';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="/php/Abschlussprojekt/index.php">Art</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse txt-fat white" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?php echo $NavItem1 ?>
      </li>
      <li class="nav-item">
        <?php echo $NavItem2 ?>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0 search-box">
  <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Search" aria-label="Search" name="term" id="term">
    <div class="result bg-white col-12 fixed-top mt-5 card"></div>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>


