<?php
    // Connection credentials
    require_once('connection.php');

    // Establish connection
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error) die($conn->connect_error);
    
    // Create customer table
    function createImageTable($conn) {
        $init = "
            DROP TABLE IF EXISTS imageInfo
        ";
        $query = "
        CREATE TABLE imageInfo (
            imageID int(11) NOT NULL AUTO_INCREMENT,
            imageName varchar(256),
            category varchar(256),
            imagePath varchar(256),
            resolution varchar(256),
            size varchar(256),
            photographer varchar(256),
            primary key ( imageID )
        );
        ";
        // echo $query;
        $initResult = $conn->query($init);
        $result = $conn->query($query);
        if (!$result) die ("Database access failed: " . $conn->error);
    }

    // Create customer table
    function createCustomerTable($conn) {
        $init = "
            DROP TABLE IF EXISTS customer
        ";
        $query = "
            CREATE TABLE customer (
            customerID int(11) NOT NULL AUTO_INCREMENT,
            username varchar(256),
            password varchar(256), 
            firstName varchar(256),
            lastName varchar(256),
            userType varchar(128),
            primary key ( customerID )
            );
        ";
        // echo $query;
        $initResult = $conn->query($init);
        $result = $conn->query($query);
        if (!$result) die ("Database access failed: " . $conn->error);
    }

    // Create transaction table
    function createTransactionTable($conn) {
        $init = "
            DROP TABLE IF EXISTS transaction
        ";
        $query = "
        CREATE TABLE transaction (
            transactionID int(11) NOT NULL AUTO_INCREMENT,
            username varchar(126),
            imageID int(11),
            ts TIMESTAMP,
            primary key ( transactionID )
        );
        ";
        // echo $query;
        $initResult = $conn->query($init);
        $result = $conn->query($query);
        if (!$result) die ("Database access failed: " . $conn->error);
    }

    createCustomerTable($conn);
    createTransactionTable($conn);
    // createImageTable($conn);

?>