<?php
/**
 * Created by PhpStorm.
 * User: toshmatovus
 * Date: 5/17/14
 * Time: 11:18 PM
 */

class DB{
    public $sql;
    protected $conn;

    public function setSQL($sql){
        $this->sql = $sql;
    }
    public function connect(){
        $db = array('driver'=>'Pdo','dsn'=>'mysql','host'=>'127.0.0.1','username'=>'hhtoshma_wp','password'=>'navbahor1976','dbname'=>'toshmatovus');
        $this->conn = new Adapter(array('driver' => ''.$db['driver'].'', 'dsn' => ''.$db['dsn'].':dbname='.$db['dbname'].';host='.$db['host'].'',  'username' => ''.$db['username'].'','password' => ''.$db['password'].'','persistent' =>true,));
    }

    public function query(){
        $results = $this->conn->query("SELECT * FROM newsletters LIMIT 1");
        return $results->execute()->next();
    }

}