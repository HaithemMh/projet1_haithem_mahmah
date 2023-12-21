<?php
session_start();
include '../db.php';

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assainir l'ID de l'utilisateur
    $user_id_delete = filter_input(INPUT_POST, 'user_id_delete', FILTER_SANITIZE_NUMBER_INT);

    // Préparer la requête SQL pour supprimer l'utilisateur
    $query = "DELETE FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id_delete);
    $success = mysqli_stmt_execute($stmt);

        // Redirection vers la page d'origine
        header("Location: manage_users.php");
        exit;
}
?>
