<?php // repertoire.php

// Inclusion du header de la page
require_once (__DIR__ . '/partials/header.php');

// 1. Déclaration de variables

$firstname = $lastname = $username = $instagram = $followers = $priceperpost = $email = $message = null;

// 2. Traitement POST du formulaire (si $_POST n'est pas vide)
if(!empty($_POST)) { // Vérifier que le formulaire a été soumis

    // 3. Affectation des variables
    // Récupération des données saisies dans le formulaire
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $instagram = $_POST['instagram'];
    $followers = $_POST['followers'];
    $priceperpost = $_POST['priceperpost'];
    $email = $_POST['email'];


    // 4. Verification des données saisies
    $errors = []; // Création d'un tableau pour stocker les erreurs

    if (empty($firstname)) {
        $errors['firstname'] = "Vous avez oublié de saisir le Prénom";
    }
    if (empty($lastname)){
        $errors['lastname'] = "Vous avez oublié de saisir le Nom";
    }
    if (empty($username)) {
        $errors['username'] = "Vous avez oublié de saisir le Surnom";
    }
    if (empty($instagram)) {
        $errors['instagram'] = "Vous avez oublié de saisir le compte Instagram";
    }
    if (empty($followers)) {
        $errors['followers'] = "Vous avez oublié de saisir le nombre de followers";
    }
    if (empty($priceperpost)) {
        $errors['priceperpost'] = "Vous avez oublié de saisir le coût par post";
    }

    if (empty($email)) {
        $errors['email'] = "Vous avez oublié de saisir l'email, saisir 'no email' si il n'y a pas d'email";
    }

    // 5. Après les véirification, je vérifie s'il y a des erreurs dans le tableau
    if (empty($errors)) {
        // dans cette condition, la tableau est vide. Pas d'erreur...
        // Insertion dans la BDD
        $idInfluencers = addInfluencer($firstname, $lastname, $username, $instagram, $followers, $priceperpost, $email );
        if ($idInfluencers){
            //redirection ('manage-influencers.php');
            //return $message = 'Le nouvel Influenceur a bien été ajouté';
        }
    } else {
        // Le tableau n'est pas vide. Il y a des erreurs.
        // Affichage des erreurs à l'utilisateur
        $message = '
        <div class="alert alert-danger">
        Attention, veuillez bien remplir vos champs.
        </div>
        ';
    }
}



?>

<!-- Contenu de la page -->

    <!-- Liste des influenceurs -->
    <div class="p-3 mx-auto text-center">
        <h2 class="display-4">Liste des influenceurs</h2>
    </div>

    <div class="py-5 bg-light">
        <div class="container ">
            <div class="row">
                <div class="col">
                    <div class="card shadow-sm p-4" >
                        <form>
                            <div class="form-group">
                                <select class="form-control" id="influencer">
                                <option value="" selected disabled>Sélectionnez un influenceur</option>                                                                    
                                <?php $influencerslist = getInfluencers();
                                    while($ligne = $influencerslist->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $ligne['id'] . '">' . 
                                    $ligne['firstname'] . ' ' .  $ligne['lastname'];
                                    }
                                ?>
                                </option>
                                </select>
                                <hr>
                                <div id="resultat"></div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire ajout véhicule -->

    <div class="p-3 mx-auto text-center">
        <h2 class="display-4">Ajouter un influcenceur</h2>
    </div>

    <div class="py-5 bg-light">
        <div class="container ">
            <div class="row">
                <div class="col">
                    <div class="card shadow-sm p-4" >
                        <?= $message ?>
                        <form method="post">
                            <!--  first name -->
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" name="firstname"
                                    placeholder="Saisissez le prénom de l'influenceur"
                                    class="form-control <?= isset($errors['prenom']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['prenom']) ? $errors['prenom'] : '' ?>
                                </div>
                            </div>

                            <!--  last name -->
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="lastname"
                                    placeholder="Saisissez la nom de l'influenceur"
                                    class="form-control <?= isset($errors['lastname']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['lastname']) ? $errors['lastname'] : '' ?>

                                </div>
                            </div>

                            <!--  username -->
                            <div class="form-group">
                                <label>Surnom</label>
                                <input type="text" name="username"
                                    placeholder="Saisissez le surnom de l'influenceur"
                                    class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['username']) ? $errors['username'] : '' ?>
                                </div>
                            </div>

                            <!--  instagram -->
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" name="instagram"
                                    placeholder="Saisissez l'Instagram de l'influenceur"
                                    class="form-control <?= isset($errors['instagram']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['instagram']) ? $errors['instagram'] : '' ?>
                                </div>
                            </div>

                            <!--  followers -->
                            <div class="form-group">
                                <label>Nombre de followers</label>
                                <input type="text" name="followers"
                                    placeholder="Saisissez le nombre de followers de l'influenceur"
                                    class="form-control <?= isset($errors['followers']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['followers']) ? $errors['followers'] : '' ?>
                                </div>
                            </div>

                            <!--  price per post -->
                            <div class="form-group">
                                <label>Prix par publication</label>
                                <input type="text" name="priceperpost"
                                    placeholder="Saisissez le prix par publication de l'influenceur"
                                    class="form-control <?= isset($errors['priceperpost']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['priceperpost']) ? $errors['priceperpost'] : '' ?>
                                </div>
                            </div>   

                            <!--  email -->
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email"
                                    placeholder="Saisissez l'email de l'influenceur"
                                    class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= isset($errors['email']) ? $errors['email'] : '' ?>
                                </div>
                            </div>                                             

                            

                            <!--  submit -->
                            <button class="btn btn-block btn-dark">
                                Ajouter l'influenceur
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

// Inclusion du footer de la page
require_once(__DIR__ . '/partials/footer.php');

?>





