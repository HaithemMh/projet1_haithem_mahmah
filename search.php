<?php
// search.php
include 'config.php';
include 'header.php'; // Assurez-vous que ce fichier contient la barre de navigation

$search_value = $_GET['search'] ?? ''; // Obtenez la valeur de recherche de l'URL

// Préparez et exécutez la requête de recherche
$query = "SELECT * FROM product WHERE product_name LIKE CONCAT('%', ?, '%')";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $search_value);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats de recherche</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Résultats de recherche pour "<?php echo htmlspecialchars($search_value); ?>"</h2>
    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($row['product_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['product_name']) ?>" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['product_name']) ?></h5>
                            <p class="card-text"><?= number_format($row['product_price'], 2) ?> $</p>
                            <p class="card-text">Il reste seulement <?= htmlspecialchars($row['product_qty']) ?> dans ce produit.</p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='col'>Aucun produit trouvé pour votre recherche.</p>";
        }
        ?>
    </div>
</div>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

</body>
</html>
