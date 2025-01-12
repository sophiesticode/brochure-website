
<div class="center">
    <?php if(isset($_GET['success'])): ?>
        <h2 style="color: green">Bonjour <?= ucfirst($_SESSION['nom_user'])?>, vous êtes connecté</h2>
    <?php endif ?>
    <h1 title-page>Administration des ouvrages</h1>
</div>


<div class="center">
    <a class="btn btn-big btn-green" href="<?= NAME_SITE.'/admin/ouvrages/add/'?>">Ajouter un ouvrage</a>
    <a class="btn btn-big btn-golden" href="<?= NAME_SITE.'/admin/themes'?>">Gestion des thèmes</a>
    <a class="btn btn-big btn-green" href="<?= NAME_SITE.'/admin/ouvrages/galerie'?>">Galerie</a>
</div>

<div class="card-livre">
    <div class="card-content-livre">
        <table class="styled-table">
            <thead>
                <th>Ref</th>
                <th>Nom</th>
                <th>Visible</th>
                <th>Thème</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($params['ouvrages'] as $ouvrage): ?>
                    <tr>
                        <td>[<strong><?= $ouvrage->id ?></strong>]</td>
                        <td><?= $ouvrage->nom ?></td>
                        <td style="font-size: 25px"><?= $ouvrage->visible==1 ? '✓': ''?></td>
                        <td><small><?php $theme = $ouvrage->getTheme();if(-$theme->id != 0):?>
                                <div class=""><?= $theme->nom ?></div> 
                            <?php endif ?></small></td>
                        <td>
                            <a id="edit-<?= $ouvrage->id ?>" class="btn btn-form btn-golden" href="<?= NAME_SITE.'/admin/ouvrages/edit/'.$ouvrage->id ?>">Modifier</a>
                            <form 
                                style="display: inline-block;" 
                                action="<?= NAME_SITE.'/admin/ouvrages/delete/'.$ouvrage->id ?>" 
                                method="POST" >
                                <input 
                                    type="button" 
                                    onclick="confirmerSubmit('submit-<?= $ouvrage->id ?>', '<?= $ouvrage->nom ?>')" 
                                    class="btn btn-form btn-warning" 
                                    value="Supprimer">
                                <input id="submit-<?= $ouvrage->id ?>" style="display: none" type="submit">
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="spacer-25"></div>
        <div class="center">
            <a class="btn btn-big btn-golden" href="<?= NAME_SITE.'/admin/change-mdp'?>">Changer mon mot de passe</a>
        </div>
    </div>
</div>
<script>
    function confirmerSubmit(idSubmit, nomOuvrage){
    var res = confirm("⚠️ Êtes-vous sûr de vouloir supprimer [ " + nomOuvrage + " ] ?");
    if(res){
        document.getElementById(idSubmit).click();
    }}
</script>