create database vgecw_db;
use vgecw_db;

create table CUSTOMER (
	CustomerID int(7) PRIMARY KEY AUTO_INCREMENT,
    LastName VarChar(40) NOT NULL,
    FirstName VarChar(40) NOT NULL,
    Salutation VarChar(5) NOT NULL,
    MailingList int(1) DEFAULT 0 NOT NULL,
    Email VarChar(60) UNIQUE NOT NULL,
    EncryptedPassword VarChar(256) NOT NULL,
    Salt INT NOT NULL,
    MobilePhone VarChar(15),
    HomePhone VarCHar(15),
    isDeleted int(1) DEFAULT 0 NOT NULL
)ENGINE=InnoDB;

create table HOMEADDRESS (
	HomeAddressID int(7) PRIMARY KEY AUTO_INCREMENT,
    CustomerFK int(7) NOT NULL,
    StreetAddress VarChar(50) NOT NULL,
    City VarChar(50) NOT NULL,
    State VarChar(50) NOT NULL,
    PostCode VarChar(4) NOT NULL,
    Country VarChar(15) NOT NULL,
    FOREIGN KEY (CustomerFK) REFERENCES CUSTOMER(CustomerID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=InnoDB;

create table ORDER_STATUS (
	OrderStatusID int(5) PRIMARY KEY AUTO_INCREMENT,
    Description VarChar(40) NOT NULL
)ENGINE=InnoDB;

create table DELIVERYADDRESS (
    DeliveryAddressID int(7) PRIMARY KEY AUTO_INCREMENT,
    StreetAddress VarChar(50) NOT NULL,
    City VarChar(50) NOT NULL,
    State VarChar(50) NOT NULL,
    PostCode VarChar(4) NOT NULL,
    Country VarChar(15) NOT NULL
)ENGINE=InnoDB;

create table SALES_ORDER (
	SalesOrderID int(7) PRIMARY KEY AUTO_INCREMENT,
    CustomerFK int(7) NOT NULL,
    DeliveryAddressFK int(7) NOT NULL,
    InvoiceDate DATE,
    SubTotal DECIMAL(6,2) NOT NULL,
    Shipping DECIMAL(6,2) NOT NULL,
    Total Decimal(6,2) NOT NULL,
    ShippedDate DATE,
    ShippingRecord VarChar(50),
    OrderStatusFK int(2) NOT NULL,
    FOREIGN KEY (CustomerFK) REFERENCES CUSTOMER(CustomerID),
    FOREIGN KEY (OrderStatusFK) REFERENCES ORDER_STATUS(OrderStatusID),
    FOREIGN KEY (DeliveryAddressFK) REFERENCES DELIVERYADDRESS(DeliveryAddressID)
)ENGINE=InnoDB;



create table BRAND (
	BrandID int(4) PRIMARY KEY AUTO_INCREMENT,
    BrandName VarChar(20) NOT NULL
)ENGINE=InnoDB;

create table CLASSIFICATION (
	ClassificationID int(4) PRIMARY KEY AUTO_INCREMENT,
    Type VarChar(30) NOT NULL,
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
    EncryptedPassword VarChar(256) NOT NULL,
    Salt INT NOT NULL
)ENGINE=InnoDB;

create table PRODUCT (
	ProductID int(7) PRIMARY KEY AUTO_INCREMENT,
    ClassificationFK int(3) NOT NULL,
    BrandFK int(4) NOT NULL,
    Quantity int(3) NOT NULL,
    StatusFK int(3) NOT NULL,
    Description TEXT NOT NULL,
    AppearenceFK int(3) NOT NULL,
    UnitPrice DECIMAL(6,2) NOT NULL,
    CaseTypeFK int(3) NOT NULL,
    ModelFK int(5) NOT NULL,
    CreatedByFK int(4) NOT NULL,
    ModifiedByFK int(4) NOT NULL,
    CreationDate DATE NOT NULL,
    ModifiedDate DATE,
    PrimaryPicturePath VarChar(200) NULL,
    isDeleted int(1) DEFAULT 0 NOT NULL,
    FOREIGN KEY (AppearenceFK) REFERENCES APPEARENCE(AppearenceID),
    FOREIGN KEY (ClassificationFK) REFERENCES CLASSIFICATION(ClassificationID),
    FOREIGN KEY (BrandFK) REFERENCES BRAND(BrandID),
    FOREIGN KEY (StatusFK) REFERENCES PRODUCT_STATUS(ProductStatusID),
    FOREIGN KEY (CaseTypeFK) REFERENCES CASE_TYPE(CaseTypeID),
    FOREIGN KEY (ModelFK) REFERENCES MODEL(ModelID),
    FOREIGN KEY (CreatedByFK) REFERENCES ADMINISTRATOR(AdministratorID),
    FOREIGN KEY (ModifiedByFK) REFERENCES ADMINISTRATOR(AdministratorID)
)ENGINE=InnoDB;

create table ORDER_PRODUCT (
	OrderProductID int(4) PRIMARY KEY AUTO_INCREMENT,
    SalesOrderFK int(7) NOT NULL,
    ProductFK int(7) NOT NULL,
    UnitPrice DECIMAL(6,2),
    UnitShipping DECIMAL(6,2),
    Quantity int(4) NOT NULL,
    Total DECIMAL(6,2) NOT NULL,
    FOREIGN KEY (SalesOrderFK) REFERENCES SALES_ORDER(SalesOrderID),
    FOREIGN KEY (ProductFK) REFERENCES PRODUCT(ProductID)
)ENGINE=InnoDB;

create table PICTURE (
	PictureID int(4) PRIMARY KEY AUTO_INCREMENT,
    ProductFK int(7) NOT NULL,
    ImagePath VarChar(100) NOT NULL,
    FOREIGN KEY (ProductFK) REFERENCES PRODUCT(ProductID)
)ENGINE=InnoDB;

CREATE TABLE CONTACT_US (
  `ID` int(7) PRIMARY KEY,
  `blurb_path` varchar(60) DEFAULT NULL,
  `contact_email` varchar(60) DEFAULT NULL,
  `contact_telephone` varchar(15) DEFAULT NULL,
  `contact_address_line_1` varchar(50) DEFAULT NULL,
  `contact_address_line_2` varchar(50) DEFAULT NULL,
  `contact_address_line_3` varchar(50) DEFAULT NULL,
  `facebook_url` varchar(100) DEFAULT NULL,
  `twitter_url` varchar(100) DEFAULT NULL,
  `youtube_url` varchar(100) DEFAULT NULL,
  `privacy_policy_path` varchar(60) DEFAULT NULL
) ENGINE=InnoDB;

create table CART (
    ItemID int(4) PRIMARY KEY AUTO_INCREMENT,
    CustomerFK int(7) NOT NULL,
    ProductFK int(7) NOT NULL,
    Quantity int(4) NOT NULL,
    FOREIGN KEY (CustomerFK) REFERENCES CUSTOMER(CustomerID),
    FOREIGN KEY (ProductFK) REFERENCES PRODUCT(ProductID)
)ENGINE=InnoDB;

INSERT INTO CONTACT_US (`ID`, `blurb_path`, `contact_email`, `contact_telephone`, `contact_address_line_1`, `contact_address_line_2`, `contact_address_line_3`, `facebook_url`, `twitter_url`, `youtube_url`, `privacy_policy_path`) VALUES
(1, 'includes/contact_us_blurb.html', 'sales@virginguitars.com', '02 66 901 56', 'Virgin Guitars,', '26 Music Lane,', 'Lismore, NSW. 2480.', 'http://facebook.com/', 'http://twitter.com/', 'http://youtube.com/', 'includes/privacy_policy_blurb.html');

INSERT INTO CLASSIFICATION VALUES (NULL, 'Acoustic Guitar', 6);
INSERT INTO CLASSIFICATION VALUES (NULL, 'Electric Guitar', 6);
INSERT INTO CLASSIFICATION VALUES (NULL, '7 String Electric Guitar', 7);
INSERT INTO CLASSIFICATION VALUES (NULL, '4 String Bass', 4);
INSERT INTO CLASSIFICATION VALUES (NULL, '5 String Bass', 5);

INSERT INTO BRAND VALUES (NULL, 'Fender');
INSERT INTO BRAND VALUES (NULL, 'ESP');
INSERT INTO BRAND VALUES (NULL, 'Gibson');
INSERT INTO BRAND VALUES (NULL, 'Ibanez');
INSERT INTO BRAND VALUES (NULL, 'Epiphone');
INSERT INTO BRAND VALUES (NULL, 'Jackson');
INSERT INTO BRAND VALUES (NULL, 'B.C. Rich');
INSERT INTO BRAND VALUES (NULL, 'Schecter');

INSERT INTO APPEARENCE VALUES (NULL, 'Brand New');
INSERT INTO APPEARENCE VALUES (NULL, 'New: Never Used');
INSERT INTO APPEARENCE VALUES (NULL, 'Refurbished');
INSERT INTO APPEARENCE VALUES (NULL, 'Used');

INSERT INTO CASE_TYPE VALUES (NULL, 'Hard case');
INSERT INTO CASE_TYPE VALUES (NULL, 'Soft case');

INSERT INTO MODEL VALUES (NULL, 'American Standard Stratocaster', 2016);
INSERT INTO MODEL VALUES (NULL, 'Fender Squier MIJ Stratocaster', 0000);
INSERT INTO MODEL VALUES (NULL, 'Gibson Epiphone Limited Edition Les Paul Custom', 2008);
INSERT INTO MODEL VALUES (NULL, 'Gibson Les Paul Studio', 2014);
INSERT INTO MODEL VALUES (NULL, 'B.C. Rich Kerry King Metal Master Tribal Fire Warlock', 0000);
INSERT INTO MODEL VALUES (NULL, 'B.C. Rich Mockingbird Pro X', 0000);
INSERT INTO MODEL VALUES (NULL, 'B.C. Rich Mocking Bird ST', 0000);
INSERT INTO MODEL VALUES (NULL, 'Jackson DK2 Dinky Hot Rod Flames', 0000);
INSERT INTO MODEL VALUES (NULL, 'Jackson KVMG Pro Series King V', 0000);
INSERT INTO MODEL VALUES (NULL, 'Jackson PDX-2 Demmelition King V', 0000);
INSERT INTO MODEL VALUES (NULL, 'Les Paul Fort Knox', 0000);
INSERT INTO MODEL VALUES (NULL, 'Les Paul Redwood', 0000);
INSERT INTO MODEL VALUES (NULL, 'JS2410', 0000);
INSERT INTO MODEL VALUES (NULL, 'RG421EX', 0000);
INSERT INTO MODEL VALUES (NULL, 'RG350DXZ', 0000);
INSERT INTO MODEL VALUES (NULL, 'UV77SVR', 0000);
INSERT INTO MODEL VALUES (NULL, 'PRO-1 Classic Acoustic', 0000);
INSERT INTO MODEL VALUES (NULL, 'Les Paul Express', 0000);
INSERT INTO MODEL VALUES (NULL, 'DR-100', 0000);
INSERT INTO MODEL VALUES (NULL, 'AJ-100CE', 0000);
INSERT INTO MODEL VALUES (NULL, 'Pro Series King V', 0000);
INSERT INTO MODEL VALUES (NULL, 'X Series Signature KVXMG King V', 0000);
INSERT INTO MODEL VALUES (NULL, 'X Series SOLOIST', 0000);
INSERT INTO MODEL VALUES (NULL, 'JS Series Dinky', 0000);
INSERT INTO MODEL VALUES (NULL, 'MK5 Warlock', 0000);
INSERT INTO MODEL VALUES (NULL, 'MK9 Mockingbird', 0000);
INSERT INTO MODEL VALUES (NULL, 'MK3 Mockingbird Bass', 0000);
INSERT INTO MODEL VALUES (NULL, 'MK3 Jr V', 0000);
INSERT INTO MODEL VALUES (NULL, 'C-1 FR', 0000);
INSERT INTO MODEL VALUES (NULL, 'Avenger FR SGR', 0000);
INSERT INTO MODEL VALUES (NULL, 'Blackjack ATX C-7', 0000);
INSERT INTO MODEL VALUES (NULL, '006 SGR', 0000);

INSERT INTO PRODUCT_STATUS VALUES (NULL, 'In Stock');
INSERT INTO PRODUCT_STATUS VALUES (NULL, 'Out Of Stock');
INSERT INTO PRODUCT_STATUS VALUES (NULL, 'Backorder');

INSERT INTO ADMINISTRATOR VALUES (NULL, 'admin', 'd23c1038532dc71d0a60a7fb3d330d7606b7520e9e5ee0ddcdb27ee1bd5bc0cd', '22');
INSERT INTO ADMINISTRATOR VALUES (NULL, 'zerox', '2efe70f52e3b1d8dbc8b5325cf96e16d1cfbdb3dbb56cfd9dab51c735b0266fc', '34');

INSERT INTO PRODUCT VALUES (NULL, 2, 1, 4, 1, 'Gorgeous sounding 2006 American Standard Stratocaster. It has a very comfortable feel and the pickups sound stellar. This guitar features a few upgraded parts including a Callaham bridge and Sperzel tuners; both of which help with intonation and overall sustain. On top of all of that, the guitar is in great overall shape!', 1, '802.27', 1, 1, 1, 1, CURDATE(), CURDATE(), 'images/guitars/fenderAmericanStandardStratocaster/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 1, 5, 2, 'This guitar comes from a unique and underrated part of Fenders history where surprisingly good quality guitars were leaving the Japanese factory stamped with the Squier name. Modern players are continuing to notice the exceptional bang-for-the-buck quality of these guitars, which look, play, and sound like their Fender counterparts. This guitar has a distinct vintage vibe between the slight tint the neck has sustained from graceful aging, the light overall wear, and the classic pickups. In addition, this guitar is in fantastic shape for its age and still plays like champ.', 1, '789.00', 2, 2, 1, 1, CURDATE(), CURDATE(), 'images/guitars/fenderSquireMijStratocaster/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 3, 1, 3, 'Specifications', 1, '635.25', 2, 3, 1, 1, CURDATE(), CURDATE(), 'images/guitars/gibsonEpiphoneLimitedEditionLesPaulCustom/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 3, 2, 1, 'Specifications', 1, '731.86', 1, 4, 1, 1, CURDATE(), CURDATE(), 'images/guitars/gibsonLesPaultStudio/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 7, 2, 2, 'Specifications', 1, '420.00', 1, 5, 1, 1, CURDATE(), CURDATE(), 'images/guitars/bcRichKerryKingMetalMasterTribalFireWarlock/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 7, 2, 3, 'Specifications', 1, '950.00', 1, 6, 1, 1, CURDATE(), CURDATE(), 'images/guitars/bcRichMockingBirdProX/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 7, 4, 1, 'Specifications', 1, '888.00', 1, 7, 1, 1, CURDATE(), CURDATE(), 'images/guitars/bcRichMockingbirdSt/1.png', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 6, 4, 2, 'Specifications', 1, '1001.00', 1, 8, 1, 1, CURDATE(), CURDATE(), 'images/guitars/jacksonDk2DinkyHotRodFlames/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 6, 4, 3, 'Specifications', 1, '1200.00', 2, 9, 1, 1, CURDATE(), CURDATE(), 'images/guitars/jacksonKvmgProSeriesKingV/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 6, 6, 1, 'Specifications', 1, '600.00', 1, 10, 1, 1, CURDATE(), CURDATE(), 'images/guitars/jacksonPdx2DemmelitionKingV/1.jpg', 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 3, 3, 2, 'Specifications', 1, '3250.00', 1, 11, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 3, 1, 3, 'Specifications', 1, '3999.00', 2, 12, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 4, 1, 1, 'Specifications', 1, '1500.00', 2, 13, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 4, 4, 2, 'Specifications', 1, '1990.00', 2, 14, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 4, 3, 3, 'Specifications', 1, '1990.00', 1, 15, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 3, 4, 3, 1, 'Specifications', 1, '1990.00', 1, 16, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 1, 5, 3, 2, 'Specifications', 1, '1990.00', 1, 17, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 5, 2, 3, 'Specifications', 1, '1990.00', 1, 18, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 5, 1, 1, 'Specifications', 1, '1550.00', 2, 19, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 5, 4, 2, 'Specifications', 1, '1559.00', 1, 20, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 6, 5, 3, 'Specifications', 1, '1670.00', 1, 21, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 6, 6, 1, 'Specifications', 1, '1115.00', 2, 22, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 6, 6, 2, 'Specifications', 1, '1700.00', 1, 23, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 6, 4, 3, 'Specifications', 1, '1720.00', 1, 24, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 7, 3, 1, 'Specifications', 1, '1740.00', 1, 25, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 7, 4, 2, 'Specifications', 1, '1000.00', 2, 26, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 7, 2, 3, 'Specifications', 1, '1200.00', 2, 27, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 7, 2, 1, 'Specifications', 1, '1899.00', 2, 28, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 8, 3, 2, 'Specifications', 1, '1990.00', 2, 29, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 8, 1, 3, 'Specifications', 1, '1525.00', 2, 30, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 8, 4, 1, 'Specifications', 1, '2599.50', 1, 31, 1, 1, CURDATE(), CURDATE(), NULL, 0);
INSERT INTO PRODUCT VALUES (NULL, 2, 8, 5, 2, 'Specifications', 1, '2110.00', 2, 32, 1, 1, CURDATE(), CURDATE(), NULL, 0);

INSERT INTO CUSTOMER VALUES (NULL, 'Morrison', 'Ben', '', 1, 'ben@mail.com', 'd46b5cd9c1456e3059258a411faf8bbb0253c190cc5acb488f999e1b1421f83b', 12, '0000111222', '11112222', DEFAULT);
INSERT INTO CUSTOMER VALUES (NULL, 'Hogan', 'Dale', '', 0, 'dale@mail.com', 'f55d74e275c773678f3750573bcd70b14d44e082045e227e5c1d571dccfab624', 665, '1111222333', '22223333', DEFAULT);
INSERT INTO CUSTOMER VALUES (NULL, 'Norris', 'Warren', '', 1, 'warren@mail.com', 'acec2d49992381a162de7b6b66ce9cbd3d3336de55abcc0cb3350b3335575f9c', 928, '2222333444', '33334444', DEFAULT);
INSERT INTO CUSTOMER VALUES (NULL, 'Browne', 'Dominic', '', 0, 'dominic@mail.com', 'cf3f90f70affced11fe6236c20b879447b54fe5779a8225d061a9b7c9b948fd3', 923, '3333444555', '44445555', DEFAULT);

INSERT INTO HOMEADDRESS VALUES (NULL, 1, '123 Fake Street', 'Sydney', 'NSW', 0000, 'Australia');
INSERT INTO HOMEADDRESS VALUES (NULL, 2, '456 Fake Street', 'Gosford', 'NSW', 1111, 'Australia');
INSERT INTO HOMEADDRESS VALUES (NULL, 3, '789 Fake Street', 'Newcastle', 'NSW', 2222, 'Australia');
INSERT INTO HOMEADDRESS VALUES (NULL, 4, '789 Fake Street', 'Sydney', 'NSW', 3333, 'Australia');

INSERT INTO DELIVERYADDRESS VALUES (NULL, '123 Fake Street', 'Sydney', 'NSW', 0000, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, '456 Fake Street', 'Gosford', 'NSW', 1111, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, '789 Fake Street', 'Newcastle', 'NSW', 2222, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, '789 Fake Street', 'Sydney', 'NSW', 3333, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, '334 Big Creek Rd', 'Gold Coast', 'QLD', 4142, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, '674 Small Town Road', 'Small Town', 'NSW', 1234, 'Australia');
INSERT INTO DELIVERYADDRESS VALUES (NULL, '888 Fell Wood Road', 'Fell Wood', 'KLM', 1337, 'Azeroth');
INSERT INTO DELIVERYADDRESS VALUES (NULL, '46461 Beat Nick Road', 'Sydney', 'NSW', 2000, 'Australia');

INSERT INTO ORDER_STATUS VALUES (NULL, 'Requested');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Processing');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Shipped');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Completed');
INSERT INTO ORDER_STATUS VALUES (NULL, 'Cancelled');

INSERT INTO SALES_ORDER VALUES (NULL, 1, 1, CURDATE(), '2380.27', '150.00', '2530.27', NULL, NULL, 1);
INSERT INTO SALES_ORDER VALUES (NULL, 1, 2, CURDATE(), '2830.83', '200.00', '3030.83', NULL, NULL, 2);
INSERT INTO SALES_ORDER VALUES (NULL, 2, 3, CURDATE(), '1370.00', '100.00', '1470.00', NULL, NULL, 1);
INSERT INTO SALES_ORDER VALUES (NULL, 2, 4, CURDATE(), '1889.00', '100.00', '1989.00', NULL, NULL, 2);
INSERT INTO SALES_ORDER VALUES (NULL, 3, 5, CURDATE(), '1800.00', '100.00', '1900.00', NULL, NULL, 1);
INSERT INTO SALES_ORDER VALUES (NULL, 3, 6, CURDATE(), '1750.00', '20.00', '1770.00', NULL, NULL, 2);
INSERT INTO SALES_ORDER VALUES (NULL, 4, 7, CURDATE(), '1750.00', '20.00', '1770.00', NULL, NULL, 1);
INSERT INTO SALES_ORDER VALUES (NULL, 4, 8, CURDATE(), '1750.00', '20.00', '1770.00', NULL, NULL, 2);

INSERT INTO ORDER_PRODUCT VALUES (NULL, 1, 1, '802.27', '50', 1, '852.27');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 1, 2, '789.00', '50', 2, '1678');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 2, 3, '635.25', '50', 1, '685.25');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 2, 4, '731.86', '50', 3, '2345.58');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 3, 5, '420.00', '50', 1, '470.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 3, 6, '950.00', '50', 1, '1000.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 4, 7, '888.00', '50', 1, '938.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 4, 8, '1001.00', '50', 1, '1051.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 5, 9, '1200.00', '50', 1, '1250.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 5, 10, '600.00', '50', 1, '650.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 6, 11, '700.00', '50', 1, '750.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 6, 12, '700.00', '50', 1, '750.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 7, 13, '700.00', '50', 1, '750.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 7, 14, '700.00', '50', 1, '750.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 8, 15, '700.00', '50', 1, '750.00');
INSERT INTO ORDER_PRODUCT VALUES (NULL, 8, 16, '700.00', '50', 1, '750.00');

