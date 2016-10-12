<?php

/* 
 * This unit test tests the function of the cart class
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/Cart.php';

class CartTest extends TestCase 
{ 
    public function addToCartDataProvider()
    {
        return array(
            array(1, 1, true),
            array(1, 1, "Item already in cart"),
            array(1, 99, "ProductID not found")
        );
    }
    
    /**
     * 
     * @dataProvider addToCartDataProvider
     */
    public function testAddToCart($CustomerID, $ProductID, $expected)
    {
        // Create cart object
        $cart = new Cart($CustomerID);
        
        // Attempt to add item to cart
        $this->assertEquals($expected, $cart->addToCart($ProductID));
    }
}