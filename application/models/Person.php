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
    
    /**
     * Construct
     */
    public function __construct() 
    {
        $dbAdapter = Zend_Registry::getInstance()->dbAdapter;
        $dbAdapter->setFetchMode(Zend_Db::FETCH_OBJ);
        $this->dbAdapter = $dbAdapter;
    }
    /**
     * Method for setting values
     * @param type $name
     * @param type $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    
    /**
     * Method return object attribute
     * @param type $name
     * @return type
     */
    public function __get($name)
    {
        return $this->$name;
    }
    
    /**
     * Return all persons in person table
     * @return type
     */
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
    
    /**
     * Insert new Person in table
     * @param type $data
     */
    public function insert($data)
    {
        $this->dbAdapter->insert('person', $data);
    }
    
    /**
     * Delete persons
     * @param type $data - array()
     */
    public function delete($data = array())
    {
        foreach ($data as $value) {
            $this->dbAdapter->delete('person', "id = $value");
        }
    }
}
?>
