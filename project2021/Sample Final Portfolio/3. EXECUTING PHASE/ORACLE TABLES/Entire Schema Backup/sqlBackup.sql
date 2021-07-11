DROP TABLE users CASCADE CONSTRAINTS;
DROP TABLE customers CASCADE CONSTRAINTS;
DROP TABLE traders CASCADE CONSTRAINTS;
DROP TABLE admin CASCADE CONSTRAINTS;
DROP TABLE shops CASCADE CONSTRAINTS;
DROP TABLE offers CASCADE CONSTRAINTS;
DROP TABLE products CASCADE CONSTRAINTS;
DROP TABLE reviews CASCADE CONSTRAINTS;
DROP TABLE collection_slots CASCADE CONSTRAINTS;
DROP TABLE baskets CASCADE CONSTRAINTS;
DROP TABLE basket_products CASCADE CONSTRAINTS;
DROP TABLE orders CASCADE CONSTRAINTS;




----------------------------------------------------------------------------------------------------
----------------------------------------------tables---------------------------------------------
----------------------------------------------------------------------------------------------------

-- Create a Database table to represent the "users" entity.
CREATE TABLE users(
	user_id	INTEGER PRIMARY KEY,
	first_name	VARCHAR2(50) NOT NULL,
	last_name	VARCHAR2(50) NOT NULL,
	address	VARCHAR2(50) NOT NULL,
	email	VARCHAR2(50) NOT NULL UNIQUE,
    phone_number INTEGER NOT NULL UNIQUE,
	password	VARCHAR2(255) NOT NULL,
    profile_img VARCHAR(100),
    token VARCHAR2(255),
    status INTEGER,
    permissions VARCHAR2(40),
    ADMIN_ACCESS VARCHAR(10)
);

