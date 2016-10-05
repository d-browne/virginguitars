<?php
/*
 * This file displays the manage stock areas of the admin panel.
 * It displays a list of each product and gives the administrator
 * the ability to edit each item. This area also faciliates the creation and
 * deletion of stock items.
 */
?>

<div id="contentBox">
    <div id="manageCustomersTopLeft">
        <h1>Manage Stock</h1>
    </div>

    <div id="manageCustomersTopRight">
        <fieldset class="inputFieldSet" id="userDetailsFieldset">
            <legend>Search</legend>
            <form id="userDetailsForm" action="admin.php?manageCustomers">
                <div class="inputField"><label>Product ID:</label> <input class="textBox" name="productid" type="text" placeholder="e.g. 1"/></div>
                <div class="inputField"><label>Model:</label> <input class="textBox" name="model" type="text" placeholder="e.g. American" value=""/></div>
                <div class="inputField"><label>Brand:</label> <input class="textBox" name="brand" type="text" placeholder="e.g. Fender"/></div>
                <div class="inputField"><label>Type:</label> <input class="textBox" name="type" type="text" placeholder="e.g. Electric"/></div>
                <div class="inputField"><label>Condition:</label> <input class="textBox" name="condition" type="text" placeholder="e.g. Used"/></div>
                <div class="inputField"><label>Case:</label> <input class="textBox" name="case" type="text" placeholder="e.g. Hard"/></div>
                <div class="inputField"><label>Status:</label> <input class="textBox" name="status" type="text" placeholder="e.g. Back"/></div>
                <div class="inputField"><label>Quantity:</label> <input class="textBox" name="quantity" type="text" placeholder="e.g. 1"/></div>
                <div class="inputField"><input class="submitButton" type="submit" name="searchButton" value="Search" /></div>
            </form>
        </fieldset>
    </div>
    <div id="tableContainer">
        <table class="cartTable bottomTable" border="1" >
            <tr class="headerRow">
                <td><span class="tableHeader">Image</span></td>
                <td><span class="tableHeader">Prod.ID</span></td>
                <td><span class="tableHeader">Model</span></td>
                <td><span class="tableHeader">Brand</span></td>
                <td><span class="tableHeader">Type</span></td>
                <td><span class="tableHeader">Condition</span></td>
                <td><span class="tableHeader">Case</span></td>
                <td><span class="tableHeader">Status</span></td>
                <td><span class="tableHeader">Quantity</span></td>
                <td><span class="tableHeader">Price</span></td>
                <td><span class="tableHeader"></span></td>
            </tr>
            <tr>
                <td>
                    <img src="images/guitars/fenderLimitedEditionAmericanStandardTelecaster/1.jpg" width="100" alt="American Standard Strat" />
                </td>
                <td>
                    <a href="admin.php">
                        1
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Amertican Standard Strat
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Fender
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Electric
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Brand new
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Hard Case
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        In Stock
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        3
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        $2000
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
                    <img src="images/guitars/fenderLimitedEditionAmericanStandardTelecaster/1.jpg" width="100" alt="American Standard Strat" />
                </td>
                <td>
                    <a href="admin.php">
                        2
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Amertican Non-Standard Strat
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Fender
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Acoustic
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Used
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Soft case
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        Backorder
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        0
                    </a>
                </td>
                <td>
                    <a href="admin.php">
                        $1800
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