# Virgin Guitars E-Commerce Website
# Dominic Browne, Warren Norris, Dale Hogan, Ben Morrison

# UpdateDeliveryStreetAddress.sql

# The Purpose of this stored procedure is update the delivery address street address given the order ID
DELIMITER //
CREATE PROCEDURE UpdateDeliveryStreetAddress 
(
    IN in_street_address VarChar(50),
    IN in_order_id int(7)
)
BEGIN
    UPDATE DELIVERYADDRESS
    JOIN SALES_ORDER ON SALES_ORDER.DeliveryAddressFK = DELIVERYADDRESS.DeliveryAddressID
    SET StreetAddress=in_street_address
    WHERE SALES_ORDER.SalesOrderID = in_order_id;
END//
DELIMITER ;