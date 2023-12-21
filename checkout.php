<?php
require 'config.php';

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
}
$allItems = implode(', ', $items);

if (isset($_POST['submit'])) {
    $modePaiement = $_POST['pmode'];

    switch ($modePaiement) {
        case "paypal":
            traiterPaypal();
            break;
        case "visa":
            traiterVisa();
            break;
        case "mastercard":
            traiterMastercard();
            break;
        default:
            echo "Méthode de paiement sélectionnée invalide!";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Passer à la caisse</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
.navbar-brand {
    font-family: 'Raleway', sans-serif;
    font-weight: 500; 
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #000000;">
  <a class="navbar-brand" href="index.php">
    <img src="image/logo.png" alt="Kaskita Store Logo" height="40"> <!-- Vous pouvez ajuster la hauteur comme vous le souhaitez -->
    &nbsp;&nbsp;Kaskita Store
</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Liens de la barre de navigation -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-th-list mr-2"></i>Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="commande">
                <h4 class="text-center text-info p-2">Finalisez votre commande !</h4>
                <div class="jumbotron jumbotron-custom p-4 text-center">
                <div class="mb-2">
                <h6 class="lead"><b>Produit(s) :</b> <?= $allItems; ?></h6>
                </div>
                <div class="mb-2">
                <h6 class="lead"><b>Frais de livraison :</b> Gratuit</h6>
                </div>
                <div>
                <h5><b>Montant total à payer :</b> <?= number_format($grand_total,2) ?>/-</h5>
                </div>
                </div>

                <form action="action.php" method="post" >
                    <input type="hidden" name="products" value="<?= $allItems; ?>">
                    <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                    
                    <div id="paypal-payment-button"></div>
                    
                </form>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

    
    <script src="https://www.paypal.com/sdk/js?client-id=AW8vxsn3v9raCQWCw-vxMMeu5f5KQ-fI6d9x_fPpPIIUezKHHtlkuNA1Hkc3sGNrkR9KHDEcsUuIxQTo&currency=CAD"></script>
    <!-- Cette Partie de JavaScrpt est OBLIGATOIRE pour le paypal -->
    <script>
             var grandTotal = <?= json_encode(number_format($grand_total, 2)) ?>;
    </script>
    <script src="paypal.js"></script>

</body>

</html>

