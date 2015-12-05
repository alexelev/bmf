<?php

class GalleryController extends Controller {
    public static function actionDefault() {
        if (empty($_GET)){
//            echo '<pre>'; var_dump($_GET); echo '</pre>'; die();
            $dirs = scandir(IMG_DIR);
            //убираем папки "." и ".."
            array_splice($dirs, 0, 2);
            self::templateVar('galleries', $dirs);
//            echo '<pre>'; var_dump($dirs); echo '</pre>'; die();
        } else {
            $gallery = $_GET['gallery'];

            $images = scandir(IMG_DIR . "/$gallery");
            array_shift($images);
            array_shift($images);

//        $collection = new Collection('Plant');
//        $collection->link('description');
//        $collection->where("`description->main_pic` IN ('" . implode("', '", $images) . "')");
//
//        self::templateVar('plants', $collection->items());
            self::templateVar('plants', $images);
        }

        return self::displayPage('gallery');
    }
}