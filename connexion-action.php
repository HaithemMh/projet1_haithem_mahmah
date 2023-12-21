<?php 					
include 'db.php';
session_start();
if (isset($_POST['submit_client'])) {
    if(isset($_POST['email']) && isset($_POST['motdepasse'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['motdepasse']);
        $query = "SELECT * FROM `users` WHERE email='$email';";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row['password']) {
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION["user_email"] = $row['email'];
                header("Location: index.php");
                exit;
            } else {
                echo 'Login Failed. Invalid Credentials';
            }
        } else {
            echo 'Login Failed. User Details not found';
        }
    }
}
if (isset($_POST['submit_admin'])) {
    // Traitement de la connexion administrateur
    $admin_nom = mysqli_real_escape_string($conn, $_POST['admin_nom']);
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $motdepasse_admin = mysqli_real_escape_string($conn, $_POST['motdepasse_admin']);
    $query = "SELECT * FROM `admins` WHERE admin_nom='$admin_nom' AND admin_email='$admin_email';";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($motdepasse_admin == $row['mot_de_passe_admin']) {
            // Connexion admin réussie
            session_start();
            $_SESSION["admin_id"] = $row['admin_id'];
            $_SESSION["admin_nom"] = $row['admin_nom'];
            $_SESSION["admin_email"] = $row['admin_email'];
            echo("<script>window.location = 'admin/admin_dashboard.php';</script>");
        } else {
            // Mot de passe administrateur incorrect
            echo '<script>alert("Mot de passe administrateur incorrect");</script>';
            echo("<script>window.location = 'login.php';</script>");
        }
    } else {
        // Nom d'administrateur non trouvé
        echo '<script>alert("Nom d\'administrateur non trouvé");</script>';
        echo("<script>window.location = 'login.php';</script>");
    }
}
?>

