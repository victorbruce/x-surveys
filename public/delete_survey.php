<?php 

include_once('../includes/survey.php');

$survey = new Survey();

if( !isset($_GET['id']) ){
    echo 'set id of survey to delete.';
    exit;
}

$survey->delete( $_GET['id']);

?>