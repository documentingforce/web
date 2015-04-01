<?php
/*
 * Copyright (c) 2014 ObjectLabs Corporation
 * Distributed under the MIT license - http://opensource.org/licenses/MIT
 *
 * Written with extension mongo 1.5.2
 * Documentation: http://php.net/mongo
 * A PHP script connecting to a MongoDB database given a MongoDB Connection URI.
 */
// Create seed data
$seedData = array(
    array(
        'fname' => 'Julie', 
        'lname' => 'Stevens',
        'email' => 'j@s.com', 
        'regdate' => '25122014'
    ),
);
/*
 * Standard single-node URI format: 
 * mongodb://[username:password@]host:port/[database]
 */
$uri = "mongodb://dfadmin:dfadminpass@ds053130.mongolab.com:53130/docforcemaindb";
$options = array("connectTimeoutMS" => 10000);
/*
 * Include the replica set name as an option for a multi-node replica set connection:
 *   $uri = "mongodb://myuser:mypass@host1:port1,host2:port:2/mydb";
 *   $options = array("replicaSet" => "myReplicaSet", "connectTimeoutMS" => 30000);
 */
$client = new MongoClient($uri, $options );
$db = $client->selectDB("docforcemaindb");
/*
 * First we'll add a few songs. Nothing is required to create the songs
 * collection; it is created automatically when we insert.
 */
$users = $db->Users;
// To insert a dict, use the insert method.
$users->batchInsert($seedData);
/*
 * Then we need to give Boyz II Men credit for their contribution to
 * the hit "One Sweet Day".

$users->update(
    array('fname' => 'Raven'), 
    array('$set' => array('email' => 'rae@s.com'))
);
*/    
/*
 * Finally we run a query which returns all the hits that spent 10 
 * or more weeks at number 1. 

*/
$cursor = $users->find();
foreach($cursor as $doc) {
    echo "F:(" .$doc['fname'];
    echo ")\n <br/> L:(" .$doc['lname']; 
    echo ")\n <br/> E:(" .$doc['email'];
    echo ")\n <br/> D:(" .$doc['regdate']; 
    echo ")\n <br/>\n<br/>";
    
}
// Since this is an example, we'll clean up after ourselves.
//$songs->drop();
// Only close the connection when your app is terminating
$client->close();
echo "done";
?>



