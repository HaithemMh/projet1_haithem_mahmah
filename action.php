<?php
session_start();
require 'config.php';

// Ajouter des produits dans le panier
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = $_POST['pqty'];
    $total_price = $pprice * $pqty;

    $query = "SELECT product_code FROM cart WHERE product_code=?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 's', $pcode);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $r = mysqli_fetch_assoc($res);
        $code = $r['product_code'] ?? '';

        if (!$code) {
            $insert_query = "INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code) VALUES (?, ?, ?, ?, ?, ?)";
            if ($insert_stmt = mysqli_prepare($conn, $insert_query)) {
                mysqli_stmt_bind_param($insert_stmt, 'ssssss', $pname, $pprice, $pimage, $pqty, $total_price, $pcode);
                mysqli_stmt_execute($insert_stmt);
                echo '<div class="alert alert-success alert-dismissible mt-2">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Article ajouté à votre panier !</strong>
                      </div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible mt-2">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Article déjà dans votre panier !</strong>
                  </div>';
        }
    }
}

// Récupérer le nombre d'articles dans le panier
if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    $query = "SELECT * FROM cart";
    $stmt = mysqli_query($conn, $query);
    echo mysqli_num_rows($stmt);
}

// Retirer un seul article du panier
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $query = "DELETE FROM cart WHERE id=?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'Article retiré du panier !';
        header('location:cart.php');
    }
}

// Retirer tous les articles du panier
if (isset($_GET['clear'])) {
    $query = "DELETE FROM cart";
    if (mysqli_query($conn, $query)) {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'Tous les articles ont été retirés du panier !';
        header('location:cart.php');
    }
}

// Mise à jour de la quantité dans le panier
if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];

    $query = "SELECT product_price FROM cart WHERE id=?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $pid);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($res);
        $pprice = $row['product_price'];

        $tprice = $qty * $pprice;

        $update_query = "UPDATE cart SET qty=?, total_price=? WHERE id=?";
        if ($update_stmt = mysqli_prepare($conn, $update_query)) {
            mysqli_stmt_bind_param($update_stmt, 'isi', $qty, $tprice, $pid);
            mysqli_stmt_execute($update_stmt);
        }
    }
}

// Traitement de la commande
if (isset($_POST['action']) && $_POST['action'] == 'order') {
    // Récupération des informations de la commande
    // ...
}

?>
