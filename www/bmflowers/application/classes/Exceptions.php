<?php
/**
 * exceptions classes
 */

class FileNotFoundException extends Exception{
    protected $message = 'File not found: ';
    protected $code = 10;

    public function __construct($fname)
    {
        $mes = $this->message . $fname;
        parent::__construct($mes, $this->code);
    }
}

class ClassNotFoundException extends Exception{
    protected $message = 'Class not found: ';
    protected $code = 20;

    public function __construct($cname)
    {
        $mes = $this->message . $cname;
        parent::__construct($mes, $this->code);
    }
}

class DatabaseException extends Exception{
    protected $message = 'Database: ';
    protected $code = 30;

    public function __construct($dbmes)
    {
        $mes = $this->message . $dbmes;
        parent::__construct($mes, $this->code);
    }
}
