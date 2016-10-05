CREATE VIEW MANAGE_STOCK_VIEW AS
SELECT 
p.PrimaryPicturePath,
p.ProductID, 
m.Description As 'Model',
b.BrandName As 'Brand', 
c.Type, 
ap.Description As 'Condition',
ct.Description As 'CaseType',
ps.Description As 'Status', 
p.Quantity, 
p.UnitPrice As 'Price'
FROM PRODUCT As p
INNER JOIN BRAND As b ON p.BrandFK = b.BrandID
INNER JOIN CLASSIFICATION As c ON p.ClassificationFK = c.ClassificationID
INNER JOIN PRODUCT_STATUS As ps ON p.StatusFK = ps.ProductStatusID
INNER JOIN APPEARENCE As ap ON p.AppearenceFK = ap.AppearenceID
INNER JOIN CASE_TYPE As ct ON p.CaseTypeFK = ct.CaseTypeID
INNER JOIN MODEL As m ON p.ModelFK = m.ModelID
INNER JOIN ADMINISTRATOR As a ON p.CreatedByFK = a.ADMINISTRATORID
INNER JOIN ADMINISTRATOR As a2 ON p.ModifiedByFK = a2.ADMINISTRATORID
ORDER BY p.ProductID;