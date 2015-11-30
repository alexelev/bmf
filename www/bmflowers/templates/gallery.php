<!doctype html>
<html lang="ru">
<head>
    <?= $this->displayTemplate('chunks/meta'); ?>
    <link rel="stylesheet" href="<?=App::siteUrl('/assets/plugins/lightbox/css/lightbox.css')?>">
</head>

<body>
<nav class="not_main">
    <ul>
        <li><a href="#">новости</a></li>
        <li><a href="#">статьи</a></li>
        <li><a href="#">каталоги</a></li>
        <li><a href="#">заказ</a></li>
        <li><a href="#">отзывы</a></li>
    </ul>
</nav>
<div class="not_main_wrap">
    <a href="<?=App::getLink('index')?>" class="not_main_logo"></a>
    <div class="backing">
        <h1><?=$_GET['gallery']?></h1>
        <?
            foreach($this->plants as $key => $plant){ ?>
                <a href="<?= App::siteUrl('images_gallery/' . $_GET['gallery'] . '/' . $plant) ?>" data-lightbox="<?=$_GET['gallery']?>" data-title="<?=substr($plant, 0, -4)?>">
                    <img src="<?= App::siteUrl('images_gallery/' . $_GET['gallery'] . '/' . $plant) ?>" alt="" class="img-thumbnail" data-size>
                </a>
            <?} ?>
    </div>
</div>

<?= $this->displayTemplate('chunks/scripts'); ?>
<script src="<?=App::siteUrl('/assets/plugins/lightbox/js/lightbox.min.js')?>"></script>
</body>
</html>