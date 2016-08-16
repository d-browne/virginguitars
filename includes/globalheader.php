<?php

/* 
 * This file contains the global php header to be on all pages
 */

// Start session
session_start();

require "classes/Admin.php";
require "classes/Customer.php";

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

