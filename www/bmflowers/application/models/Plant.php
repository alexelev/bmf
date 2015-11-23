<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 23.11.2015
 * Time: 6:44
 */
class PlantModel extends Model{
    const TABLE = "flr_plants";
    protected static $fields = array('id_specie', 'title', 'category_name', 'conditional_name', 'hyb_category_name', 'isHybrid');

    protected static $links = array(
        'specie' => array(
            'model' => 'Specie',
            'type' => LinkType::FOREIGN_KEY,
            'field' => 'id_specie'
        ),
        'price' => array(
            'model' => 'Price',
            'type' => LinkType::PRIMARY_KEY,
            'field' => 'id_plant'
        )
    );
}