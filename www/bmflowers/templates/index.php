<!doctype html>
<html lang="ru">
    <head>
        <?= $this->displayTemplate('chunks/meta'); ?>
        <link rel="stylesheet" href="<?=App::siteUrl('assets/plugins/owl.carousel/owl.carousel.css'); ?>">
        <link rel="stylesheet" href="<?=App::siteUrl('assets/plugins/owl.carousel/owl.theme.css'); ?>">
        <link rel="stylesheet" href="<?=App::siteUrl('assets/plugins/owl.carousel/owl.transitions.css'); ?>">
    </head>

    <body>
        <div class="gallery clear">
            <div class="customNavigation">
                <a class="btn prev"><img src="assets/img/leftb.png"></a>
            </div>
            <div class="owl-wrap">
                <div id="owl" class="owl-carousel">
                    <?php foreach ($this->slides as $slide) { ?>
                        <div class="item">
                            <a href="?controller=gallery&gallery=<?=$slide['dir']?>">
                                <img src="<?= App::siteUrl("gallery/{$slide['dir']}/{$slide['img']}"); ?>" alt="" title="<?=$slide['dir']?>">
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="customNavigation">
                <a class="btn next"><img src="assets/img/rightb.png"></a>
            </div>
        </div>

        <div class="wrap">
            <header></header>
            <!--<div class="logo"></div>-->
            <a href="#" class="logo"></a>
            <nav>
                <ul>
                    <li>новости</li>
                    <li>статьи</li>
                    <li>каталоги</li>
                    <li>заказ</li>
                    <li>отзывы</li>
                </ul>
            </nav>

            <div class="content">
                Любовь к растениям привела Вас на сайт, призвание которого нести прекрасное в Ваши дома! Здесь Вы сможете найти растения, которые будут радовать Вас своим великолепием в любое время года!
            </div>
            <footer></footer>
        </div>


        <?= $this->displayTemplate('chunks/scripts'); ?>
        <script src="<?= App::siteUrl('assets/plugins/owl.carousel/owl.carousel.min.js'); ?>"></script>
        <script>
            $('#owl').owlCarousel({
                loop: true,
                center: true,
                margin: 30,
                nav: false,
                pagination: false,
            });
            $(".prev").click(function(){
                $('#owl').trigger('owl.prev');
            });
            $(".next").click(function(){
                $('#owl').trigger('owl.next');
            });
        </script>
    </body>
</html>