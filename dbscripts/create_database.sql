create database vgecw_db;
use vgecw_db;

create table CUSTOMER (
	CustomerID int(7) PRIMARY KEY AUTO_INCREMENT,
    LastName VarChar(40) NOT NULL,
    FirstName VarChar(40) NOT NULL,
    Salutation VarChar(5) NOT NULL,
    MailingList int(1) DEFAULT 0 NOT NULL,
    Email VarChar(60) UNIQUE NOT NULL,
    EncryptedPassword VarChar(60) NOT NULL,
    MobilePhone VarChar(15),
    HomePhone VarCHar(15)
)ENGINE=InnoDB;

create table HOMEADDRESS (
	HomeAddressID int(7) PRIMARY KEY AUTO_INCREMENT,
    Customer int(7) NOT NULL,
    StreetAddress VarChar(50) NOT NULL,
    City VarChar(50) NOT NULL,
    State VarChar(50) NOT NULL,
    PostCode VarChar(4) NOT NULL,
    Country VarChar(15) NOT NULL,
    FOREIGN KEY (Customer) REFERENCES Customer(CustomerID)
)ENGINE=InnoDB;

create table ORDER_STATUS (
	OrderStatusID int(5) PRIMARY KEY AUTO_INCREMENT,
    Description VarChar(40) NOT NULL
)ENGINE=InnoDB;

create table SALES_ORDER (
	SalesOrderID int(7) PRIMARY KEY AUTO_INCREMENT,
    Customer int(7) NOT NULL,
    InvoiceDate DATE,
    SubTotal DECIMAL(6,2) NOT NULL,
    Shipping DECIMAL(6,2) NOT NULL,
    Total Decimal(6,2) NOT NULL,
    ShippedDate DATE,
    ShippingRecord VarChar(15),
    OrderStatus int(2) NOT NULL,
    FOREIGN KEY (Customer) REFERENCES CUSTOMER(CustomerID),
    FOREIGN KEY (OrderStatus) REFERENCES ORDER_STATUS(OrderStatusID)
)ENGINE=InnoDB;

create table DELIVERYADDRESS (
	DeliveryAddressID int(7) PRIMARY KEY AUTO_INCREMENT,
    Customer int(7) NOT NULL,
    StreetAddress VarChar(50) NOT NULL,
    City VarChar(50) NOT NULL,
    State VarChar(50) NOT NULL,
    PostCode VarChar(4) NOT NULL,
    Country VarChar(15) NOT NULL,
    FOREIGN KEY (Customer) REFERENCES CUSTOMER(CustomerID)
)ENGINE=InnoDB;

create table BRAND (
	BrandID int(4) PRIMARY KEY AUTO_INCREMENT,
    BrandName VarChar(20) NOT NULL
)ENGINE=InnoDB;

create table CLASSIFICATION (
	ClassificationID int(4) PRIMARY KEY AUTO_INCREMENT,
    Type VarChar(20) NOT NULL,
    NumberOfStrings int(2) NOT NULL
)ENGINE=InnoDB;

create table APPEARENCE (
	AppearenceID int(4) PRIMARY KEY AUTO_INCREMENT,
    Description VarChar(100) NOT NULL
)ENGINE=InnoDB;

create table CASE_TYPE (
	CaseTypeID int(4) PRIMARY KEY AUTO_INCREMENT,
    Description VarChar(100) NOT NULL
)ENGINE=InnoDB;

create table MODEL (
	ModelID int(4) PRIMARY KEY AUTO_INCREMENT,
    Description VarChar(100) NOT NULL,
    Year int(4) NOT NULL
)ENGINE=InnoDB;

create table PRODUCT_STATUS (
	ProductStatusID int(4) PRIMARY KEY AUTO_INCREMENT,
    Description VarChar(100) NOT NULL
)ENGINE=InnoDB;

create table ADMINISTRATOR (
	AdministratorID int(4) PRIMARY KEY AUTO_INCREMENT,
    UserName VarChar(40) NOT NULL,
    EncryptedPassword VarChar(60) NOT NULL,
    Salt INT NOT NULL
)ENGINE=InnoDB;

create table PRODUCT (
	ProductID int(7) PRIMARY KEY AUTO_INCREMENT,
    Classification int(3) NOT NULL,
    Brand int(4) NOT NULL,
    Quantity int(3) NOT NULL,
    Status int(3) NOT NULL,
    Description VarChar(100) NOT NULL,
    Appearence int(3) NOT NULL,
    UnitPrice DECIMAL(6,2) NOT NULL,
    CaseType int(3) NOT NULL,
    Model int(5) NOT NULL,
    CreatedBy int(4) NOT NULL,
    ModifiedBy int(4) NOT NULL,
    CreationDate DATE NOT NULL,
    ModifiedDate DATE,
    FOREIGN KEY (Classification) REFERENCES CLASSIFICATION(ClassificationID),
    FOREIGN KEY (Brand) REFERENCES Brand(BrandID),
    FOREIGN KEY (Status) REFERENCES PRODUCT_STATUS(ProductStatusID),
    FOREIGN KEY (CaseType) REFERENCES CASE_TYPE(CaseTypeID),
    FOREIGN KEY (Model) REFERENCES MODEL(ModelID),
    FOREIGN KEY (CreatedBy) REFERENCES ADMINISTRATOR(AdministratorID),
    FOREIGN KEY (ModifiedBy) REFERENCES ADMINISTRATOR(AdministratorID)
)ENGINE=InnoDB;

