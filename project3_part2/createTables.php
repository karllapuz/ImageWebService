<?php
    // Connection credentials
    require_once('connection.php');

    // Establish connection
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error) die($conn->connect_error);
    
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
            customerID int(11),
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
    createTransactionTable($conn)

?>