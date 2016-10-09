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