CREATE TABLE customers(
	user_id	INTEGER NOT NULL,
	customer_id	INTEGER NOT NULL UNIQUE,
	CONSTRAINT	pk_customers PRIMARY KEY (user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE traders(
	user_id	INTEGER NOT NULL,
	trader_id	INTEGER NOT NULL UNIQUE,
    trader_type VARCHAR2(32) NOT NULL UNIQUE,
	CONSTRAINT	pk_trader PRIMARY KEY (user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE admin(
	user_id	INTEGER NOT NULL,
	admin_id	INTEGER NOT NULL UNIQUE,
	CONSTRAINT	pk_admin PRIMARY KEY (user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
);

-- Create a Database table to represent the "shop" entity.
CREATE TABLE shops(
	shop_id	INTEGER NOT NULL,
	shop_name	VARCHAR2(50) NOT NULL UNIQUE,
    product_category VARCHAR2(50) NOT NULL UNIQUE,
	fk_trader_id INTEGER NOT NULL UNIQUE,
	CONSTRAINT	pk_shop PRIMARY KEY (shop_id),
    FOREIGN KEY(fk_trader_id) REFERENCES traders(trader_id)
);


-- Create a Database table to represent the "Offer" entity.
CREATE TABLE offers(
	offer_id	INTEGER NOT NULL,
	percentage	INTEGER NOT NULL,
	description	VARCHAR2(500) NOT NULL,
    fk_trader_id INTEGER NOT NULL,
	CONSTRAINT	pk_offer PRIMARY KEY (offer_id),
    FOREIGN KEY(fk_trader_id) REFERENCES traders(trader_id)
);

-- Create a Database table to represent the "Product" entity.
CREATE TABLE products(
	product_id	INTEGER NOT NULL,
	product_name VARCHAR2(150) NOT NULL,
    item_price NUMBER(6,2) NOT NULL,
    quantity_in_stock INTEGER NOT NULL,
	availablility INTEGER NOT NULL,
	min_order INTEGER NOT NULL,
	max_order INTEGER NOT NULL,
	allergy_info VARCHAR2(1000),
    product_info VARCHAR2(600) NOT NULL,
	product_image VARCHAR2(255),
    status INTEGER NOT NULL,
	fk_shop_id	INTEGER NOT NULL,
	fk_offer_id	INTEGER,
	CONSTRAINT	pk_product PRIMARY KEY (product_id),
    FOREIGN KEY(fk_shop_id) REFERENCES shops(shop_id),
    FOREIGN KEY(fk_offer_id) REFERENCES offers(offer_id)
);


-- Create a Database table to represent the "review" entity.
 CREATE TABLE reviews(
	review_id	INTEGER NOT NULL,
	review_rating	INTEGER,
	review_comment	VARCHAR2(1000),
    fk1_product_id	INTEGER NOT NULL,
	fk2_user_id	INTEGER NOT NULL,
	CONSTRAINT	pk_review PRIMARY KEY (review_id),
    FOREIGN KEY(fk1_product_id) REFERENCES products(product_id),
    FOREIGN KEY(fk2_user_id) REFERENCES users(user_id)
);

-- Create a Database table to represent the "collection_slot" entity.
CREATE TABLE collection_slots(
	collection_slot_id	INTEGER NOT NULL,
	collection_time VARCHAR2(100) NOT NULL,
	collection_day VARCHAR2(20) NOT NULL,
	CONSTRAINT	pk_collection_slot PRIMARY KEY (collection_slot_id)
);

-- Create a Database table to represent the "basket" entity.
CREATE TABLE baskets(
	basket_id INTEGER NOT NULL,
	total_sum NUMBER(6,2),
	fk_customer_id INTEGER NOT NULL,
    token VARCHAR2(255) NOT NULL,
	CONSTRAINT	pk_basket_id PRIMARY KEY (basket_id),
    FOREIGN KEY(fk_customer_id) REFERENCES customers(customer_id)
);

-- Create a Database table to represent the "order_products" entity.
CREATE TABLE basket_products(
    fk_product_id	INTEGER NOT NULL,
	fk_basket_id	INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    FOREIGN KEY(fk_product_id) REFERENCES products(product_id),
	FOREIGN KEY(fk_basket_id) REFERENCES baskets(basket_id)
);

-- Create a Database table to represent the "orders" entity.
CREATE TABLE orders(
	order_id	INTEGER NOT NULL,
    payment_date DATE NOT NULL,
    order_status VARCHAR2(20),
    fk_basket_id INTEGER NOT NULL,
    fk_collection_slot_id INTEGER NOT NULL,
    CONSTRAINT	pk_orders PRIMARY KEY (order_id),
    FOREIGN KEY(fk_basket_id) REFERENCES baskets(basket_id),
    FOREIGN KEY(fk_collection_slot_id) REFERENCES collection_slots(collection_slot_id)
);




----------------------------------------------------------------------------------------------------
----------------------------------------------sequences---------------------------------------------
----------------------------------------------------------------------------------------------------
DROP SEQUENCE users_seq;
DROP SEQUENCE customers_seq;
DROP SEQUENCE traders_seq;
DROP SEQUENCE admin_seq;
DROP SEQUENCE baskets_seq;
DROP SEQUENCE orders_seq;
DROP SEQUENCE reviews_seq;
DROP SEQUENCE products_seq;
DROP SEQUENCE shops_seq;
DROP SEQUENCE payments_seq;
DROP SEQUENCE collection_slots_seq;
DROP SEQUENCE offers_seq;
DROP SEQUENCE invoices_seq;

CREATE SEQUENCE users_seq
    START WITH 10
    INCREMENT BY 1;
    
CREATE SEQUENCE customers_seq
    START WITH 20
    INCREMENT BY 1;

CREATE SEQUENCE traders_seq
    START WITH 30
    INCREMENT BY 1;

CREATE SEQUENCE admin_seq
    START WITH 40
    INCREMENT BY 1;

CREATE SEQUENCE orders_seq
    START WITH 50
    INCREMENT BY 1;

CREATE SEQUENCE reviews_seq
    START WITH 60
    INCREMENT BY 1;

CREATE SEQUENCE products_seq
    START WITH 70
    INCREMENT BY 1;

CREATE SEQUENCE shops_seq
    START WITH 80
    INCREMENT BY 1;

CREATE SEQUENCE payments_seq
    START WITH 90
    INCREMENT BY 1;

CREATE SEQUENCE collection_slots_seq
    START WITH 110
    INCREMENT BY 1;

CREATE SEQUENCE offers_seq
    START WITH 120
    INCREMENT BY 1;

CREATE SEQUENCE baskets_seq
    START WITH 130
    INCREMENT BY 1;
    
CREATE SEQUENCE invoices_seq
    START WITH 140
    INCREMENT BY 1;
    
    

    
    
    
----------------------------------------------------------------------------------------------------
----------------------------------------------triggers----------------------------------------------
----------------------------------------------------------------------------------------------------
CREATE OR REPLACE TRIGGER insert_into_users_id
    BEFORE INSERT
    ON users
    FOR EACH ROW
    WHEN (NEW.user_id IS NULL)
BEGIN
    :NEW.user_id := users_seq.NEXTVAL;
END;
/

CREATE OR REPLACE TRIGGER insert_into_customer_id
    BEFORE INSERT
    ON customers
    FOR EACH ROW
    WHEN (NEW.customer_id IS NULL)
BEGIN
    :NEW.customer_id := customers_seq.NEXTVAL;
END;
/

CREATE OR REPLACE TRIGGER insert_into_trader_id
    BEFORE INSERT
    ON traders
    FOR EACH ROW
    WHEN (NEW.trader_id IS NULL)
BEGIN
    :NEW.trader_id := traders_seq.NEXTVAL;
END;
/

CREATE OR REPLACE TRIGGER insert_into_admin_id
    BEFORE INSERT
    ON admin
    FOR EACH ROW
    WHEN (NEW.admin_id IS NULL)
BEGIN
    :NEW.admin_id := admin_seq.NEXTVAL;
END;
/

CREATE OR REPLACE TRIGGER insert_into_orders_id
    BEFORE INSERT
    ON orders
    FOR EACH ROW
    WHEN (NEW.order_id IS NULL)
BEGIN
    :NEW.order_id := orders_seq.NEXTVAL;
END;
/

CREATE OR REPLACE TRIGGER insert_into_basket_id
    BEFORE INSERT
    ON baskets
    FOR EACH ROW
    WHEN (NEW.basket_id IS NULL)
BEGIN
    :NEW.basket_id := baskets_seq.NEXTVAL;
END;
/

CREATE OR REPLACE TRIGGER insert_into_review_id
    BEFORE INSERT
    ON reviews
    FOR EACH ROW
    WHEN (NEW.review_id IS NULL)
BEGIN
    :NEW.review_id := reviews_seq.NEXTVAL;
END;
/


CREATE OR REPLACE TRIGGER insert_into_product_id
    BEFORE INSERT
    ON products
    FOR EACH ROW
    WHEN (NEW.product_id IS NULL)
BEGIN
    :NEW.product_id := products_seq.NEXTVAL;
END;
/


CREATE OR REPLACE TRIGGER insert_into_shop_id
    BEFORE INSERT
    ON shops
    FOR EACH ROW
    WHEN (NEW.shop_id IS NULL)
BEGIN
    :NEW.shop_id := shops_seq.NEXTVAL;
END;
/



CREATE OR REPLACE TRIGGER insert_into_collection_slot_id
    BEFORE INSERT
    ON collection_slots
    FOR EACH ROW
    WHEN (NEW.collection_slot_id IS NULL)
BEGIN
    :NEW.collection_slot_id := collection_slots_seq.NEXTVAL;
END;
/


CREATE OR REPLACE TRIGGER insert_into_offer_id
    BEFORE INSERT
    ON offers
    FOR EACH ROW
    WHEN (NEW.offer_id IS NULL)
BEGIN
    :NEW.offer_id := offers_seq.NEXTVAL;
END;
/

CREATE OR REPLACE TRIGGER insert_into_order_status
    BEFORE INSERT
    ON orders
    FOR EACH ROW
    WHEN (NEW.order_status IS NULL)
BEGIN
    :NEW.order_status := 'not delivered';
END;
/









----------------------------------------------------------------------------------------------------
-------------------------------------insert statements----------------------------------------------
----------------------------------------------------------------------------------------------------
-- users data
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'saugat', 'thapa', 'Npj-12, Banke Gaon','neplese931@gmail.com', 9840064535,  '9907da85c4dee8c7ca1aa4728151d933', '', null, 1, 'NEPLESE931@GMAIL.COM', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'rajesh', 'khapatari', 'Kathmandu', 'brajesh18@tbc.edu.np', 9840263535,  '9907da85c4dee8c7ca1aa4728151d933', '', null, 1, 'BRAJESH18@TBC.EDU.NP', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'gaurav', 'bhansali', 'Mahendranagar, Tinkune','bhansaligaurav2000@gmail.com', 9940063535,  '9907da85c4dee8c7ca1aa4728151d933', '', null, 1, 'BHANSALIGAURAV2000@GMAIL.COM', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'aakash', 'das', 'Npj-8, Bhrikutinagar','aakashpuchu@gmail.com', 9840033535,  '9907da85c4dee8c7ca1aa4728151d933', '', null, 1, 'AAKASHPUCHU@GMAIL.COM', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'harsh', 'gupta', 'Kathmandu', 'gharsh18@tbc.edu.np', 9840063545,  '9907da85c4dee8c7ca1aa4728151d933', '', null, 1, 'GHARSH18@TBC.EDU.NP', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'MAIN', 'ADMIN', 'NPJ-12, Banke Gaon','nfmadmin@gmail.com', 9820063535, '9907da85c4dee8c7ca1aa4728151d933', '', null, 1,'VILEROZE', 'VILEROZE');


-- trader data
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (10, null, 'greengrocer');
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (11, null, 'fishmonger');
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (12, null, 'delicatessen');
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (13, null, 'butcher');
INSERT INTO traders(USER_ID, TRADER_ID, trader_type) VALUES (14, null, 'bakery');


-- admin data
INSERT INTO admin (USER_ID, admin_id) VALUES (15, null);


-- shop data
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null, 'Fresh Thapa Shop','Fruits and Vegetables', 30);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null,  'Clean Basnet Shop','Fishes', 31);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null, 'Gaurav Bhansali Shop','Fresh Ready to eat Goods', 32);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null,  'Akash Puchu Shop','Fresh Meat', 33);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null, 'Suddha Gupta Shop', 'Bakery & Sweats ', 34);