# Product 1 images
INSERT INTO PICTURE VALUES (NULL, 1, 'images/guitars/1/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 1, 'images/guitars/1/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 1, 'images/guitars/1/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 1, 'images/guitars/1/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 1, 'images/guitars/1/5.jpg');

# Product 2 images
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/5.jpg');
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/6.jpg');
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/7.jpg');
INSERT INTO PICTURE VALUES (NULL, 2, 'images/guitars/2/8.jpg');

# Product 3 images
INSERT INTO PICTURE VALUES (NULL, 3, 'images/guitars/3/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 3, 'images/guitars/3/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 3, 'images/guitars/3/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 3, 'images/guitars/3/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 3, 'images/guitars/3/5.jpg');
INSERT INTO PICTURE VALUES (NULL, 3, 'images/guitars/3/6.jpg');
INSERT INTO PICTURE VALUES (NULL, 3, 'images/guitars/3/7.jpg');

# Product 4 images
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/5.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/6.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/7.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/8.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/9.jpg');
INSERT INTO PICTURE VALUES (NULL, 4, 'images/guitars/4/10.jpg');

# Product 5 images
INSERT INTO PICTURE VALUES (NULL, 5, 'images/guitars/5/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 5, 'images/guitars/5/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 5, 'images/guitars/5/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 5, 'images/guitars/5/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 5, 'images/guitars/5/5.jpg');
INSERT INTO PICTURE VALUES (NULL, 5, 'images/guitars/5/6.jpg');
INSERT INTO PICTURE VALUES (NULL, 5, 'images/guitars/5/7.jpg');

