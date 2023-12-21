
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kaskita Store</title>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <style>
.navbar-brand {
    font-family: 'Raleway', sans-serif;
    font-weight: 500; /* vous pouvez changer la graisse ici si vous le souhaitez */
}

</style>


</head>

<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #000000;">
  <a class="navbar-brand" href="index.php">
    <img src="image/logo.png" alt="Kaskita Store Logo" height="40"> <!-- Vous pouvez ajuster la hauteur comme vous le souhaitez -->
    &nbsp;&nbsp;Kaskita Store
  </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <?php
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }
      // Obtenir le nom de la page actuelle
      $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <?php if ($current_page == 'index.php'): ?>
      <!-- Ajouter le formulaire de recherche uniquement sur la page index.php -->
      <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher des produits" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Rechercher</button>
      </form>
    <?php endif; ?>
    

    <ul class="navbar-nav ml-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Ces éléments sont affichés uniquement si l'utilisateur est connecté -->
            <li class="nav-item">
                <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> Panier <span id="cart-item" class="badge badge-danger"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profil.php"><i class="fas fa-user"></i> Profil</a>
            </li>
        <?php elseif ($current_page == 'index.php'): ?>
            <!-- Cet élément est affiché uniquement sur la page index.php et si l'utilisateur n'est pas connecté -->
            <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
            </li>
        <?php endif; ?>
    </ul>



    </div>
  </nav>
  <!-- Navbar end -->