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
p.ModifiedDate
FROM Product As p
INNER JOIN Brand As b ON p.BrandFK = b.BrandID
INNER JOIN Classification As c ON p.ClassificationFK = c.ClassificationID
INNER JOIN Product_Status As ps ON p.StatusFK = ps.ProductStatusID
INNER JOIN Appearence As ap ON p.AppearenceFK = ap.AppearenceID
INNER JOIN Case_Type As ct ON p.CaseTypeFK = ct.CaseTypeID
INNER JOIN Model As m ON p.ModelFK = m.ModelID
INNER JOIN Administrator As a ON p.CreatedByFK = a.AdministratorID
INNER JOIN Administrator As a2 ON p.ModifiedByFK = a2.AdministratorID
ORDER BY p.ProductID;