-- collection slots
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '10am - 1pm', 'Wednesday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '1pm - 4pm', 'Wednesday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '4pm - 7pm', 'Wednesday');

INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '10am - 1pm', 'Thursday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '1pm - 4pm', 'Thursday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '4pm - 7pm', 'Thursday');

INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '10am - 1pm', 'Friday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '1pm - 4pm', 'Friday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '4pm - 7pm', 'Friday');

INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '10am - 1pm', 'Next Wednesday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '1pm - 4pm', 'Next Wednesday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '4pm - 7pm', 'Next Wednesday');

INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '10am - 1pm', 'Next Thursday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '1pm - 4pm', 'Next Thursday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '4pm - 7pm', 'Next Thursday');

INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '10am - 1pm', 'Next Friday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '1pm - 4pm', 'Next Friday');
INSERT INTO collection_slots (collection_slot_id, collection_time, collection_day) VALUES (null, '4pm - 7pm', 'Next Friday');


--fishmonger
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Cod Cheeks(290g)',8.50, 50, 1, 50, 100, 'For allergens, including cereals containing gluten, see ingredients in bold. May contain traces of crustaceans and molluscs', ' Cod cheek is a chef’s favourite, being boneless, skinless and firmer than the standard meat.', 'codcheeks.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, ' Luxury Fish Kebab Skewers(440g)    ',12.50, 60, 1, 50, 100, '  For allergens, including cereals containing gluten, please see ingredients in bold.May contain traces of crustaceans and molluscs.   ', ' These four skewers come loaded up with prime cuts of salmon, monkfish, gurnard and cod. ', 'fishkebab.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, '  Haddock Fillets (260g)  ',6.50, 55, 1, 50, 100, ' May contain traces of crustaceans & molluscs. Caution: Although every care has been taken to remove bones, some may remain   ', '    A fresh, flaky white fish, smaller than cod, with a slightly sweeter flavour.  ', 'haddockfillets.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, ' Hake Fillets Pack of 2 (260g)   ',6.95, 50, 1, 50, 100,' May contain traces of crustaceans and molluscs. Caution: Although every care has been taken to remove bones, some may remain  ', '  Great for a fish pie, hake’s firm, sweet, white meat makes it one of our best fish.  ', 'hakefillets.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, ' Large Salmon Tail, Organic farmed (600g)  ',25.50, 50, 1, 70, 100, '  May contain traces of crustaceans and molluscs.   ', ' This organic care and attention gives the salmon a rich flavour, and the crispy tail fin adds a true variety of textures and tastes to your fish suppers.    ', 'largesalmon.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, ' Salmon Steaks, Organic farmed (300g)   ',13.50, 50, 1, 50, 100, '  For allergens, including cereals containing gluten, please see ingredients in bold.   ', '  Stunning pair of organic Salmon Steaks, sustainably farmed by Celtic Coast Fish Co.   ', 'salmon.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, ' Salmon Fillets, Organic Farmed, Pack of 2 (260g)   ',9.75, 80, 1, 50, 100,'  Allergy advice: contains Fish. May contain traces of crustaceans and molluscs.   ', ' These delicious salmon fillets are grown organically in the cold waters of Ireland and Scotland.   ', 'salmonfillets.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  ' Smoked Whole Kipper, Wild, Severn & Wye Smokery (320g)  ',4.50, 90, 1, 50, 100, '  For allergens, including cereals containing gluten, see ingredients in bold.   ', ' A proper smoked whole kipper is quite the glorious thing, with its beautifully bronzed,  ', 'wholekipper.jpg',1,81,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  ' Wild Sea Bass, Packed (260g)  ',12.50, 95, 1, 50, 100, ' May contain traces of crustaceans and molluscs.   ', ' The juicy, delicately flavoured flesh has a similar flavour to haddock and cod, flaking away.  ', 'wildsea.jpg',1,81,''  );







