# Virgin Guitars E-Commerce Website
# Dominic Browne, Dale Hogan, Warren Norris, Ben Morrison

# This view returns a list of products by their orders
CREATE VIEW PRODUCTS_BY_ORDER_VIEW AS
SELECT order_product.SalesOrderFK, product.PrimaryPicturePath, model.Description, product.ProductID, order_product.Quantity, (order_product.Quantity*50) As 'Shipping', order_product.Total
FROM order_product
LEFT JOIN product ON order_product.OrderProductID = product.ProductID
LEFT JOIN model ON model.ModelID = product.ModelFK;