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
     $response .= "3 Start a new survey \n";

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
  $response = "END You have been unsubscribed.";
 }

else if($text == "3") {
    $response = "CON Which category do you prefer to be queried on? \n";
    
    $category = new Category();
    $categories = $category->read_all();

    foreach($categories as $single ){
        $single_id = $single['id']; 
        $single_name = $single['name'];

        $response .= "{$single_id} {$single_name}";
    }

}

else if ( strlen(end((explode('*', $text)))) === 1  ){
    $category = new Category();
    $found_category = $category->find($text)['name'];

    $response = "CON You chose {$found_category}. \n Please enter your mobile money number:";
}

else if ( strlen(end((explode('*', $text)))) > 1 ){
    $number = end((explode('*', $text)));

    //Register the collected Mobile Money number.
    $subscriber = new Subscriber();
    $subscriber->edit();

    $response = "END Hurray! \nMoney earned will be paid to {$number}";
}

else {
    $response = "END Your survey will start after this.";
}



// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
// DONE!!!
?>