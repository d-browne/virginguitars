<?php

/* 
 * This unit test tests the function of the cart class
 */

use PHPUnit\Framework\TestCase;

require_once 'classes/Cart.php';

class CartTest extends TestCase 
{ 
    
    
    public function delItemDataProvider()
    {
        return array(
            array(1, 99, "Specified Item is not in cart"),
            array(1, 2, true)
        );
    }
    
    /**
     * 
     * @dataProvider delItemDataProvider
     */
    public function testDelItem($CustomerID, $ProductID, $expected)
    {
        // Create cart object
        $cart = new Cart($CustomerID);

        // Attempt to delete item
        $this->assertEquals($expected, $cart->delItem($ProductID));
    }
    
    public function setQuantityDataProvider()
    {
        return array(
            array(1, 1, 3, true),
            array(1, 1, 1, true),
            array(1, 1, -1, "Quantity must not be less than zero"),
            array(1, 2, 3, true)
        );
    }
    
    /**
     * 
     * @dataProvider setQuantityDataProvider
     */
    public function testSetQuantity($CustomerID, $ProductID, $newQuantity, $expected)
    {
        // Create cart object
        $cart = new Cart($CustomerID);
        
        // Attempt to update quantity
        $this->assertEquals($expected, $cart->setQuantity($ProductID, $newQuantity));
    }
    
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