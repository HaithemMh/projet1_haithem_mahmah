<?php
session_start();

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

    if (!empty($new_password)) {
        $update_query = "UPDATE users SET name='$name', password='$new_password' WHERE user_id='$user_id'";
    } else {
        $update_query = "UPDATE users SET name='$name' WHERE user_id='$user_id'";
    }

    if (mysqli_query($conn, $update_query)) {
        echo "Profil mis à jour avec succès";
    } else {
        echo "Erreur: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete_account'])) {
    $delete_query = "DELETE FROM users WHERE user_id='$user_id'";
    if (mysqli_query($conn, $delete_query)) {
        session_destroy();
        header('Location: login.php');
        exit;
    } else {
        echo "Erreur lors de la suppression du compte : " . mysqli_error($conn);
    }
}

$user_query = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($conn, $user_query);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Aucun utilisateur trouvé";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil de l'utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
        }

        input[type="text"], input[type="password"] {
            margin: 10px 0;
            padding: 10px;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .profile-logo {
            margin-bottom: 20px;
            width: 100px; /* Ajustez la largeur comme souhaité */
            height: auto; /* 'auto' pour conserver les proportions de l'image */
        }

    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Logo de Profil -->
    <img src="image/logo-profil.png" alt="Logo Profil" class="profile-logo">

    <!-- Formulaire de mise à jour du profil -->
    <form method="post">
        <input type="text" name="name" placeholder="Nom" required value="<?php echo htmlspecialchars($row['name']); ?>">
        <input type="password" name="new_password" placeholder="Nouveau mot de passe">
        <button type="submit" name="update_profile">Mettre à jour le profil</button>
        <button type="submit" name="delete_account" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action ne peut pas être annulée.');">Supprimer le compte</button>
    </form>

    
</body>
</html>

