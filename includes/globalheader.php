<?php

/* 
 * This file contains the global php header to be on all pages
 */

require "classes/Admin.php";
require "classes/Customer.php";
require_once "classes/FAQ.php";
require_once "classes/ContactUs.php";
require_once "classes/Order.php";
require_once "classes/Product.php";
require_once "classes/Cart.php";

// Start session
session_start();

// Check if isAdmin session varible is set. If not, initialize
if (!isset($_SESSION["isAdmin"]))
{
    $_SESSION["isAdmin"] = false;
}

// Current site user
if (!isset($_SESSION["currentCustomer"]))
{
    $_SESSION["currentCustomer"] = new Customer();
}


// refresh customer object on each pageload
// This ensures that the customer objects is always up-to-date 
// Check if customer is in session
if (isset($_SESSION["currentCustomer"]))
{
    // Check if customer initialized
    if ($_SESSION["currentCustomer"]->getIsInitialized())
    {
        // Reinitialize 
        $_SESSION["currentCustomer"]->initializeID($_SESSION["currentCustomer"]->getCustomerID());
    }
    
    // Check if customer deleted
    if ($_SESSION['currentCustomer']->getIsDeleted())
    {
        // Uninitialize
        $_SESSION['currentCustomer'] = new Customer();
    }
}