# Virgin Guitars E-commerce Website
# This Query Reutrns a list of all Customers, their details and number of open and closed orders.
# For use in displaying a list of customers in the Administration panel
# Query Written by Dominic Browne 11th September 2016

SELECT CustomerID, FirstName, LastName, Email, COUNT(SALES_ORDER.CustomerFK) as 'All Orders', SUM(case when order_status.Description = 'Requested' then 1 else 0 end) as 'New Orders'
FROM CUSTOMER
LEFT JOIN sales_order ON sales_order.CustomerFK = CustomerID
LEFT JOIN order_status ON order_status.OrderStatusID = sales_order.OrderStatusFK
GROUP BY CustomerID