--greengrocer
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Cauliflower,Organic',3.25, 3000, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Used in a variety of dishes, the humble cauli is probably most renowned for the classic "cauliflower and cheese" recipe. Its great when boiled and then added to vegetable curries or roasted, although some people (us) like it raw with a nice dip.', '1.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Spring Onions,Organic (bunch)',2.00, 3500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'With a bright, vibrant flavour, this bunch are mild enough to enjoy raw, but cooked lightly they dont lose their zing and go great in stir-fries or mixed into mashed potato. Please note, bunches may be white or red.', '2.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'English Asparagus,Organic (400g)',6.00, 2500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Star of the spring and jewel of the organic crown, asparagus is a seasonal treat that comes around but once a year. These creamy flavoured, snappy spears are a doddle to cook. Just whip off the woody ends and toss them in a pan with some butter and garlic. No pre-boiling required!', '3.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Jersey Royal Potatoes,Organic (500g)',4.00, 3000, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'We have got the king of the spuds on our hands here and to get them organically is a rare treat. Jersey Royal potatoes are so prized that they are protected with an Appellation Contrôlée label. No one else can grow them – not even expert spud growers on Guernsey.', '4.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Black Garlic,Organic (1 bulb)',3.95, 3500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Made by heating garlic over a period of weeks, this little guy isn’t the brightest bulb in the box, but it’s all the better for it. It has the rich umami flavour of garlic without the pungent odour and eye-watering bite. Black Garlic has a tender, soft fruit texture that has to be tasted to be believed and it’s packed with healthy anti-oxidants for good measure.', '5.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Garlic,Organic (3 bulbs)',1.50, 2500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Our fresh organic garlic is so full of flavour it will give a real boost to any meal. Garlic can be added to almost any meal - just make sure you have some mints to hand.', '6.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Yellow Pepper,Organic (1 piece)',1.40, 3000, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'These new season peppers are so full of flavour you will never buy your peppers anywhere else again. Great to eat cooked or raw, they really do add flavour to any dish. The size of our peppers will vary throughout the year depending on the season.', '7.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Green Pepper,Organic (1 piece)',1.40, 4000, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'These new season peppers are so full of flavour you will never buy your peppers anywhere else again. Great to eat cooked or raw, they really do add flavour to any dish. The size of our peppers will vary throughout the year depending on the season.', '8.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Sweet Potatoes,Organic (1kg)',3.85, 3000, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Sweet potatoes have a creamy texture and a rich, mildly toffee-ish flavour. Despite their sweetness, they are great in savoury dishes. They provide a fantastic balance to spicy foods like curries and chilli. They are also lovely in earthy soups and stews.', '9.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Onions,White,Organic (1kg)',2.30, 2500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'We have all had a good cry over white onions, haven’t we? Such wonderfully versatile vegetables, they are. These organic beauts add a lovely flavour and depth to whatever it is that you’re cooking. The next time you go to chop some up, try and not cut through the root, as that’s where the oil that makes you cry is stored. No amount of goggles will help!', '10.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Beetroot,Organic (500g)',2.00, 2500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Sweet, earthy and delicious. Peel and grate into a rich-coloured slaw. Roast whole then peel, dice and toss with pasta, mascarpone and chives. Or boil them until tender, rub off the skin and serve with a splash of balsamic – lovely with cold roast beef and salads.', '11.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Flat Beans,Organic (400g)',3.25, 3000, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'These organic flat beans look like those of the runner variety but they are a tad different. They are a bit flatter and, best of all, they don’t have any stringy bits! Like all beans, they like butter and a pinch of sea salt. Wash, top and tail, then chop into even-sized nuggets, or slice into ribbons before steaming or lightly boiling. They are lovely served as a side to roast meats, or toss the lightly cooked beans into a salad. Deeelish!', '12.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Portobello Mushrooms,Organic (200g)',2.45, 2500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'These mushrooms are large and robust, with a firm texture. Ideal for stuffing, baking or grilling. They make an excellent alternative to the burger for veggies - simply brush with oil and pop on the grill or barbecue, and cook until the juices run.', '13.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Broccoli,Organic (each)',2.50, 3000, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Organic broccoli are actually the flowers of a cabbage plant, full of vitamins and flavour. Broccoli loves cheese, egg, almonds, garlic and cream. Fix your florets into soups and stir-fries or steam for a nutritious side.', '14.jpg',1,80,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Chillies,Organic (100g)',2.25, 3500, 1, 100, 1000, 'Due to our packing process and re-use of boxes there is a risk of cross-contamination from these, and all other allergens.', 'Our organic chillies are brilliant for adding a kick to many a dish. Pair them with tomatoes, Simon Weirs herbs and a splash of cider vinegar to make a heavenly fresh, homemade salsa, perfect with our tortilla chips.', '15.jpg',1,80,''  );






