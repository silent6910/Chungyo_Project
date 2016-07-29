<?php
    class databaseuse
    {
        protected $DB;
        private $url="localhost",
                $account="root",
                $password="asd456",
                $database="project";
        function __construct()
        {
            $this->DB = new PDO("mysql:host=".$this->url.';'."dbname=".$this->database,
                        $this->account,$this->password) or die("連不上server");
            $this->DB->exec("set names utf8");
        }
        function __get($name)
        {
            return $this->$name;
        }
        function close_db()
        {
            $this->DB=null;
        }
        function __destruct()
        {
            $this->DB=null;
        }
    }
?>