<?php
include_once("includes/globalheader.php");
include_once("classes/Database.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Order</title>
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
<?php


include_once("paypalconfig.php");
include_once("paypalfunctions.php");
include_once("paypal.class.php");

	$paypal= new MyPayPal();
	
	//Post Data received from product list page.
	if(_GET('paypal')=='checkout'){
		
		//-------------------- prepare products -------------------------
		
		//Mainly we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
		
		//Please Note : People can manipulate hidden field amounts in form,
		//In practical world you must fetch actual price from database using item id. Eg: 
		//$products[0]['ItemPrice'] = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
		
		$products = [];
		
		
		
		// set an item via POST request
		
//		$products[0]['ItemName'] = _POST('itemname'); //Item Name
//		$products[0]['ItemPrice'] = _POST('itemprice'); //Item Price
//		$products[0]['ItemNumber'] = _POST('itemnumber'); //Item Number
//		$products[0]['ItemDesc'] = _POST('itemdesc'); //Item Number
//		$products[0]['ItemQty']	= _POST('itemQty'); // Item Quantity
                
                // Create data connection to get items
                $database = new Database();
                $dataConnection = $database->getDataConnection();
                
                // Query for cart items
                $query = "SELECT * FROM CART_VIEW WHERE CustomerFK='"._SESSION('currentCustomer')->getCustomerID()."' AND isDeleted='0';";
                
                // Execute query
                $result = $dataConnection->query($query);
                
                // Die if query fails
                if ($result === false)
                {
                    die("Cannot query for cart items");
                }
                
                // Check if there are items in cart
                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        $rowData = array(
                            'ItemName' => $row['Description'],
                            'ItemPrice' => $row['Price'],
                            'ItemNumber' => $row['ProductID'],
                            'ItemDesc' => $row['Description'],
                            'ItemQty' => $row['Quantity']
                        );
                        
                        // push to products
                        array_push($products, $rowData);
                    }
                }
                else
                {
                    // Handle nothing in cart
                    die('done');
                }
                
                               
                // Shipping
                $shipping = [];
                //$shipping['shippingName'] = _POST('shippingName'); // Get this from customer details
                
                // Validate shipping inputs
                if (iconv_strlen(_POST('shippingStreet')) > 50)
                {
                    die("StreetAddress too long");
                }
                if (iconv_strlen(_POST('shippingCity')) > 50)
                {
                    die("City too long");
                }
                if (iconv_strlen(_POST('shippingState')) > 50)
                {
                    die("State too long");
                }
                if (iconv_strlen(_POST('shippingZip')) > 4)
                {
                    die("PostCode too long");
                }
                if (iconv_strlen($Country) > 2)
                {
                    die("Country too long");
                }
                
                $shipping['shippingStreet'] = _POST('shippingStreet');
                $shipping['shippingCity'] = _POST('shippingCity');
                $shipping['shippingState'] = _POST('shippingState');
		$shipping['shippingZip'] = _POST('shippingZip');
                $shipping['shippingPhone'] = _POST('shippingPhone');
                $shipping['shippingCountry'] = _POST('shippingCountry');
                
		/*
		$products[0]['ItemName'] = 'my item 1'; //Item Name
		$products[0]['ItemPrice'] = 0.5; //Item Price
		$products[0]['ItemNumber'] = 'xxx1'; //Item Number
		$products[0]['ItemDesc'] = 'good item'; //Item Number
		$products[0]['ItemQty']	= 1; // Item Quantity		
		*/
		/*
		
		// set a second item
		
		$products[1]['ItemName'] = 'my item 2'; //Item Name
		$products[1]['ItemPrice'] = 10; //Item Price
		$products[1]['ItemNumber'] = 'xxx2'; //Item Number
		$products[1]['ItemDesc'] = 'good item 2'; //Item Number
		$products[1]['ItemQty']	= 3; // Item Quantity
		*/		
		
		//-------------------- prepare charges -------------------------
		
		$charges = [];
                
                // Query calculate shipping cost
                $calculateShippingQuery = "SELECT SUM(Price) As 'TotalShipping' FROM CART_VIEW WHERE CustomerFK='"._SESSION('currentCustomer')->getCustomerID()."' AND isDeleted='0';";
                
                // Execute query 
                $calculateShippingResult = $dataConnection->query($calculateShippingQuery);
                
                // Die if query fails
                if ($result === false)
                {
                    die('Unable to calculate shipping cost');
                }
                
                // Ensure row retrieved
                if ($calculateShippingResult->num_rows > 0)
                {
                    $shippingCostRow = $calculateShippingResult->fetch_assoc();
                    $shippingCost = $shippingCostRow["TotalShipping"];
                }
                else
                {
                    die('Unable to calculate shipping cost');
                }
		
		//Other important variables like tax, shipping cost
		$charges['TotalTaxAmount'] = 0;  //Sum of tax for all items in this order. 
		$charges['HandalingCost'] = 0;  //Handling cost for this order.
		$charges['InsuranceCost'] = 0;  //shipping insurance cost for this order.
		$charges['ShippinDiscount'] = 0; //Shipping discount for this order. Specify this as negative number.
		$charges['ShippinCost'] = $shippingCost; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
		
		//------------------SetExpressCheckOut-------------------
		
		//We need to execute the "SetExpressCheckOut" method to obtain paypal token

		$paypal->SetExpressCheckOut($products, $charges, $shipping);		
	}
	elseif(_GET('token')!=''&&_GET('PayerID')!=''){
		
		//------------------DoExpressCheckoutPayment-------------------		
		
		//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
		//we will be using these two variables to execute the "DoExpressCheckoutPayment"
		//Note: we haven't received any payment yet.
		
		$paypal->DoExpressCheckoutPayment();
	}
	else{
		
		//order form
		

	}
?>

    </div>
            <?php
            // Display the page footer
            include("includes/pagefooter.php.inc");
            ?>
        </div>
</body>
</html>