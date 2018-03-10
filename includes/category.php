<?php 
include_once('database.php');
include_once('functions.php');

class Category {
    public $category_id;
    public $category_name;

    public function create() {
        //Create a database connection object
        $database = new MySQLDatabase();

        //Get Parameters from HTML field 
        $this->get_params();

        //Insert them into them database
        $result = $database->query("INSERT INTO `categories` ( name, created_at, updated_at ) 
        VALUES ( '{$this->category_name}', NOW(), NOW() )");
        
        //Check if INSERT was successful
        if( $result && $database->affected_rows() >= 0 ){
            echo 'Created category';
        }
        else{
            echo 'Create failed';
        }

        //redirect them to dashboard.
    }

    public function edit($id){
         //Create a database connection object
         $database = new MySQLDatabase();

         //escape and attach survey id
         $this->category_id = $database->escape_value( $id );
 
         //Get Parameters from HTML field 
         $this->get_params();
 
         //Insert them into them database
         $result = $database->query("UPDATE `categories` SET name =  '{$this->category_name}' WHERE id = {$this->survey_id} LIMIT 1");
         
         //Check if INSERT was successful
         if( $result && $database->affected_rows() >= 0 ){
             echo 'Updated survey';
         }
         else{
             echo 'Update failed';
         }
 
         //redirect them to dashboard. We'll implement later
         //redirectTo('dashboard.php');
    }

    public function read_all(){
         //Create a database connection object
         $database = new MySQLDatabase();
        
         $results = $database->query("SELECT * from `categories`");
 
         return $results;
    }

    public function delete( $id ){
        //Create a database connection object
        $database = new MySQLDatabase();

        $this->category_id = $database->escape_value($id);

        //Remove survey from database
        $result = $database->query("DELETE from `categories` WHERE id = {$this->category_id}");
        
        if( $result && $database->affected_rows() == 1 ){
            echo 'Deleted category';
        }else{
            echo 'Delete failed';
        }
    }

    public function get_params() {
        //Create a database connection object
        $database = new MySQLDatabase();

        //Extract the parameters from field into class.
        $this->category_name = $database->escape_value( $_POST['category_name'] );
    }
}

?>