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

// If member is not signed in redirect to sign in page
if ($_SESSION["currentCustomer"]->getIsInitialized() !== true)
{
    header('Location: members.php');
}

// Hold the error
$errorString = '';

// Check if id is set
if (isset($_GET['id']))
{
    // Sanitize the order id
    $orderId = mysqli_real_escape_string($dataConnection, $_GET['id']);
    
    // Check if order exists

    // Query for the specified order
    $orderQuery = "SELECT * FROM PRODUCTS_BY_ORDER_VIEW WHERE SalesOrderFK ='".$orderId."' AND CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."';";
    
    //echo $orderQuery; //debug
    
    // Execute query
    $orderQueryResult = $dataConnection->query($orderQuery);
    
    // Check if no errors
    if ($orderQueryResult !== false)
    {
        // Check if results returned
        if ($orderQueryResult->num_rows > 0)
        {
            
        }
        else
        {
            // Order not found error
            $errorString = "Order '".$orderId."' not found...";
        }
    }
    else
    {
        // Query error
        $errorString = "Query Error";
    }
}
else
{
    $errorString = 'ID must be specified';
}

// Display error
if ($errorString !== '')
{
    echo $errorString;
}
else
{
    echo 'no error';
}

?>