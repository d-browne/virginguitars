# Virgin Guitars E-Commerce Website
# Dominic Browne, Dale Hogan, Warren Norris, Ben Morrison

# This view returns a list of PRODUCTs by their orders
CREATE VIEW PRODUCTS_BY_ORDER_VIEW AS
SELECT ORDER_PRODUCT.SalesOrderFK, PRODUCT.PrimaryPicturePath, MODEL.Description, PRODUCT.ProductID, ORDER_PRODUCT.Quantity, (ORDER_PRODUCT.Quantity*50) As 'Shipping', ORDER_PRODUCT.Total
FROM ORDER_PRODUCT
LEFT JOIN PRODUCT ON ORDER_PRODUCT.OrderProductID = PRODUCT.ProductID
LEFT JOIN MODEL ON MODEL.ModelID = PRODUCT.ModelFK;


# newer version for updated tables
CREATE VIEW PRODUCTS_BY_ORDER_VIEW AS
SELECT ORDER_PRODUCT.SalesOrderFK, PRODUCT.PrimaryPicturePath, MODEL.Description, PRODUCT.ProductID, ORDER_PRODUCT.Quantity, ORDER_PRODUCT.UnitPrice, ORDER_PRODUCT.UnitShipping, (ORDER_PRODUCT.UnitPrice*ORDER_PRODUCT.Quantity) As 'SubTotal', (ORDER_PRODUCT.UnitShipping*ORDER_PRODUCT.Quantity) As 'TotalShipping', ORDER_PRODUCT.Total
FROM ORDER_PRODUCT
LEFT JOIN PRODUCT ON ORDER_PRODUCT.OrderProductID = PRODUCT.ProductID
LEFT JOIN MODEL ON MODEL.ModelID = PRODUCT.ModelFK;