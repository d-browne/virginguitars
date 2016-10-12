# This view returns all the details of all the products
CREATE VIEW PRODUCT_DETAILS_VIEW AS
SELECT
p.PrimaryPicturePath,
p.ProductID, 
b.BrandName As 'Brand', 
c.Type, 
p.Quantity, 
ps.Description As 'Status', 
p.Description, 
ap.Description As 'Condition',
p.UnitPrice As 'Price', 
ct.Description As 'CaseType',  
m.Description As 'Model',
a.UserName As 'CreatedBy',
a2.UserName As 'ModifiedBy',
p.CreationDate,
p.ModifiedDate,
p.isDeleted
FROM PRODUCT As p
INNER JOIN BRAND As b ON p.BrandFK = b.BrandID
INNER JOIN CLASSIFICATION As c ON p.ClassificationFK = c.ClassificationID
INNER JOIN PRODUCT_STATUS As ps ON p.StatusFK = ps.ProductStatusID
INNER JOIN APPEARENCE As ap ON p.AppearenceFK = ap.AppearenceID
INNER JOIN CASE_TYPE As ct ON p.CaseTypeFK = ct.CaseTypeID
INNER JOIN MODEL As m ON p.ModelFK = m.ModelID
INNER JOIN ADMINISTRATOR As a ON p.CreatedByFK = a.AdministratorID
INNER JOIN ADMINISTRATOR As a2 ON p.ModifiedByFK = a2.AdministratorID
ORDER BY p.ProductID;