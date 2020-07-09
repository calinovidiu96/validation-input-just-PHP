<?php

include('database.php');

class User extends Database{
    protected static $db_table = "users";
    protected static $db_table_fields = array('name', 'mobile_number', 'promotional_code', 'GDPR', 'terms');
    public $id;
    public $name;
    public $mobile_number;
    public $promotional_code;
    public $GDPR;  
    public $terms;


    public function properties() {
        $properties = array();

        foreach (static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties(){
        global $database;
        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
   }



    public function create() {
        global $database;

        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) ."')";

        if($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

}
?>