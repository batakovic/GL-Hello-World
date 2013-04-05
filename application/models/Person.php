<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Person
{
    private $name;
    private $phone;
    private $date;
    
    public function __construct() 
    {
        $dbAdapter = Zend_Registry::getInstance()->dbAdapter;
        $dbAdapter->setFetchMode(Zend_Db::FETCH_OBJ);
        $this->dbAdapter = $dbAdapter;
    }
    
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }
    
    public static function getAllPersons()
    {
        $dbAdapter = Zend_Registry::getInstance()->dbAdapter;
        $dbAdapter->setFetchMode(Zend_Db::FETCH_OBJ);
        try {
            $personList = $dbAdapter->fetchAll("SELECT * from person");
            return $personList;
        } catch (Exception $e) {
            return array('stats' => false, 'msg' => $e->getMessage());
        }
       
    }
    
    public function insert($data)
    {
        $this->dbAdapter->insert('person', $data);
    }
    
    public function delete($data = array())
    {
        foreach ($data as $value) {
            $this->dbAdapter->delete('person', "id = $value");
        }
    }
}
?>
