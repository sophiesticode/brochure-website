
<div class="center">
    <h1 title-page>Galerie</h1>
</div>

<div class="flex-galerie-conteneur">

    <?php foreach($params['ouvrages'] as $keyOuvrage => $ouvrage): ?>
        <div class="flex-galerie" style="height: 620px" <?= $ouvrage->deux==1 ? 'deux':'' ?>>

            <div class="carousel-container same-height" id="carousel-<?= $keyOuvrage ?>" >
                 <a href="<?= NAME_SITE. '/admin/ouvrages/edit/'. $ouvrage->id ?>"><p class="card-title-livre"><?= '['.$ouvrage->id.'] '.$ouvrage->nom ?></p></a>

                <?php foreach($ouvrage->getCategories() as $categorie): ?>
                    <span class="tag tag-<?= $categorie->nom ?>"><?= $categorie->nom ?></span> 
                <?php endforeach ?>

                <?php foreach($ouvrage->getItems() as $key=>$item): ?>
                    <div <?= $key==0 ? 'class="image-active"' : ''?>>
                        <img src="<?= IMAGES.$item->img ?>" alt="<?= $item->label ?>" class="fade">
                        <?php if($item->label != ""):?>
                            <p style="margin: 0px"><?= $item->label ?></p>
                        <?php endif ?>
                    </div> 
                <?php endforeach ?>

                <?php if(count($ouvrage->getItems()) > 1): ?>
                    <button class="btn-carousel btn-prev" onClick="onPrevClick()">
                        <i class="fas fa-arrow-circle-left icon-carousel icon-prev"></i>
                    </button>
                    <button class="btn-carousel btn-next" onClick="onNextClick()">
                        <i class="fas fa-arrow-circle-right icon-carousel icon-next"></i>
                    </button>
                <?php endif ?>
                
            </div>
        </div> 
    
    <?php endforeach ?>
 </div>
<div class="center">
    <a class="btn btn-big btn-golden" href="<?= NAME_SITE.'/admin/ouvrages' ?>">Retour</a>
</div>
 