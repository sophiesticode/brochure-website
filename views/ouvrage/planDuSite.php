<div class="center">
    <h1 title-page>Plan du site</h1>
</div>

<div class="card-livre small-center">
    <div class="card-content-livre" plan>
        <ul>
            <li><a href="<?= NAME_SITE.'/reliures'?>">Reliures</a></li>
            <li><a href="<?= NAME_SITE.'/restaurations'?>">Restaurations</a></li>
            <li><a href="<?= NAME_SITE.'/boites'?>">Boîtes</a></li>
            <li><a href="<?= NAME_SITE.'/theme'?>">Thème</a></li>
            <li><a href="<?= NAME_SITE.'/tradition'?>">Tradition</a></li>
            <li><a href="<?= NAME_SITE.'/tarifs'?>">Tarifs</a></li>
            <li><a href="<?= NAME_SITE.'/contact'?>">Contact</a></li>
        </ul>
    </div>
</div>
<style>
    .card-content-livre ul li {
        list-style-image : url(<?=  ICONS.'puce.svg' ?>);
    }
    .card-content-livre[plan] {
        background-color: transparent;
        background-size: 100px; 
        background-repeat: no-repeat; background-position: 96% 100%;
        background-image : url("<?=  ICONS.'coin-livre.svg' ?>");
    }
</style>