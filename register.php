<?php include 'header.php' ?>

<style>
    body {
        background: url('image/caps-banner.jpg') no-repeat center center; 
        background-size: cover;
    }
    
    .transparent-card {
        background-color: rgba(255, 255, 255, 0.7); /* Fond blanc avec une opacité de 70% */
    }
</style>

<div class="jumbotron" style="background-color: rgba(255,0,0,0.2); padding: 15px 0; height: auto;">
  <div class="container">
    <h1 class="display-4 text-white font-weight-bold">Inscription</h1>
    <p class="lead text-white font-weight-bold">"Veuillez vous inscrire pour explorer la boutique."</p>
  </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card transparent-card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Inscription</h5>
                        <form method="post" action="action-inscription.php">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre Nom">
                                <label for="nom">Nom</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre adresse e-mail">
                                <label for="email">Adresse e-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe">
                                <label for="motdepasse">Mot de passe</label>
                            </div>
                            
                            <div class="d-grid text-center">
                                <button class="btn btn-primary btn-login text-uppercase text-center fw-bold" name="submit" type="submit">S'inscrire</button>
                            </div>
                            <hr class="my-4">
                            <div class="d-grid text-center">
                                <a href="login.php" class="text-center">Connexion</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