--delicatessen
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Mixed Bean Sprouts, Organic, Sky Sprouts (227g)  ',14.50, 70, 1, 50, 100, 'We always recommend that you read each label carefully before enjoying your items', 'A little sprout goes a long way, and when added into a salad they add surprisingly substantial crunch and fresh flavour. ', 'beansprouts.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Beetroot, Sliced, Organic, Biona (340g) ',11.50, 50, 1, 50, 100, 'We always recommend that you read each label carefully before enjoying your items ', 'Thinly sliced, they go great in sandwiches or tossed through a salad.  ', 'beetrootslice.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Butter Beans, Organic, (325g)',8.50, 100, 1, 50, 100, 'We always recommend that you read each label carefully before enjoying your items ', 'Plump and creamy Spanish butter beans, pre-cooked and ready for your salads, stews and soups.', 'butterbean.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Semi-dried tomato, organic(185g)  ',9.50, 80, 1, 50, 100, 'We always recommend that you read each label carefully before enjoying your items ', 'Semi-dried tomatoes,garlic and basil leaves,organic ', 'driedtomatoes.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Houmous, Organic,  (220g)',7.55, 50, 1, 50, 100, 'For allergens, including cereals containing gluten, please see ingredients in bold.', 'This houmous is very special, being 65% organic chickpeas. It’s great for dunking carrot sticks or chucked into a pitta with green leaves. ', 'houmous.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Limone Olives, Organic, The Real Olive Company (185g)',14.50, 65, 1, 50, 100, 'May contain traces of crustaceans and molluscs. ', 'The Real Olive Company’s authentic Greek olives set the stage for a true taste of the Med in this pot. ', 'limoneolives.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Protein Pack, Organic, Sky Sprouts (175g)',4.50, 60, 1, 50, 100, ' No any allergy so far. ', 'This handy pack boasts three healthy sprouts, each with a unique flavour and texture. Sweet mung sprouts, a staple of East Asian. ', 'proteinpack.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Mackerel Pâté with Organic Spaghetti Seaweed (120g)',5.50, 90, 1, 50, 100, 'We always recommend that you read each label carefully ', ' Then this Mackerel Pâté with Organic Spaghetti Seaweed is just the ticket sustainably sourced mackerel with freshly harvested, organic Sea Spaghetti seaweed for a distinctive taste and texture. ', 'spaghetti.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Tunisian Sweet Grilled Peppers, Organic, Moulins Mahjoub (185g)',6.75, 50, 1, 50, 100, 'We always recommend that you read each label carefully   ', 'Mouth-wateringly rich and packed with flavour, these premium Tunisian sweet grilled peppers are the perfect starting place for your organic anti-pasti plate, sandwich. ', 'tunisianpepper.jpg',1,82,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null,  'Wild Venison Pâté with Port, Pyman Pâtés (120g) ',9.75, 80, 1, 50, 100, 'We always recommend that you read each label carefully   ', 'The rich, gamey flavour of wild venison is tumbled tantalisingly with slightly sweet, brooding port in this decadent pâté. ', 'wildvenisonpate.jpg',1,82,''  );







