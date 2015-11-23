<?php
/**
 * Created by PhpStorm.
 * User: A
 * Date: 23.11.2015
 * Time: 6:51
 */
class SpecieModel extends Model{
    const TABLE = 'flr_species';
    protected static $fields = array('name', 'catalog_name');
    protected static $links = array(
        'plant' => array(
            'model' => 'Plant',
            'type' => LinkType::PRIMARY_KEY,
            'field' => 'id_specie'
        )
    );
}