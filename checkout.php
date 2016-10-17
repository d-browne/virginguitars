<?php

/*
 * Virgin Guitars E-Commerce website 2016
 * Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison
 * 
 * checkout.php
 * The purpose of this page is to display the checkout page, simlar to the cart
 * but allows user user to input shipping and payment details. 
 * 
 * Author: Dominic Browne
 */

// Include the global header
include "includes/globalheader.php";

// Include the database
require_once 'classes/Database.php';

// if member is not signed in redirect to member signin page
if ($_SESSION["currentCustomer"]->getIsInitialized() != true)
{
    header("Location: members.php");
}

// Refresh cart
$cart = new Cart($_SESSION["currentCustomer"]->getCustomerID());
$cart->refreshQuantity();

// Create data connection
$database = new Database();
$dataConnection = $database->getDataConnection();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Virgin Guitars - Checkout</title>
<link href="styles/main.css" rel="stylesheet" type="text/css">
<link href="styles/js-image-slider.css" rel="stylesheet" type="text/css" />
<script src="scripts/js-image-slider.js" type="text/javascript"></script>
</head>

<body>
	<div id="mainBox">
    	<?php
            // Display Page header
            include 'includes/pageheader.php.inc';
        ?>
        
        <?php
            // Display menu bar
            include 'includes/menubar.php.inc';
        ?>
        
        <?php
            // Display menu bar
            include 'includes/categorybox.php.inc';
        ?>
        
        <div id="contentBox">
        	<h1>Checkout</h1>
            <div id="tableContainer">
                <table class="cartTable" border="1">
                    <tr class="headerRow">
                        <td></td>
                        <td><span class="tableHeader">Description</span></td>
                        <td><span class="tableHeader">Prod.ID</span></td>
                        <td><span class="tableHeader">Quantity</span></td>
                        <td><span class="tableHeader">Price</span></td>
                        <td><span class="tableHeader">Total</span></td>
                        <td><span class="tableHeader">Del</span></td>
                    </tr>
                    <?php
                    // Query cart and display each row

                    // Query to get all cart items for this signed in member
                    $query = "SELECT * FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."' AND isDeleted='0' AND Status<>'Out Of Stock';";
                    
                    // Execute query 
                    $result = $dataConnection->query($query);
                    
                    // Check if query successfull 
                    if ($result !== false)
                    {
                        // Check that there are items in the cart
                        if ($result->num_rows > 0)
                        {
                            // Loop through each row retruned and draw table
                            $isAltRow = false;
                            while($row = $result->fetch_assoc())
                            {
                                if ($isAltRow)
                                {
                                    echo '<tr class="altRow">';
                                    $isAltRow = false;
                                }
                                else
                                {
                                    echo '<tr>';
                                    $isAltRow = true;
                                }
                                
                                // Draw image
                                echo '<td><a href="product.php?id='.$row['ProductID'].'"><img src="'.$row['PrimaryPicturePath'].'" alt="'.$row['Description'].'" width="100"/></a></td>';
                                // Draw description
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Description'].'</a></td>';
                                // Draw product id
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>';
                                // Draw Quantity
                                echo '<form action="cart.php" method="POST"><td><input type="text" style="width: 4em;" name="numberOfItems" value="'.$row['Quantity'].'" /></a></td><input type="hidden" name="ProductID" value="'.$row['ProductID'].'" /><button type="submit" name="updateCart" hidden="true" /></form>';
                                // Draw price
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Price'].'</a></td>';
                                // Draw total
                                echo '<td><a href="product.php?id='.$row['ProductID'].'">'.$row['Total'].'</a></td>';
                                // Draw del
                                echo '<td><a href="cart.php?delete='.$row['ProductID'].'"><span class="delButton">Del</span></a></td>';
                                
                                // Close row
                                echo '</tr>';
                            }
                        }
                        else
                        {
                            echo "</table>The cart is empty";
                        }
                    }
                    else
                    {
                        echo "</table>Error querying for cart";
                    }
                    ?>
                    
                </table>
            </div>
            
            <div id="formsContainer">
                <form method="POST" action="process.php?paypal=checkout">
                <div id="leftForm" class="formDiv">
                        <fieldset class="checkoutFieldSet" id="checkoutShippingDetails">
                            <legend>Shipping Detials</legend>
                            <div><label>Street Address:</label><input type="text" value="<?php echo $_SESSION['currentCustomer']->getHomeAddress()->getStreetAddress(); ?>" name="shippingStreet" required/></div>
                            <div><label>City:</label><input type="text" value="<?php echo $_SESSION['currentCustomer']->getHomeAddress()->getCity(); ?>" name="shippingCity" required/></div>
                            <div><label>State:</label><input type="text" value="<?php $customer = new Customer(); $customer->getHomeAddress(); ?>" name="shippingState" required/></div>
                            <div><label>Post Code:</label><input type="text" value="<?php echo $_SESSION['currentCustomer']->getHomeAddress()->getPostCode(); ?>" name="shippingZip" required/></div>
                            <div><label>Telephone:</label><input type="text" value="<?php echo $_SESSION['currentCustomer']->getHomePhone(); ?>" name="shippingPhone" required/></div>
                            <div><label>Country:</label>
                                <select style="width: 9em; margin-left: -0.35em;" name="shippingCountry" required>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AX">Åland Islands</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU" selected>Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia, Plurinational State of</option>
                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvet Island</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curaçao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="TF">French Southern Territories</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard Island and McDonald Islands</option>
                                    <option value="VA">Holy See (Vatican City State)</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran, Islamic Republic of</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                    <option value="KR">Korea, Republic of</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Lao People's Democratic Republic</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macao</option>
                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia, Federated States of</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestinian Territory, Occupied</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PN">Pitcairn</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RE">Réunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="BL">Saint Barthélemy</option>
                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="MF">Saint Martin (French part)</option>
                                    <option value="PM">Saint Pierre and Miquelon</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan, Province of China</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UM">United States Minor Outlying Islands</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                    <option value="VN">Viet Nam</option>
                                    <option value="VG">Virgin Islands, British</option>
                                    <option value="VI">Virgin Islands, U.S.</option>
                                    <option value="WF">Wallis and Futuna</option>
                                    <option value="EH">Western Sahara</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                            </select>
                            </div>
                        </fieldset>
                    </div>
                    <div id="rightForm" class="formDiv">
                        <fieldset class="checkoutFieldSet" id="checkoutPaymentMethod">
                            <legend>Payment method</legend>
                            <?php //<div><label>Method:</label> Bitcoin <input type="radio" name="payment" /> Paypal <input type="radio" name="payment" checked/></div> ?>
                            <div><label>Paypal Email: </label><input type="text" disabled="true" value="Login On Next Page"/></div>
                            
                                <button id="payButton" class="formCSSButtonButton" type="submit" name="submitbutt">Pay</button>
                        </fieldset>
                    </div>
                </form>
                </div>
                
                
                
        </div>
        
        	<div id="summaryDetailsBox">
                        <form action="cart.php"><button class="formCSSButtonButton" style="left: 0.5em;">Back</button></form>
            	<div id="shippingLabel">Shipping: $
                    <?php // Get total
                    // Query to calculate total
                    $query = "SELECT SUM(Quantity)*50 As 'Sumtotal' FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."' AND isDeleted='0' AND Status<>'Out Of Stock';";

                    // Execute query
                    $result = $dataConnection->query($query);

                    // if query successfull
                    if ($result !== false)
                    {
                        // Check if result resturned
                        if ($result->num_rows > 0)
                        {
                            // Get first row
                            $row = $result->fetch_assoc();

                            // show the total
                            echo $row['Sumtotal'];
                        }
                        else
                        {
                            echo "0";
                        }
                    }
                    else
                    {
                        // Error querying for total
                        echo "ERR";
                    }
                    ?>
                    </div>
            	<div id="totalLabel">Total: $
                    <?php // Get total
                    // Query to calculate total
                    $query = "SELECT SUM(Total)+SUM(Quantity)*50 As 'Sumtotal' FROM CART_VIEW WHERE CustomerFK='".$_SESSION["currentCustomer"]->getCustomerID()."' AND isDeleted='0' AND Status<>'Out Of Stock';";

                    // Execute query
                    $result = $dataConnection->query($query);

                    // if query successfull
                    if ($result !== false)
                    {
                        // Check if result resturned
                        if ($result->num_rows > 0)
                        {
                            // Get first row
                            $row = $result->fetch_assoc();

                            // show the total
                            echo $row['Sumtotal'];
                        }
                        else
                        {
                            echo "0";
                        }
                    }
                    else
                    {
                        // Error querying for total
                        echo "ERR";
                    }
                    ?>
                </div>
            </div>
        
        
        
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
            
        </div>
</body>
</html>
