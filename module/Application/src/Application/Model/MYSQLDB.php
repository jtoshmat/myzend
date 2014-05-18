<?php
/**
 * Created by PhpStorm.
 * User: toshmatovus
 * Date: 5/17/14
 * Time: 11:18 PM
 */
namespace Application\Model;
use Zend\View\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo\Pdo;
class MYSQLDB{
    public function setConn(){
        $db = array('driver'=>'Pdo','dsn'=>'mysql','host'=>'127.0.0.1','username'=>'hhtoshma_wp','password'=>'navbahor1976','dbname'=>'toshmatovus');
        return new Adapter(array('driver' => ''.$db['driver'].'', 'dsn' => ''.$db['dsn'].':dbname='.$db['dbname'].';host='.$db['host'].'',  'username' => ''.$db['username'].'','password' => ''.$db['password'].''));
    }

}