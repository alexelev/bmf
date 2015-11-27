<?php

class GalleryController extends Controller {
    public static function actionDefault() {
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
        return self::displayPage('gallery');
    }
}