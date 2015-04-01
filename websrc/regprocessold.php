<?php

//echo "First Name:" . $_GET['fname'];
//echo "\n <br/> Last Name: " . $_GET['lname'];
//echo "\n <br/> Email: " . $_GET['emailadd'];
//echo "\n <br/> Agency: " . $_GET['agency'];
//echo "\n <br/> Pricing $" . $_GET['pricing'];
//echo "\n <br/> Date: " . date("Ymd");


$seedData = array(
    array(
        'fname' => $_GET['fname'], 
        'lname' => $_GET['lname'],
        'email' => $_GET['emailadd'],
        'agency' => $_GET['agency'],
        'pricing' => $_GET['pricing'],
        'regdate' => date("Ymd")
    ),
);

$uri = "mongodb://dfadmin:dfadminpass@ds053130.mongolab.com:53130/docforcemaindb";
$options = array("connectTimeoutMS" => 10000);

$client = new MongoClient($uri, $options );
$db = $client->selectDB("docforcemaindb");

$users = $db->Users;
$users->batchInsert($seedData);

$client->close();
//echo"!!!"

//redirect to thanks page

?>