<?php
include_once('../includes/survey.php');

function redirectTo( $url ){
	header('Location: '.$url);
	exit;
}

?>
