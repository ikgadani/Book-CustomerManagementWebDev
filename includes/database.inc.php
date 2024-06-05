<?php

/*
 Sets up the PDO database connection
*/

  //For EasyPHP Local Webserver 
  $connString = "mysql:host=localhost";
  $dbname = "bookcrm";
  $user = "bookrep"; 
  $password = "book@rep20";

  //You need to modify dbname and username($user) for SiteGround Web Server  
	 
  try {
    $pdo = new PDO("$connString;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }  



?>