create table ORDER_PRODUCT (
	OrderProductID int(4) PRIMARY KEY AUTO_INCREMENT,
    SalesOrder int(7) NOT NULL,
    Product int(7) NOT NULL,
    Quantity int(4) NOT NULL,
    Total DECIMAL(6,2) NOT NULL,
    FOREIGN KEY (SalesOrder) REFERENCES SALES_ORDER(SalesOrderID),
    FOREIGN KEY (Product) REFERENCES PRODUCT(ProductID)
)ENGINE=InnoDB;

create table PICTURE (
	PictureID int(4) PRIMARY KEY AUTO_INCREMENT,
    Product int(7) NOT NULL,
    Image VarChar(100) NOT NULL,
    FOREIGN KEY (Product) REFERENCES PRODUCT(ProductID)
)ENGINE=InnoDB;

INSERT INTO CLASSIFICATION VALUES (NULL, 'Guitar', 6);
INSERT INTO CLASSIFICATION VALUES (NULL, 'Bass', 4);
INSERT INTO CLASSIFICATION VALUES (NULL, '7 String Guitar', 7);

INSERT INTO BRAND VALUES (NULL, 'Fender');
INSERT INTO BRAND VALUES (NULL, 'ESP');
INSERT INTO BRAND VALUES (NULL, 'Gibson');

INSERT INTO APPEARENCE VALUES (NULL, 'Brand New');
INSERT INTO APPEARENCE VALUES (NULL, 'Used');

INSERT INTO CASE_TYPE VALUES (NULL, 'Hard case');
INSERT INTO CASE_TYPE VALUES (NULL, 'Soft case');

INSERT INTO MODEL VALUES (NULL, 'strat', 2010);
INSERT INTO MODEL VALUES (NULL, 'les paul', 2014);

INSERT INTO PRODUCT_STATUS VALUES (NULL, 'status1');
INSERT INTO PRODUCT_STATUS VALUES (NULL, 'status2');

INSERT INTO ADMINISTRATOR VALUES (NULL, 'admin', 'password', '22');

INSERT INTO PRODUCT VALUES (NULL, 1, 1, 5, 1, 'New Fender', 1, '1000.00', 1, 1, 1, 1, CURDATE(), CURDATE());
INSERT INTO PRODUCT VALUES (NULL, 1, 1, 5, 1, 'Used Fender', 2, '750.00', 1, 1, 1, 1, CURDATE(), CURDATE());
INSERT INTO PRODUCT VALUES (NULL, 1, 3, 5, 1, 'New Les Paul', 1, '750.00', 1, 2, 1, 1, CURDATE(), CURDATE());

INSERT INTO CUSTOMER VALUES (NULL, 'Morrison', 'Ben', '', 1, 'ben@mail.com', 'password', '0000111222', '11112222');
INSERT INTO CUSTOMER VALUES (NULL, 'Hogan', 'Dale', '', 1, 'dale@mail.com', 'password', '1111222333', '22223333');
INSERT INTO CUSTOMER VALUES (NULL, 'Norris', 'Warren', '', 1, 'warren@mail.com', 'password', '2222333444', '33334444');
INSERT INTO CUSTOMER VALUES (NULL, 'Browne', 'Dominic', '', 1, 'dominic@mail.com', 'password', '3333444555', '44445555');

INSERT INTO HOMEADDRESS VALUES (NULL, 1, '123 Fake Street', 'Sydney', 'NSW', 0000, 'Australia');
INSERT INTO HOMEADDRESS VALUES (NULL, 2, '456 Fake Street', 'Gosford', 'NSW', 1111, 'Australia');
INSERT INTO HOMEADDRESS VALUES (NULL, 3, '789 Fake Street', 'Newcastle', 'NSW', 2222, 'Australia');
INSERT INTO HOMEADDRESS VALUES (NULL, 4, '789 Fake Street', 'Sydney', 'NSW', 3333, 'Australia');

INSERT INTO DELIVERYADDRESS VALUES (NULL, 1, '123 Fake Street', 'Sydney', 'NSW', 0000, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, 2, '456 Fake Street', 'Gosford', 'NSW', 1111, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, 3, '789 Fake Street', 'Newcastle', 'NSW', 2222, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, 4, '789 Fake Street', 'Sydney', 'NSW', 3333, 'Australia');

INSERT INTO ORDER_STATUS VALUES (NULL, 'Requested');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Processing');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Shipped');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Completed');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Cancelled');

INSERT INTO SALES_ORDER VALUES (NULL, 1, NULL, '1750.00', '20.00', '1770.00', NULL, NULL, 1);

INSERT INTO ORDER_PRODUCT VALUES (NULL, 1, 2, 1, '750.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 1, 1, 1, '1000.00');