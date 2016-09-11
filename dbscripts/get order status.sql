# Virgin Guitars E-Commerce Website
# Author Dominic Browne 11/9/2016
# This view gets each order and joins the order status description

CREATE VIEW ORDERS_STATUS AS
SELECT SalesOrderID, CustomerFK, InvoiceDate, SubTotal, Shipping, Total, ShippedDate, ShippingRecord, ORDER_STATUS.Description As 'Order Status'
FROM SALES_ORDER
JOIN ORDER_STATUS ON ORDER_STATUS.OrderStatusID = SALES_ORDER.OrderStatusFK
