<?php 

include_once('database.php');
include_once('functions.php');

class Question {
    public $no_questions;
    public $question;
    private $question_id;
    public $survey_id;
    public $author_code;

    public function __construct(){
        $this->no_questions = 0;
    }

    public function create(){
        $database = new MySQLDatabase();

        $this->get_params();

        $result = $database->query("INSERT INTO `questions` 
        ( question,  
        survey_id, 
        created_at, updated_at ) 
        VALUES ( '{$this->question}', 
        {$this->survey_id} ,
         NOW(), NOW() )");

        //Check if INSERT was successful
        if($result && $database->affected_rows() >= 0){
            redirectTo('index.php');
        }else{
            echo 'Create failed.<a href="index.php">Go to dashboard</a>';
        }
    }

    public function edit($id){
        $database = new MySQLDatabase();

        $this->get_params();

        $this->question_id = $database->escape_value( $id );

        $result = $database->query("UPDATE `questions` 
        SET question = '{$this->question}', 
    updated_at = NOW() WHERE id = {$this->question_id}");

        //Check if INSERT was successful
        if($result && $database->affected_rows() >= 0){
            redirectTo('index.php');
        }else{
            echo 'Edit failed.<a href="index.php">Go to dashboard</a>';
        }
    }

    public function delete($id){
        //Create a database connection object
        $database = new MySQLDatabase();

        $this->question_id = $database->escape_value($id);

        //Remove survey from database
        $result = $database->query("DELETE from `questions` WHERE id = {$this->question_id}");
        
        if( $result && $database->affected_rows() == 1 ){
            redirectTo('index.php');
        }else{
            echo 'Delete failed';
        }
    }

    public function get_params(){
        //Create a database connection object
        $database = new MySQLDatabase();

        //Extract the parameters from field into class.
        $this->question = $database->escape_value( $_POST['question'] );
        $this->survey_id = (int) $database->escape_value( $_POST['survey_id'] );
        /* $this->no_questions = $database->escape_value( $_POST['no_questions'] ); */
    }

    public function read_all(){
        $database = new MySQLDatabase();
        $results = $database->query("SELECT * from `questions`");
        return $results;
    }

    public function find($id){
        //Create a database connection object
        $database = new MySQLDatabase();
        return $database->query("SELECT * from `questions` WHERE id={$id}");    
    }
    

}

?>