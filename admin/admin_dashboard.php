<?php
session_start();
include '../db.php'; 

// Code pour vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
// Code pour récupérer des statistiques ou des informations pour le tableau de bord
$query = "SELECT COUNT(*) AS total_users FROM users";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalUsers = $row['total_users'];
} else {
    // Gestion des erreurs si la requête échoue
    $totalUsers = "Erreur lors de la récupération des données";
}

// récupérer le nombre total de commandes
$query = "SELECT COUNT(*) AS total_orders FROM orders";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalOrders = $row['total_orders'];
} else {
    // Gestion des erreurs si la requête échoue
    $totalOrders = "Erreur lors de la récupération des données";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Administrateur</title>
    <style>
        /* Styles CSS pour la mise en page de la page d'administration */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        div {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px #888888;
        }

        h2 {
            color: #333;
        }

        p {
            color: #777;
        }
    </style>
</head>
<body>
<h1>Tableau de Bord Administrateur</h1>
    
    <div>
        <h2>Statistiques</h2>
        <p>Total des Utilisateurs : <?php echo $totalUsers; ?></p>
        <p>Total des Commandes : <?php echo $totalOrders; ?></p>
    </div>
    <div>
    <!-- Formulaire pour ajouter des administrateurs -->
<h2 style="text-align: center; color: #333;">Ajouter un Administrateur</h2>
<form action="ajouter_admin.php" method="post" style="max-width: 400px; margin: 0 auto; background-color: #f5f5f5; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px 0px #888888;">
    <div style="margin-bottom: 20px;">
        <label for="admin_email" style="display: block; font-weight: bold; color: #555;">Adresse Email :</label>
        <input type="email" id="admin_email" name="admin_email" required style="width: 100%; padding: 10px; border: none; background-color: #f0f0f0; border-radius: 5px;">
    </div>
    
    <div style="margin-bottom: 20px;">
        <label for="mot_de_passe_admin" style="display: block; font-weight: bold; color: #555;">Mot de Passe :</label>
        <input type="password" id="mot_de_passe_admin" name="mot_de_passe_admin" required style="width: 100%; padding: 10px; border: none; background-color: #f0f0f0; border-radius: 5px;">
    </div>
    
    <div style="text-align: center;">
        <button type="submit" style="background-color: #333; color: #fff; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer;">Ajouter Admin</button>
    </div>
</form>
<h2>Navigation</h2>
    <ul>
        <li><a href="manage_products.php">Gestion des Produits</a></li>
        <li><a href="manage_users.php">Gestion des Utilisateurs</a></li>
    </ul>



</div>
</body>
</html>
