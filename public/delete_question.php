<?php 

include_once('../includes/question.php');

$question = new Question();

if( !isset($_GET['id']) ){
    echo 'set id of question to delete.';
    exit;
}

$question->delete( $_GET['id']);

?>