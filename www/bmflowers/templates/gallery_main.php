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
        <h1>Галерея</h1>
        <?
        foreach($this->galleries as $key => $gallery){ ?>
            <a href="<?= App::getLink('gallery', array('gallery' => $gallery)) ?>">
                <img src="<?= App::siteUrl('images_gallery/' . $gallery . '/' . scandir($gallery))[2] ?>" alt="" class="img-thumbnail" data-size>
            </a>
        <?} ?>
    </div>
</div>

<?= $this->displayTemplate('chunks/scripts'); ?>
<script src="<?=App::siteUrl('/assets/plugins/lightbox/js/lightbox.min.js')?>"></script>
</body>
</html>