--butcher
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Sirloin Steak',8.95, 55, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold.May contain traces of gluten', 'Organic steak (440gm)', 'product1.jpg',1,83,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Chicken Breast',7.49, 150, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold.May contain traces of gluten', 'Organic Mini Fillets (400gm)', 'product2.jpg',1,83,''  );


INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Beef Meatballs',5.45, 200, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold.', 'Organic, Daylesford (336g)', 'product3.jpg',1,83,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Beef Shortrib',7.65, 85, 1, 100, 1000, 'Organic Beef* (100%) * *= produced to an organic standard', 'Organic, Eversfield Organic (600g)', 'product4.jpg',1,83,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Pork Stock Bones',12, 90, 1, 100, 1000, 'Organic Pork* (100%)* *= produced to an organic standard', 'Organic stock at mart (1kg)', 'product5.jpg',1,83,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Pork Loin Joint, Boneless',20.95, 120, 1, 100, 1000, 'Organic Pork (100%)* *= produced to an organic standard', 'Organic pork (12kg)', 'product6.jpg',1,83,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Barnsley Chop',10.25, 110, 1, 100, 1000, 'Lamb 100%* *= Produced to organnic standards', 'Organic lamb (500gm)', 'product7.jpg',1,83,''  );

INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Lamb Liver',5.55, 65, 1, 100, 1000, 'Organic Lamb (100%)* *= produced to an organic standard', 'Organic, Eversfield Organic (300g)', 'product8.jpg',1,83,''  );








