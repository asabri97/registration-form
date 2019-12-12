<?php
require_once("sendgrid/vendor/autoload.php");
require_once('credentials.php');


$email = new \SendGrid\Mail\Mail();
$email->setFrom("em7756@hotmail.com", "Abrish Sabri");
$email->setSubject("Registration Confirmation");
$email->addTo("abrishsabri@hotmail.com", $name);
$email->addContent("text/plain", "Here is your confirmation email");

$sendgrid = new \SendGrid(getenv($SENDGRID_API_KEY));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>