<?php 
include 'db.php';

if (isset($_POST['submit'])) {
    if(isset($_POST['email']) && isset($_POST['motdepasse']) && isset($_POST['nom'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['motdepasse']); // Mot de passe en clair
        $name = mysqli_real_escape_string($conn, $_POST['nom']);

        $query = "SELECT * FROM `users` WHERE email='$email';";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<script>alert("Cet email est déjà utilisé. Veuillez essayer avec un autre email.")</script>';
            echo "<script>window.location = 'register.php';</script>";
        } else {
            // Insérer le mot de passe en clair dans la base de données
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password');";
            $result = mysqli_query($conn, $query);

            if($result) {
                echo '<script>alert("Inscription réussie. Veuillez vous connecter maintenant.")</script>';
                echo "<script>window.location = 'login.php';</script>";
            } else {
                echo '<script>alert("Échec de l\'inscription.")</script>';
                echo "<script>window.location = 'register.php';</script>";    
            }
        }
    }
} 
?>
