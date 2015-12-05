<?php
class AdminController extends Controller{
    public static function ActionDefault()
    {
//        echo '!----------Hye! It\'s AdminControl page<br>'; /*die();*/
        if(!empty($_POST)){
//            echo '<pre>'; var_dump($_POST); echo '</pre>'; echo md5('1'); die();
            $pass = DB::getValue('select `password` from `admins` where `login` = ?',
                        array(array($_POST['login'], DataType::STR)));
            if($pass == $_POST['pswd']){
                $office = new OfficeController();
                return $office::run();
            }
        } else
            return self::displayPage('alogin_form');
    }
}