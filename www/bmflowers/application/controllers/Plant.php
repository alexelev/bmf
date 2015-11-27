<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 23.11.2015
 * Time: 6:44
 */
class PlantController extends Controller{
    protected static function actionDefault()
    {
        $plant = new PlantModel($_GET['id']);
        self::templateVar('plant', $plant);
        return self::displayPage('plant');
    }
}