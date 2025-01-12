
<div class="center">
    <h1 title-page>Gestion des thèmes</h1>
</div>

<div class="card-livre small-center">
    <div class="card-content-livre container" style="width: 70%">

        <form class="form-container" name="form_update_themes" action="<?= NAME_SITE.'/admin/themes/update' ?>" method="POST">
            <h2 class="red">Activation ☑︎</h2>
            <div class="form-group input-row">
                <label for="theme_id">Thème actif : </label>
                <select id="theme_id" name="theme_id">
                    <?php foreach($params['themes'] as $theme): ?>
                        <option value="<?= $theme->id ?>" <?= $theme->actif ? 'selected' : '' ?>>
                            <?= $theme->nom ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="center">
                <input class="btn btn-form btn-golden" type="submit" value="Activer"/>
            </div>
        </form>
        <form class="form-container" name="form_delete_theme" action="<?= NAME_SITE.'/admin/themes/delete' ?>" method="POST">
            <h2 class="red">Suppression -</h2>
            <div class="form-group input-row">
                <select id="theme_id" name="theme_id">
                <?php foreach($params['themes'] as $theme): ?>
                    <?php if($theme->actif == 0): ?>
                        <option value="<?= $theme->id ?>">
                            <?= $theme->nom ?>
                        </option>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
            </div>
            <div class="center">
                <input 
                class="btn btn-form btn-warning" 
                onclick="confirmerSubmit()" 
                type="submit" 
                value="Supprimer"/>
            </div>
        </form>
        <form class="form-container" name="form_add_theme" action="<?= NAME_SITE.'/admin/themes/add' ?>" method="POST">
            <h2 class="red">Ajout +</h2>
            <div class="form-group input-row">
                <label for="nom">Nom du thème : </label>
                <input type="text" name="nom" id="nom" required/>
            </div>
            <div class="form-group">
                <label for="actif">Actif après ajout : </label>
                <span>
                    <input type="radio" name="actif" id="actif-1" value="1" >
                    <label for="actif-1">Oui</label>
                </span>
               <span>
                    <input type="radio" name="actif" id="actif-0" value="0" checked>
                    <label for="actif-0">Non</label>
               </span>
                
            </div>
            <div class="center">
                <input class="btn btn-form btn-green" type="submit" value="Ajouter"/>
            </div>
        </form>
        <div class="center">
            <a class="btn btn-big btn-golden" href="<?= NAME_SITE.'/admin/ouvrages' ?>">Retour</a>
        </div>
    </div>
</div>
<script>
    function confirmerSubmit(idSubmit){
    var res = confirm("⚠️ Êtes-vous sûr de vouloir supprimer ce thème ?");
    if(res){
        event.target.click();
    }}
</script>