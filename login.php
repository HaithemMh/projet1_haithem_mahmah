<?php 
session_start();
include 'header.php' ?>
<?php $form_to_show = isset($_GET['form']) ? $_GET['form'] : 'client'; ?>

<style>
    body {
        background: url('image/caps-banner.jpg') no-repeat center center; 
        background-size: cover;
        overflow-x: hidden; 
    }
    
    .transparent-card {
        background-color: rgba(255, 255, 255, 0.8); 
    }

    .jumbotron {
        background-color: rgba(255,0,0,0.2);
        padding: 15px 0;
        margin-bottom: 0; 
    }
    .btn-toggle {
        
    }
    
    .btn-toggle.active {
        background-color: #007bff; 
        color: white;
    }
    
    .btn-toggle.inactive {
        background-color: #6c757d; 
        color: white;
    }
</style>

<div class="jumbotron">
    <div class="container">
        <h1 class="display-4 text-white font-weight-bold">Login</h1>
        <p class="lead text-white font-weight-bold">"Veuillez vous connecter pour explorer le magasin."</p>
    </div>
</div>

<section style="min-height: calc(100vh - [height of your jumbotron]);">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5 transparent-card">
                    <div class="card-body p-4 p-sm-5">
                        <!-- Les boutons pour choisir le formulaire -->
                        <div class="text-center mb-5">
                            <a href="?form=client" class="btn btn-toggle <?php echo $form_to_show == 'client' ? 'active' : 'inactive'; ?>">Client</a>
                            <a href="?form=admin" class="btn btn-toggle <?php echo $form_to_show == 'admin' ? 'active' : 'inactive'; ?>">Admin</a>
                        </div>
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Se Connecter</h5>
                        
                        <!-- Formulaire pour les clients -->
                        <?php if ($form_to_show == 'client'): ?>
                            <form method="post" action="connexion-action.php">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail">
                                <label for="email">Adresse e-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe">
                                <label for="motdepasse">Mot de passe</label>
                            </div>

                            <div class="d-grid text-center">
                                <button class="btn btn-primary btn-login text-uppercase text-center fw-bold" name="submit_client" type="submit">Connexion</button>
                            </div>
                            <hr class="my-4">
                            <div class="d-grid text-center">
                                <a href="register.php" class="text-center">S'inscrire</a>
                            </div>
                            </form>
                        <?php endif; ?>
                        
                        <!-- Formulaire pour les administrateurs -->
                        <?php if ($form_to_show == 'admin'): ?>
                            <form method="post" action="connexion-action.php">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="admin_email" name="admin_email" placeholder="Adresse Email">
                                <label for="admin_email">Adresse Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="admin_nom" name="admin_nom" placeholder="Nom d'administrateur">
                                <label for="admin_nom">Nom d'administrateur</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="motdepasse_admin" name="motdepasse_admin" placeholder="Mot de passe">
                                <label for="motdepasse_admin">Mot de passe</label>
                            </div>

                            <div class="d-grid text-center">
                                <button class="btn btn-primary btn-login text-uppercase text-center fw-bold" name="submit_admin" type="submit">Connexion</button>
                            </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



