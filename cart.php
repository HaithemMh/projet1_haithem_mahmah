<?php
session_start();
require 'config.php';

// Logique pour mettre à jour la quantité d'un article
if (isset($_POST['update_item_qty'])) {
  $pid = $_POST['pid'];
  $qty = $_POST['qty'];

  if ($qty > 0) {
      $update_query = "UPDATE cart SET qty=? WHERE id=?";
      if ($stmt = mysqli_prepare($conn, $update_query)) {
          mysqli_stmt_bind_param($stmt, 'ii', $qty, $pid);
          mysqli_stmt_execute($stmt);

          if (mysqli_stmt_affected_rows($stmt) > 0) {
              $_SESSION['showAlert'] = 'block';
              $_SESSION['message'] = 'Quantité mise à jour dans le panier.';
          } else {
              $_SESSION['showAlert'] = 'block';
              $_SESSION['message'] = 'Aucune modification apportée à la quantité.';
          }
      }
  } else {
      $_SESSION['showAlert'] = 'block';
      $_SESSION['message'] = 'Quantité non valide.';
  }

  header('location:cart.php');
  exit;
}

// Compter le nombre total d'articles dans le panier
$total_items_in_cart_query = "SELECT SUM(qty) AS total_items FROM cart";
$total_items_in_cart_result = mysqli_query($conn, $total_items_in_cart_query);
$row = mysqli_fetch_assoc($total_items_in_cart_result);
$total_items_in_cart = $row['total_items'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cart</title>
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
        <img src="image/logo.png" alt="Kaskita Store Logo" height="40">
        &nbsp;&nbsp;Kaskita Store
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-th-list mr-2"></i>Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"><?= $total_items_in_cart ?></span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div style="display:<?php if (isset($_SESSION['showAlert'])) { echo $_SESSION['showAlert']; } else { echo 'none'; } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['message'])) { echo $_SESSION['message']; } unset($_SESSION['message']); ?></strong>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <td colspan="7">
                                <h4 class="text-center text-info m-0">Produits dans votre panier !</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Prix Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM cart";
                        $result = mysqli_query($conn, $query);
                        $grand_total = 0;
                        while ($row = mysqli_fetch_assoc($result)):
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><img src="<?= htmlspecialchars($row['product_image']) ?>" width="50"></td>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td><?= number_format($row['product_price'], 2); ?></td>
                            <td>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="pid" value="<?= htmlspecialchars($row['id']) ?>">
                                    <input type="number" name="qty" class="form-control" value="<?= htmlspecialchars($row['qty']) ?>" style="width:75px;">
                                    <button type="submit" name="update_item_qty" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                            <td><?= number_format($row['total_price'], 2); ?></td>
                            <td>
                                <a href="action.php?remove=<?= htmlspecialchars($row['id']) ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php $grand_total += $row['total_price']; ?>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3">
                                <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                            </td>
                            <td colspan="2"><b>Grand Total</b></td>
                            <td><b><?= number_format($grand_total, 2); ?></b></td>
                            <td>
                                <a href="checkout.php" class="btn btn-info <?= ($grand_total > 0) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

</body>
</html>