--bakery --bread
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Whole Grain Loaf,Sliced,Organic,Authentic Bread Co. (800g)',3.00, 3500, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold. May contain traces of nuts', 'Not your average supermarket bread; made by traditional long fermentation processes with no improvers, preservatives, or palm oil. We’re in loaf. A 800g loaf with wholemeal flour for a soft texture and dense, nutty taste, brill to get cheesy with.', '1.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Milk & Honey Sourdough, Sliced, Organic,Seven Seeded (400g)',2.90, 3500, 1, 100, 1000, 'For allergens, including cereals containing gluten, see ingredients in bold.', 'The land of milk and honey is a place on Earth with this soft and chewy sourdough loaf. Perfect for sandwiches and bruschetta, its creamy crumb is achieved using Seven Seeded’s 48-hour sourdough starter, organic Zambian honey and whole milk. Also available unsliced.', '2.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Seven Seeded Sourdough, Sliced, Organic,Seven Seeded (400g)',3.00, 4000, 1, 100, 1000, 'For allergens, including cereals containing gluten, see ingredients in bold.', 'Seven Seeded’s signature organic sourdough has a tight, springy crumb and a touch of wholemeal flour for satisfying sandwiches and toast. The eponymous mix of protein-rich seeds add a wholesome bite that’ll have you coming back for slice after slice. Also available unsliced.', '3.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Hertfordshire Sourdough, Sliced, Organic,Seven Seeded (400g)',2.60, 2500, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold. May contain traces of nuts', 'Traditional, organic wholemeal sourdough with just a little sprinkling of brooding dark rye. With a heavy crumb and deep, malty flavour, this is a hearty loaf that’s cracking enjoyed toasted with healthy lashings of old-fashioned butter. Also available unsliced.', '4.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Whole Grain Loaf,Sliced,Organic,Authentic Bread Co. (400g)',2.00, 3500, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold. May contain traces of nuts.', 'Not your average supermarket bread; made by traditional long fermentation processes with no improvers, preservatives, or palm oil. We’re in loaf. A 400g loaf with wholemeal flour for a soft texture and dense, nutty taste, brill to get cheesy with.', '5.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Malted 5 Seed Sourdough Bread, Organic,Famous Hedgehog Bakery (800g)',4.40, 4000, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold.May contain traces of egg, nuts and milk.', 'Long Crichel’s larger malted 5 seed sourdough has won awards for how good it is. This delicious bread is a stoneground blend of unbleached white wheat flour and sunflower, sesame, wheatgrain, linseed and millet seeds for a richer flavour.', '6.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'White Loaf, Sliced, Organic,Authentic Bread Co. (800g)',3.00, 5000, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold. May contain traces of nuts', 'Not your average supermarket bread; made by traditional long fermentation processes with no improvers, preservatives or palm oil. We’ve fallen in loaf. This 800g beaut is a traditional English loaf. Crunchy crust and a big softie on the inside.', '7.jpg',1,84,''  );

