<?php
class AdminModel extends Model{
    const TABLE = "admins";
    protected static $fields = array('login', 'password');
    protected static $links = array();
}