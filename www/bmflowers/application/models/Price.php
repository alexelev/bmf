<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 23.11.2015
 * Time: 6:55
 */
class PriceModel extends Model{
    const TABLE = 'flr_price';
    protected static $fields = array('id_plant', 'RUB', 'UAH', 'USD');
    protected static $links = array(
        'plant' => array(
            'model' => 'Plant',
            'type' => LinkType::FOREIGN_KEY,
            'field' => 'id_plant'
        )
    );
}