--bakery --cakes
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Croissants, all butter, Organic,Authentic Bread Co. (250g, pack of 3)',2.85, 3500, 1, 100, 1000, 'For allergens including cereals containing gluten, please see ingredients in bold.May contain traces of nuts and sesame', 'Golden, flaky, buttery croissants go best when you warm ‘em up and add a slick of butter and jam. Or go savoury with slices of ham and Somerset brie. Made by hand every day, using local organic flour and butter.', '8.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Spiced Buns, Organic,Authentic Bread Co. (pack of 4)',2.65, 3000, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold. May contain traces of nuts', 'The Authentic Bread Company have baked up this amazing cross between a teacake and a hot cross bun. Light in texture with chewy vine fruits and a spicy aroma. Warm them up and spread with butter for the perfect snack.', '9.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Carrot Cake, Organic,Authentic Bread Co. (430g)',4.60, 3500, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold', 'This carrot cake is full of, well, carrots. Organic ones at that. As well as flour and eggs to make this rustic beaut. Cinnamon spicy and sweet, with walnuts and hints of orange. A rectangular cake, ideal for packing into picnics or lunchboxes.', '10.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Bakewell Tart, Famous Hedgehog Bakery,Organic (625g)',12.50, 2500, 1, 100, 1000, 'For allergens, including cereals containing gluten, see ingredients in bold.May contain traces of sesame', 'A bakewell tart. A true British classic. This one from Long Crichel is a real stunner, with crisp sweet pastry, delicious raspberry jam, and a generous helping of frangipane filling.', '11.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Pain au Chocolat, Organic,Authentic Bread Co. (150g, pack of 2)',2.65, 3000, 1, 100, 1000, 'For allergens including cereals containing gluten, please see ingredients in bold.May contain traces of nuts and sesame', 'Flaky, buttery, organic dark chocolate treats get smiles all round, even on Monday mornings. Perfect alongside a coffee and paper. Made by hand every day, using local organic flour and butter.', '12.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Chocolate & Almond Flourless Torte, Organic,Authentic Bread Co. (6")',7.50, 3500, 1, 100, 1000, 'For allergens, including cereals containing gluten, please see ingredients in bold', 'The Authentic Bread Company went for the torte variety when it came to chocolate cake. No flour means more chocolate after all. Made by hand every day, with organic chocolate, eggs and butter. Delicious with cream and an espresso on the side.', '13.jpg',1,84,''  );
INSERT INTO products (product_id,  product_name, item_price, quantity_in_stock, availablility, min_order, max_order, allergy_info, product_info, product_image,status,fk_shop_id, fk_offer_id) VALUES (null, 'Apple & Blackberry Crumble, Organic,Daylesford (300g)',5.25, 2000, 1, 100, 1000, 'For allergens, including cereals containing gluten, see ingredients in bold', 'A gorgeous treat of an organic pud. Made by hand on Daylesford farm with sweet, ripe berries and apples topped with a buttery oat crumble. This Apple & Blackberry Crumble is just the right amount for two to share.', '14.jpg',1,84,''  );







