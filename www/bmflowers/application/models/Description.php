<?php

class DescriptionModel extends Model {
    const TABLE = 'flr_description';

    protected static $fields = array('id_plant', 'isNew', 'description', 'sales_terms', 'main_pic', 'other_pic', 'presence');

    protected static $links = array(
        'plant' => array(
            'model' => 'Plant',
            'type' => LinkType::FOREIGN_KEY,
            'field' => 'id_plant'
        )
    );
}