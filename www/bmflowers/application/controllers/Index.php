<?php

class IndexController extends Controller {
    public static function actionDefault() {
//        $collection = new Collection('specie');

        $img_dirs = scandir(ROOT_DIR . '/gallery');
        array_shift($img_dirs);
        array_shift($img_dirs);
        shuffle($img_dirs);

        $slides = array();
        foreach ($img_dirs as $dir) {
            $dir_images = scandir(ROOT_DIR . '/gallery/' . $dir);
//            echo $dir . ': ' . count($dir_images) . '<br>';
            $number = rand(2, count($dir_images) - 2);
            $slides[] = array(
                'img' => $dir_images[$number],
                'dir' => $dir
            );
        }

        self::templateVar('slides', $slides);

        return self::displayPage('index');
    }
}