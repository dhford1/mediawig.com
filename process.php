<?php

function cleanUp($data) {
   $data = strip_tags($data);
   $data = trim(htmlentities($data));
   return $data;
}

  $name = cleanUp($_POST['name']);
  $email = cleanUp($_POST['email']);
  $memo = cleanUp($_POST['memo']) ;
  $org = cleanUp($_POST['org']);
  $hearabout = cleanUp($_POST['hearabout']);
  $site = cleanUp($_POST['site']);


if (!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,6})$",$email)) {
   
   header( "Location: http://www.mediawig.com?error=oops" );

   exit;
}

$email = preg_replace("([\r\n])", "", $email);

$find = "/(content-type|bcc:|cc:)/i";
if (preg_match($find, $name) || preg_match($find, $email) || preg_match($find, $memo) || preg_match($find, $org) || preg_match($find, $hearabout) || preg_match($find, $site)) {
   echo "<h1>Error</h1>\n
      <h1>No meta/header injections, Fuck Off please. ;-)</h1>";
   exit;
}
  
  
  $recipient = "dave@mediawig.com";
  $subject   = "An Email from the MediaWig Site!";
  
  $message   = "Name: $name \n";
  $message  .= "E-mail: $email \n";
  $message  .= "Organization: $org \n";
  $message  .= "How did you find me?: $hearabout \n";
  $message  .= "How hard was it to use?: $site \n \n";
  $message  .= "Message: $memo \n";
  

  $headers  = "From: website@mediawig.com\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "X-Mailer: PHP/".phpversion();
  
if (mail($recipient,$subject,$message,$headers)) {
    header( "Location: http://www.mediawig.com?thanks=true" );
} else {
   header( "Location: http://www.mediawig.com?error=true" );
}
  ?>