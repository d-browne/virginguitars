<?php

/* 
 * Virgin Guitars E-Commerce website 2016
 * Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * The purpose of this include is to display the Manage Customers sections of
 * the website and handle any get/post requests to that page. 
 * 
 * Author: Dominic Browne
 */
?>

<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Manage Customers</h1>
    </div>
    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="admin.php?manageCustomers">
                <div class="inputField"><label>Customer.ID:</label> <input class="textBox" name="customerid" type="text" placeholder="e.g. 1"/></div>
                <div class="inputField"><label>First Name:</label> <input class="textBox" name="firstname" type="text" placeholder="e.g. Kev" value=""/></div>
                <div class="inputField"><label>Last Name:</label> <input class="textBox" name="lastname" type="text" placeholder="e.g. Smith"/></div>
                <div class="inputField"><label>Email:</label> <input class="textBox" name="email" type="email" placeholder="mail@ne.com"/></div>
                <div class="inputField"><input class="submitButton" type="submit" name="searchButton" value="Search" /></div>
            </form>
        </fieldset>
    </div>
    <div id="tableContainer">
        <table class="cartTable" border="1" >
            <tr class="headerRow">
                <td><span class="tableHeader tableHeaderAsc"><a href="admin.php">Customer.ID</a></span></td>
                <td><span class="tableHeader">First Name</span></td>
                <td><span class="tableHeader">Last Name</span></td>
                <td><span class="tableHeader tableHeaderDesc"><a href="admin.php">Email</a></span></td>
                <td><span class="tableHeader">All Orders</span></td>
                <td><span class="tableHeader">New Orders</span></td>
                <td><span class="tableHeader">Edit</span></td>
                <td><span class="tableHeader">Del</span></td>
            </tr>
            <tr>
                <td>
                    <a href="admin.php">
                        1
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Dominic
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Browne
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        dominic@mail.com
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        10
                    </a>
                </td>
                <td>
                    <a class="newOrdersButton" href="admin.php">
                        2
                    </a>
                </td>
                <td>
                    <a class="editButton" href="admin.php">
                        Edit
                    </a>
                </td>
                <td>
                    <a class="delButton" href="admin.php">
                        Del
                    </a>
                </td>
            </tr>
            <tr class="altRow">
                <td>
                    <a href="admin.php">
                        2
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Warren
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Norris
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        warren@mail.com
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        3
                    </a>
                </td>
                <td>
                    <a class="newOrdersButton" href="admin.php">
                        1
                    </a>
                </td>
                <td>
                    <a class="editButton" href="admin.php">
                        Edit
                    </a>
                </td>
                <td>
                    <a class="delButton" href="admin.php">
                        Del
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="admin.php">
                        3
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Ben
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Hogan
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        ben@mail.com
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        5
                    </a>
                </td>
                <td>
                    <a class="newOrdersButton" href="admin.php">
                        4
                    </a>
                </td>
                <td>
                    <a class="editButton" href="admin.php">
                        Edit
                    </a>
                </td>
                <td>
                    <a class="delButton" href="admin.php">
                        Del
                    </a>
                </td>
            </tr>
            <tr class="altRow">
                <td>
                    <a href="admin.php">
                        4
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Dale
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Hogan
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        dale@mail.com
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        6
                    </a>
                </td>
                <td>
                    <a class="newOrdersButton" href="admin.php">
                        0
                    </a>
                </td>
                <td>
                    <a class="editButton" href="admin.php">
                        Edit
                    </a>
                </td>
                <td>
                    <a class="delButton" href="admin.php">
                        Del
                    </a>
                </td>
            </tr>

        </table>
    </div>


    <div id="manageCustomersStretcher"></div>
    <div id="bottomButtonsBox">
        <form action="admin.php?manageCustomers&newCustomer"><button class="formCSSButtonButton">New</button></form>
        <form action="admin.php?back"><button class="formCSSButtonButton">Back</button></form>
    </div>

</div>