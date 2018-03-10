<?php
include_once('../includes/database.php');
include_once('../includes/survey.php');
include_once('../includes/category.php');
include_once('../includes/subscriber.php');

// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];


if ( $text == "" ) {
     // This is the first request. Note how we start the response with CON
     $response  = "CON Welcome to XSurveys! \n";
     $response .= "1 Subscribe to service \n";
     $response .= "2 Unsubscribe from service \n";
}

else if ( $text == "1" ) {
  //We will subscribe the user here by taking number.
  
  $subscriber = new Subscriber();
  if ( $subscriber->create() ){
    $response = "CON You have been successfully subscribed! Do you want to start your first survey? \n Reply 1 for YES and 2 for NO";
 } else {
     $response = "END Subscription failed. Please check back again.";
 }

  //Start survey service using SMS API
 }

 else if($text == "1*1") {
    $response = "END Your survey will start after this.";
   }
      
else if ( $text == "1*2" ) {
       $response = "END Have a nice day.";
  }

else if($text == "2") {
    $database = new MySQLDatabase();
    $res = $database->query("SELECT * from `subscriber` WHERE phone_number={$phoneNumber}");
    $sub = $database->fetch_array($res);

    $subscriber = new Subscriber();

    if( $subscriber->delete($sub['id']) ){
        $response = "END You have been unsubscribed.";
    }else{
        $response = "END Unsubscription unsuccessful.";
    }
  
 }

else {

    $response = "END Hurray! \nMoney earned will be paid to {$phoneNumber}";
}




// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
// DONE!!!
?>