<?php
require __DIR__ . "/vendor/autoload.php";

// use MongoDB\Client;
// use MongoDB\Driver\ServerApi;


// $uri = "mongodb+srv://admin:GK7MfkN6vov0YoQm@cluster0.hbxor4w.mongodb.net/?retryWrites=true&w=majority";

// // Specify Stable API version 1
// $apiVersion = new ServerApi(ServerApi::V1);

// // Create a new client and connect to the server
// $client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);

// try {
//     // Send a ping to confirm a successful connection
//     $client->selectDatabase('admin')->command(['ping' => 1]);
//     echo "Pinged your deployment. You successfully connected to MongoDB!\n";
// } catch (Exception $e) {
//     printf($e->getMessage());
// }
// Example usage:
// $username = "admin";
// $password = "GK7MfkN6vov0YoQm";
// $clusterName = "cluster0";
// $database = "hbxor4w";


use MongoDB\Client;
use MongoDB\Driver\ServerApi;

class MongoDBHandler
{
    private $client;
    private $database;
    private $collection;

    public function __construct($username, $password, $clusterName, $database, $collectionName)
    {
        $uri = "mongodb+srv://" . $username . ":" . $password . "@" . $clusterName."." . $database . ".mongodb.net/?retryWrites=true&w=majority";

        // Specify Stable API version 1
        $apiVersion = new ServerApi(ServerApi::V1);

        // Create a new client and connect to the server
        $this->client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);
        $this->database = $this->client->$database;
        $this->collection = $this->database->$collectionName;
    }

    public function testConnection()
    {
        try {
            // Send a ping to confirm a successful connection
            $this->client->selectDatabase('admin')->command(['ping' => 1]);
            echo "Pinged your deployment. You successfully connected to MongoDB!\n";
        } catch (Exception $e) {
            printf($e->getMessage());
        }
    }

    public function insertUserDetails($userDetails)
    {
       print_r( $this->collection->insertOne($userDetails));
    }
}


