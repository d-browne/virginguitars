# This view returns products in their cart
CREATE VIEW CART_VIEW AS
SELECT CART.CustomerFK, PRODUCT.PrimaryPicturePath, MODEL.Description, PRODUCT.ProductID, CART.Quantity, PRODUCT.UnitPrice As Price, (CART.Quantity*PRODUCT.UnitPrice) As 'Total'
FROM PRODUCT
JOIN CART on CART.ProductFK = PRODUCT.ProductID
JOIN MODEL on MODEL.ModelID = PRODUCT.ModelFK;