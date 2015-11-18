<?php
/**
 * DB class contains methods for working with database
 */

//TODO: переработать для корректной работы с PDO!!!!1 изменить все fetchAll() на fetch(), переделать функцию для работы с хранимыми процедурами!!1
class DB{
    private static $pdo = null;

    /**
     * open connect to database
     * @param string $host dbhost
     * @param string $login database user's login
     * @param string $pass database user's password
     * @param string $name database's name
     * @param string $charset database's charset
     * @throws DatabaseException if it has connection error
     */
    public static function connect($host, $login, $pass, $name, $charset){
        $dsn = "mysql:host=$host;dbname=$name";
        try{
            self::$pdo = new PDO($dsn, $login, $pass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset",
            ));

        } catch (PDOException $e) {
            throw new DatabaseException("Connection error");
        }

    }

    /**
     * execute custom query
     * @param string $query the sql-query string parameters with shielded
     * @param array $params the parameters for the sql-query string an array of arrays, each of which represents the
     * value of the passed parameter and its type (DataType::INT, DataType::STR, DataType::BOOL, DataType::INOUT) in a
     * sequence specific request
     * @return array
     */
    public static function query($query, $params=array()){
        $array = array();
        if(count($params) == 0){
            $data = self::$pdo->query($query, PDO::FETCH_ASSOC);
            foreach ($data as $dataitem) {
                $array[] = $dataitem;
            }
        } else {
            $st = self::$pdo->prepare($query);
            foreach ($params as $index => $param) {
                $st->bindValue($index + 1, $param[0], $param[1]);
            }
            $st->execute();
            while (($row = $st->fetch(PDO::FETCH_ASSOC))) {
                $array[] = $row;
            }
            $st->closeCursor();
        }
        return $array;
    }

    /**
     * Executing a SELECT query and returns the first column of the first row
     * It is used when you need to execute SELECT query to a single value
     * @param string $query the sql-query string parameters with shielded
     * @param array $params the parameters for the sql-query string an array of arrays, each of which represents the
     * value of the passed parameter and its type (DataType::INT, DataType::STR, DataType::BOOL, DataType::INOUT) in a
     * sequence specific request
     * @return mixed
     */
    public static function getValue($query, $params=array()){
        $st = self::$pdo->prepare($query);
        foreach ($params as $index => $param) {
            $st->bindValue($index + 1, $param[0], $param[1]);
        }
        $st->execute();
        if(($value = $st->fetchColumn()) !== false){
            $st->closeCursor();
            return (float) $value;
        } else {
            $st->closeCursor();
            return null;
        }
    }

    /**
     * Executing a SELECT query and returns the first row as an associative array
     * It is used when you need to execute SELECT query to get one line
     * @param string $query the sql-query string parameters with shielded
     * @param array $params the parameters for the sql-query string an array of arrays, each of which represents the
     * value of the passed parameter and its type (DataType::INT, DataType::STR, DataType::BOOL, DataType::INOUT) in a
     * sequence specific request
     * @return null or mixed
     */
    public static function getRow($query, $params=array()){
        $st = self::$pdo->prepare($query);
        foreach ($params as $index => $param) {
            $st->bindValue($index + 1, $param[0], $param[1]);
        }
        $st->execute();
        if(($row = $st->fetch(PDO::FETCH_ASSOC)) !== false){
            $st->closeCursor();
            return $row;
        } else {
            $st->closeCursor();
            return null;
        }
    }

    /**
     * Executing a SELECT query and returns all the rows in an array
     * @param string $query the sql-query string parameters with shielded
     * @param array $params the parameters for the sql-query string an array of arrays, each of which represents the
     * value of the passed parameter and its type (DataType::INT, DataType::STR, DataType::BOOL, DataType::INOUT) in a
     * sequence specific request
     * @param null $index by default or set by you
     * @return array
     */
    public static function getTable($query, $params=array(), $index = null){
        $array = array();
        $st = self::$pdo->prepare($query);
        foreach ($params as $index => $param) {
            $st->bindValue($index + 1, $param[0], $param[1]);
        }
        $st->execute();
        while($row = $st->fetch(PDO::FETCH_ASSOC)){
            if($index){
                $array[$row[$index]] = $row;
            } else {
                $array[] = $row;
            }
        }
        $st->closeCursor();
        return $array;
    }

    /**
     *Return automatically generated database id after INSERT query
     * @return int id
     */
    public static function getInsertedId(){
        return self::$pdo->lastInsertId();
    }

    /**execute a call to a stored procedure
     * @param string $query the sql-query string parameters with shielded
     * @param array $params the parameters for the sql-query string an array of arrays, each of which represents the
     * value of the passed parameter and its type (DataType::INT, DataType::STR, DataType::BOOL, DataType::INOUT) in a
     * sequence specific request
     * @return array
     */
    public static function exStoredProc($query, $params=array()){
        return self::query($query, $params);
    }
}

/**
 * Class DataType contains constants of data types for database
 */
class DataType
{
    const INT = PDO::PARAM_INT;
    const STR = PDO::PARAM_STR;
    const BOOL = PDO::PARAM_BOOL;
    const INOUT = PDO::PARAM_INPUT_OUTPUT;
}

/**
 * Class LinkType contains constants of types of relationships between tables
 */
class LinkType{
    const PRIMARY_KEY = 1;
    const FOREIGN_KEY = 2;
    const TABLE = 3;
}