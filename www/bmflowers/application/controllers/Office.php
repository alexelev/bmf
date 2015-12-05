<?php
class OfficeController extends Controller{
    public static function actionDefault()
    {
//        echo 'officeController';
        return self::displayPage('office');
    }
}