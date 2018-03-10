<?php 

include_once('database.php');
include_once('functions.php');

class Subscriber {
    private $mobile_money_number;
    private $phone_number;
    private $subscriber_id;

    public function __construct(){
        $this->subscriber_id = 0;
    }

    public function create(){
        $database = new MySQLDatabase();

        $this->get_params();

        $result = $database->query("INSERT INTO `subscribers` 
        ( phone_number,  
        mobile_money_number,
        created_at, updated_at ) 
        VALUES ( '{$this->phone_number}', 
        '{$this->mobile_money_number}',
         NOW(), NOW() )" );

        //Check if INSERT was successful
        if($result && $database->affected_rows() >= 0){
            return true;
        }else{
            return false;
        }
    }

    public function edit( $id ){
        $database = new MySQLDatabase();
 
        $this->get_params();

        $this->subscriber_id = $database->escape_value( $id );

        $result = $database->query("UPDATE `subscribers` 
        SET phone_number = '{$this->phone_number}', 
        mobile_money_number = '{$this->mobile_money_number}', 
        updated_at = NOW() WHERE id = {$this->subscriber_id}");

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

        $this->subscriber_id = $database->escape_value($id);

        //Remove survey from database
        $result = $database->query("DELETE from `subscribers` WHERE id = {$this->subscriber_id}");
        
        if( $result && $database->affected_rows() == 1 ){
            redirectTo('index.php');
        }else{
            echo 'Delete subscriber failed';
        }
    }

    public function get_params(){
        //Create a database connection object
        $database = new MySQLDatabase();

        //Extract the parameters from field into class.
        $this->phone_number = $database->escape_value( $_POST['phoneNumber'] );

        $this->mobile_money_number = isset($this->mobile_money_number ) ? 
             $database->escape_value( $_POST['mobile_money_number'] ) : $this->phone_number;

    }

    public function read_all(){
        $database = new MySQLDatabase();
        $results = $database->query("SELECT * from `subscribers`");
        return $results;
    }

    public function find($id){
        //Create a database connection object
        $database = new MySQLDatabase();
        $id = $database->escape_value($id);

        return $database->query("SELECT * from `subscribers` WHERE id={$id}");    
    }
    

}

?>