# Virgin Guitars E-Commerce Website
# Dominic Browne, Dale Hogan, Warren Norris, Ben Morrison

# This view returns the delivery address of each order
CREATE VIEW DELIVERY_ADDRESS_BY_ORDER_ID AS
SELECT sales_order.SalesOrderID, deliveryaddress.StreetAddress, deliveryaddress.City, deliveryaddress.State, deliveryaddress.PostCode, deliveryaddress.Country
FROM sales_order
LEFT JOIN deliveryaddress ON deliveryaddress.DeliveryAddressID = sales_order.DeliveryAddressFK;