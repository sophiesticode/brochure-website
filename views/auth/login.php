
<div class="center">
    <h1 title-page>Connexion</h1>
</div>

<div class="card-livre small-center">
    <div class="card-content-livre">

        <form action="<?= NAME_SITE.'/login' ?>" method="POST">
            <div class="form-group input-row">
                <label for="nom" >Nom d'utilisateur : </label>
                <input type="text" name="nom" id="nom" placeholder="votre login">
            </div>
            <div class="form-group input-row">
                <label for="mdp" >Mot de passe : </label>
                <input type="password" name="mdp" id="mdp" placeholder="votre mot de passe">
            </div>
            <div class="btn-container">
                <input class="btn btn-form btn-green" type="submit" value="Se connecter"/>
            </div>
            
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
        <?php session_destroy() ?>
        <?php if(isset($_GET['success']) && $_GET['success']=='false'): ?>
            <div class="center">
                <p class="red">Login et/ou Mot de passe incorrect(s)</p>
            </div>
        <?php endif ?>
    </div>
</div>
