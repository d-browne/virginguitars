# This view returns products in their cart
CREATE VIEW CART_VIEW AS
SELECT cart.CustomerFK, product.PrimaryPicturePath, model.Description, product.ProductID, cart.Quantity, product.UnitPrice As Price, (cart.Quantity*product.UnitPrice) As 'Total'
FROM product
JOIN CART on cart.ProductFK = product.ProductID
JOIN MODEL on model.ModelID = product.ModelFK;