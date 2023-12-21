<?php
session_start();
include '../db.php';

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit_edit'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    
    // Préparer la requête pour obtenir les informations de l'utilisateur
    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // Afficher le formulaire de mise à jour avec les informations de l'utilisateur
        echo "<form action='update_user_process.php' method='post'>";
        echo "<input type='hidden' name='user_id' value='" . htmlspecialchars($user['user_id']) . "'>";
        echo "<label for='email'>Email:</label>";
        echo "<input type='email' name='email' value='" . htmlspecialchars($user['email']) . "' required>";
        echo "<label for='name'>Nom:</label>";
        echo "<input type='text' name='name' value='" . htmlspecialchars($user['name']) . "' required>";
        echo "<button type='submit' name='update_user'>Mettre à jour l'utilisateur</button>";
        echo "</form>";
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "Aucun ID d'utilisateur fourni pour la modification.";
}
?>
