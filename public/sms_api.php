<?php
// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');
require_once('includes/database.php');

require_once('includes/subscriber.php');

/* 
$subscriber = new Subscriber();
$res = $subscriber->find(1);
$sub = $database->fetch_array($res); */

// Specify your authentication credentials
$username   = "sandbox";
$apikey     = "dbdac6d31596aeb2a64720143b4cf6c0b2268395708586715737836c031162bd";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = "+233267046022";

// And of course we want our recipients to know what we really do
$message    = "Welcome to XSurveys. We will start sending you surveys and pay you through this number.";

// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey, 'sandbox');

/*************************************************************************************
  NOTE: If connecting to the sandbox:
  1. Use "sandbox" as the username
  2. Use the apiKey generated from your sandbox application
     https://account.africastalking.com/apps/sandbox/settings/key
  3. Add the "sandbox" flag to the constructor
  $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
**************************************************************************************/

// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}

catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}
// DONE!!! 