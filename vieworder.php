<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Include global header
include 'includes/globalheader.php';

require_once 'classes/Database.php'; // Include the database

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

$errorString = ''; // Contain error string

// Check if id get received
if (isset($_GET['id']))
{
    // Get order id from get request
    $orderID = mysqli_real_escape_string($dataConnection, $_GET['id']);
}
else
{
    $errorString = "Order must be specified...";
}

// If member is not signed in redirect to sign in page
if ($_SESSION["currentCustomer"]->getIsInitialized() !== true)
{
    header('Location: members.php');
}

// Check if order exists

// Query for the specified order
$orderQuery = "SELECT * FROM PRODUCTS_BY_ORDER_VIEW WHERE SalesOrderFK ='".$orderID."' AND CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."';";

// Execute query
$orderQueryResult = $dataConnection->query($orderQuery);

// Check if query failed
if ($orderQueryResult === false)
{
    $errorString = "Query Failed....";
}

// Check if result returned
if ($orderQueryResult->num_rows < 0)
{
    // Set order flag on (order exists)
    $errorString = "Order not found...";
}
?>