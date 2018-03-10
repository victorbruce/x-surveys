<?php 

include_once('../includes/question.php');

$question = new Question();

if( !isset($_GET['id']) ){
    echo 'set id of question to edit.';
    exit;
}

$question->edit( $_GET['id']);

?>