# Product 6 images
INSERT INTO PICTURE VALUES (NULL, 6, 'images/guitars/6/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 6, 'images/guitars/6/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 6, 'images/guitars/6/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 6, 'images/guitars/6/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 6, 'images/guitars/6/5.jpg');
INSERT INTO PICTURE VALUES (NULL, 6, 'images/guitars/6/6.jpg');

# Product 7 images
INSERT INTO PICTURE VALUES (NULL, 7, 'images/guitars/7/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 7, 'images/guitars/7/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 7, 'images/guitars/7/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 7, 'images/guitars/7/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 7, 'images/guitars/7/5.jpg');

# Product 8 images
INSERT INTO PICTURE VALUES (NULL, 9, 'images/guitars/9/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 9, 'images/guitars/9/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 9, 'images/guitars/9/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 9, 'images/guitars/9/4.jpg');

# Product 9 images
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/5.jpg');
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/6.jpg');
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/7.jpg');
INSERT INTO PICTURE VALUES (NULL, 8, 'images/guitars/8/8.jpg');

# Product 10 images
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/1.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/2.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/3.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/4.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/5.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/6.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/7.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/8.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/9.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/10.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/11.jpg');
INSERT INTO PICTURE VALUES (NULL, 10, 'images/guitars/10/12.jpg');

# Views #

# This Query Reutrns a list of all Customers, their details and number of open and closed orders.
# For use in displaying a list of customers in the Administration panel
CREATE VIEW CUSTOMERS_AND_ORDERS_VIEW AS
SELECT CustomerID, FirstName, LastName, Email, COUNT(SALES_ORDER.CustomerFK) as 'All Orders', SUM(case when ORDER_STATUS.Description = 'Requested' then 1 else 0 end) as 'New Orders', isDeleted
FROM CUSTOMER
LEFT JOIN SALES_ORDER ON SALES_ORDER.CustomerFK = CustomerID
LEFT JOIN ORDER_STATUS ON ORDER_STATUS.OrderStatusID = SALES_ORDER.OrderStatusFK
GROUP BY CustomerID;

# This view gets each order and joins the order status description
CREATE VIEW ORDERS_STATUS AS
SELECT SalesOrderID, CustomerFK, InvoiceDate, SubTotal, Shipping, Total, ShippedDate, ShippingRecord, ORDER_STATUS.Description As 'Order Status'
FROM SALES_ORDER
JOIN ORDER_STATUS ON ORDER_STATUS.OrderStatusID = SALES_ORDER.OrderStatusFK;

# This view returns the delivery address of each order
CREATE VIEW DELIVERY_ADDRESS_BY_ORDER_ID AS
SELECT SALES_ORDER.SalesOrderID, DELIVERYADDRESS.StreetAddress, DELIVERYADDRESS.City, DELIVERYADDRESS.State, DELIVERYADDRESS.PostCode, DELIVERYADDRESS.Country
FROM SALES_ORDER
LEFT JOIN DELIVERYADDRESS ON DELIVERYADDRESS.DeliveryAddressID = SALES_ORDER.DeliveryAddressFK;

# This view returns a list of PRODUCTs by their orders
# CREATE VIEW PRODUCTS_BY_ORDER_VIEW AS
# SELECT ORDER_PRODUCT.SalesOrderFK, PRODUCT.PrimaryPicturePath, MODEL.Description, PRODUCT.ProductID, ORDER_PRODUCT.Quantity, ORDER_PRODUCT.UnitPrice, ORDER_PRODUCT.UnitShipping, (ORDER_PRODUCT.UnitPrice*ORDER_PRODUCT.Quantity) As 'SubTotal', (ORDER_PRODUCT.UnitShipping*ORDER_PRODUCT.Quantity) As 'TotalShipping', ORDER_PRODUCT.Total
# FROM ORDER_PRODUCT
# LEFT JOIN PRODUCT ON ORDER_PRODUCT.OrderProductID = PRODUCT.ProductID
# LEFT JOIN MODEL ON MODEL.ModelID = PRODUCT.ModelFK;

# This view returns a list of PRODUCTs by their orders (includes CustomerID)
CREATE VIEW PRODUCTS_BY_ORDER_VIEW AS
SELECT SALES_ORDER.CustomerFK, ORDER_PRODUCT.SalesOrderFK, PRODUCT.PrimaryPicturePath, MODEL.Description, PRODUCT.ProductID, ORDER_PRODUCT.Quantity, ORDER_PRODUCT.UnitPrice, ORDER_PRODUCT.UnitShipping, (ORDER_PRODUCT.UnitPrice*ORDER_PRODUCT.Quantity) As 'SubTotal', (ORDER_PRODUCT.UnitShipping*ORDER_PRODUCT.Quantity) As 'TotalShipping', ORDER_PRODUCT.Total
FROM ORDER_PRODUCT
JOIN SALES_ORDER ON ORDER_PRODUCT.SalesOrderFK = SALES_ORDER.SalesOrderID
LEFT JOIN PRODUCT ON ORDER_PRODUCT.ProductFK = PRODUCT.ProductID
LEFT JOIN MODEL ON MODEL.ModelID = PRODUCT.ModelFK;

# This view returns a list of products for the manage stock page
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
p.UnitPrice As 'Price',
p.isDeleted
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

# This view returns products in their cart
CREATE VIEW CART_VIEW AS
SELECT CART.CustomerFK, PRODUCT.PrimaryPicturePath, MODEL.Description, PRODUCT.ProductID, CART.Quantity, PRODUCT.UnitPrice As Price, (CART.Quantity*PRODUCT.UnitPrice) As 'Total', PRODUCT.isDeleted, PRODUCT_STATUS.Description As 'Status'
FROM PRODUCT
JOIN CART on CART.ProductFK = PRODUCT.ProductID
JOIN MODEL on MODEL.ModelID = PRODUCT.ModelFK
JOIN PRODUCT_STATUS on PRODUCT.StatusFK = PRODUCT_STATUS.ProductStatusID;