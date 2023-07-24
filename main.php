<?php

require "mongo.model.php";

class MainClass
{
    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest($_POST);
        } else {
            $this->handleNonPostRequest();
        }
    }

    private function handlePostRequest(array $data)
    {
        // Handle the POST request here
        // For example, you can process form data or perform database operations
        $username = "savioalwd";
        $password = "oalxb1IS0N7nhYfR";
        $clusterName = "cluster0";
        $database = "hbxor4w"; // the database name you want to access / create
        $collectionName = "registration"; // the collection name
        $result = NULL;
        if (isset($data['action']) && $data['action'] == 1) {
            //call register model class.
            $MongoModelobj = new MongoDBHandler($username, $password, $clusterName, $database, $collectionName);
            $payload = [
                "FirstName" => $data['userFirstName'],
                "LastName" => $data['userLastName'],
                "Email" => $data['userEmail'],
                "Pass" => md5($data['pass1']),
            ];
          
            if ($MongoModelobj->testConnection()) {
                $result = $MongoModelobj->insertUserDetails($payload);
                print_r($result);
            } else {
                $result = ['status' => 0];
            }
        } else {
            // Respond to the client indicating missing parameters or any other errors
            $result =  "Invalid POST request!";
        }
        // echo json_encode($result);
    }

    private function handleNonPostRequest()
    {
        // Handle other types of requests (e.g., GET, PUT, DELETE, etc.) here
        // Respond to the client accordingly
        echo "This is not a POST request!";
    }
}

// Create an instance of the MainClass
$mainClass = new MainClass();
