<?php 

include_once('database.php');
include_once('functions.php');

class Answer {
    public $answer;
    private $answer_id;
    private $question_id;
    private $subscriber_id;

    public function __construct(){
        $this->answer= "";
    }

    public function create(){
        $database = new MySQLDatabase();

        $this->get_params();

        $result = $database->query("INSERT INTO `answers` 
        ( answer,  
        question_id, 
        subscriber_id,
        created_at, updated_at ) 
        VALUES ( '{$this->answer}', 
        {$this->question_id},
        {$this->subscriber_id} ,
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

        $this->answer_id = $database->escape_value( $id );

        $result = $database->query("UPDATE `answers` 
        SET answer = '{$this->answer}', 
        updated_at = NOW() WHERE id = {$this->answer_id}");

        //Check if INSERT was successful
        if($result && $database->affected_rows() >= 0){
            redirectTo('index.php');
        }else{
            echo 'Edit answer failed.<a href="index.php">Go to dashboard</a>';
        }
    }

    public function delete($id){
        //Create a database connection object
        $database = new MySQLDatabase();

        $this->answer_id = $database->escape_value($id);

        //Remove survey from database
        $result = $database->query("DELETE from `answers` WHERE id = {$this->answer_id}");
        
        if( $result && $database->affected_rows() == 1 ){
            redirectTo('index.php');
        }else{
            echo 'Delete answer failed';
        }
    }

    public function get_params(){
        //Create a database connection object
        $database = new MySQLDatabase();

        //Extract the parameters from field into class.
        $this->answer= $database->escape_value( $_POST['answer'] );
        $this->question_id = (int) $database->escape_value( $_POST['question_id'] );
        $this->subscriber_id = (int) $database->escape_value( $_POST['subscriber_id'] );
    }

    public function read_all(){
        $database = new MySQLDatabase();
        $results = $database->query("SELECT * from `answers`");
        return $results;
    }

    public function find($id){
        //Create a database connection object
        $database = new MySQLDatabase();
        return $database->query("SELECT * from `answers` WHERE id={$id}");    
    }
    

}

?>