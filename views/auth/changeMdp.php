
<div class="center">
    <h1 title-page>Changer mon mot de passe</h1>
</div>


<div class="card-livre small-center">
    <div class="card-content-livre">

    
        <form action="<?= NAME_SITE.'/admin/change-mdp' ?>" method="POST">
            <div class="form-group input-row green">
                <label for="mdp" >Nom d'utilisateur : </label>
                <input type="text" disabled placeholder="<?= $_SESSION['nom_user'] ?>">
            </div>
            <div class="form-group input-row">
                <label for="mdp" >Nouveau mot de passe : </label>
                <input type="password" name="mdp" id="mdp" placeholder="nouveauMotDePasse">
            </div>
            <div class="form-group input-row">
                <label for="mdp-confirm" >Confirmation du mot de passe : </label>
                <input type="password" name="mdp-confirm" id="mdp-confirm" placeholder="nouveauMotDePasse">
            </div>
            <div class="btn-container">
                <input class="btn btn-form btn-green" type="submit" value="Modifier"/>
            </div>
            <small class="red">caractère interdit : ' : '</small>
            
        </form>

        <?php if(isset($_SESSION['errors'])) :?>
            <?php foreach($_SESSION['errors'] as $errorsArray): ?>
                <?php foreach($errorsArray as $errors): ?>
                    <div class="red">
                        <?php foreach($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach ?>
                    </div>
                <?php endforeach ?>
            <?php endforeach ?>
        <?php endif ?>
        <?php $_SESSION['errors'] = null ?>
       
        <div class="center">
                <?php if(isset($_GET['success'])): ?>
                <p style="color: green">Mot de passe modifié</p>
                <?php endif ?>
            <a class="btn btn-form btn-golden" href="<?= NAME_SITE.'/admin/ouvrages' ?>">Retour</a>
        </div>
       
        
    </div>
</div>
