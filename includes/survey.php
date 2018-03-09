<?php
include_once('database.php');
include_once('functions.php');

class Survey {
    public $survey_id;
    public $survey_name;
    public $no_questions;
    public $survey_category;

    public function __construct() {
        $this->no_questions = 0;
        $this->survey_category = 0;
    }

    public function create() {
        //Create a database connection object
        $database = new MySQLDatabase();

        //Get Parameters from HTML field 
        $this->get_params();

        //Insert them into them database
        $result = $database->query("INSERT INTO `surveys` (name, category_id, created_at ) 
        VALUES ( '{$this->survey_name}', '{$this->survey_category}', NOW() )");
        
        //Check if INSERT was successful
        if( $result && $database->affected_rows() >= 0 ){
            echo 'Created survey';
        }
        else{
            echo 'Create failed';
        }

        //redirect them to add questions.
    }

    public function read_all() {
        $results = $database->query("SELECT * from `surveys`");

        print_r($results);
    }

    public function edit() {
        //Create a database connection object
        $database = new MySQLDatabase();

        //Get Parameters from HTML field 
        $this->get_params();

        //Insert them into them database
        $result = $database->query("UPDATE `surveys` SET name =  $this->survey_name
        ,category_id = $this->survey_category WHERE id = $this->survey_id LIMIT 1");
        
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

    public function delete() {
        //Create a database connection object
        $database = new MySQLDatabase();

        //Remove survey from database
        $result = $database->query("DELETE from `surveys` WHERE id = $this->survey_id");
        
        if( $result && $database->affected_rows() == 1 ){
            echo 'Deleted survey';
        }else{
            echo 'Delete failed';
        }
    }

    public function get_params() {
        //Create a database connection object
        $database = new MySQLDatabase();

        //Extract the parameters from field into class.
        $this->survey_name = $database->escape_value( $_POST['survey_name'] );
        $this->no_questions = $database->escape_value( $_POST['no_questions'] );
        $this->survey_category = $database->escape_value( $_POST['survey_category'] );
    }

}
?>