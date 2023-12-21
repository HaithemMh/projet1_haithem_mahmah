<?php
session_start();
include '../db.php';

// Vérification de l'administrateur
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Code pour afficher, modifier, supprimer des utilisateurs


// récupérer la liste des utilisateurs
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if ($result) {
    // Affichage de la liste des utilisateurs
    echo "<h1>Gestion des Utilisateurs</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Email</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        // Ajoutez d'autres colonnes pour afficher d'autres informations si nécessaire
        echo "</tr>";
    }

    echo "</table>";
} else {
    // Gestion des erreurs si la requête échoue
    echo "Erreur lors de la récupération des utilisateurs";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
<div>
    <h2>Modifier un Utilisateur</h2>
    <form method="post" action="update_user.php">
        <label for="user_id">ID de l'Utilisateur à Modifier :</label>
        <input type="number" name="user_id" id="user_id" required>
        <button type="submit" name="submit_edit">Modifier</button>
    </form>
</div>


<div>
    <h2>Supprimer un Utilisateur</h2>
    <form method="post" action="delete_user.php">
        <label for="user_id_delete">ID de l'Utilisateur à Supprimer :</label>
        <input type="text" name="user_id_delete" id="user_id_delete" required>
        <button type="submit">Supprimer</button>
    </form>
</div>
<h2>Navigation</h2>
    <ul>
        <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
        <li><a href="manage_products.php">Gestion des produits</a></li>
    </ul>

</body>
</html>

