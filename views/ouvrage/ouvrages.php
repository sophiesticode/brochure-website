<div class="center">
    <h1 title-page><?= $params['titre'] ?></h1>
</div>

<?php if(isset($params['message'])): ?>
<div class="content-message container center">
    <div class="corner-left corner-message" style="background-image: url(<?= ICONS.'coin-livre.svg' ?>);"></div>
    <p><?= $params['message'] ?></p>
    <div class="corner-right corner-message" style="background-image: url(<?= ICONS.'coin-livre.svg' ?>);"></div>
</div>
<?php endif ?>

<div class="container center">
    <a class="btn btn-form btn-golden" href="<?= NAME_SITE.'/contact'?>">CONTACT</a>
</div>
    
<div class="spacer-25"></div>

<div class="flex-galerie-conteneur">

    <?php foreach($params['ouvrages'] as $keyOuvrage => $ouvrage): ?>

        <div class="flex-galerie" <?= $ouvrage->deux==1 ? 'deux':'' ?>>

            <div class="carousel-container same-height" id="carousel-<?= $keyOuvrage ?>" >
                <p class="card-title-livre"><?= $ouvrage->nom ?></p>

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

