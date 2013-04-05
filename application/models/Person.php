<?php
/**
* Person Model
*
* LICENSE: Commercial
* 
* @package CORE
* @copyright Ivan Dudas
* @license http://www.example.com/license
* @version  1.0.0
* @link  http://www.example.com
* @since 2013
*/



/**
* Person Model.
*
* LICENSE: Commercial
* 
* @package CORE
* @copyright Ivan Dudas
* @license http://www.example.com/license
* @version  1.0.0
* @link  http://www.example.com
* @since 2013
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
