<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

// Ajouter un produit
if (isset($_POST['add'])) {
    
    $nomProduit = mysqli_real_escape_string($conn, $_POST['nom_produit']);
    $prixProduit = mysqli_real_escape_string($conn, $_POST['prix_produit']);
    // Ajoutez ici des validations supplémentaires si nécessaire

    $query = "INSERT INTO product (`id`, `product_name`, `product_price`, `product_qty`, `product_image`, `product_code`) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sd', $nomProduit, $prixProduit);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Produit ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du produit.";
    }
}


// Supprimer un produit
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);

    $query = "DELETE FROM product WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Produit supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du produit.";
    }
}




// Afficher tous les produits
$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Produits</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers le fichier CSS externe -->
</head>
<style> 
.product-image {
  width: 100px; /* ou une autre taille fixe */
  height: auto; /* pour maintenir le ratio de l'image */
  object-fit: cover; /* cela va couvrir l'espace défini sans déformer l'image */
}
</style>
<body>
    <h1>Gestion des Produits</h1>
    <!-- Formulaire pour ajouter un nouveau produit -->
    <form method="post" enctype="multipart/form-data">
    <input type="text" name="nom_produit" placeholder="Nom du Produit" required>
    <input type="number" name="prix_produit" placeholder="Prix" required>
    <input type="number" name="quantite_produit" placeholder="Quantité" required>
    <input type="file" name="photo_produit" required>
    <input type="text" name="code_produit" placeholder="Code du Produit" required>
    <button type="submit" name="add">Ajouter Produit</button>
</form>

    
    <!-- Liste des produits -->
    <table>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Photo</th>
            <th>Code</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <form method="post" action="manage_products.php">
                <td><input type="text" name="product_name" value="<?= htmlspecialchars($row['product_name']) ?>"></td>
                <td><input type="number" name="product_price" value="<?= htmlspecialchars($row['product_price']) ?>"></td>
                <td><input type="number" name="product_qty" value="<?= htmlspecialchars($row['product_qty']) ?>"></td>
                <td><img src="../images/<?= htmlspecialchars($row['product_image']) ?>" alt="Image du produit" class="product-image"></td>
                <td><?= htmlspecialchars($row['product_code']) ?></td>
                <td>
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="update">Sauvegarder</button>
                    <a href="manage_products.php?delete=<?= $row['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');">Supprimer</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
    <h2>Navigation</h2>
    <ul>
        <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
        <li><a href="manage_users.php">Gestion des Utilisateurs</a></li>
    </ul>
</body>
</html>
