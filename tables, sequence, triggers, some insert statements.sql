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
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'saugat', 'thapa', 'Npj-12, Banke Gaon','neplese931@gmail.com', 9840064535,  'c43591e4f076656e9ab46df5131e06d8', '', null, 1, 'STHAPA', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'rajesh', 'khapatari', 'Kathmandu', 'brajesh18@tbc.edu.np', 9840263535,  'c43591e4f076656e9ab46df5131e06d8', '', null, 1, 'RBASNET', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'gaurav', 'bhansali', 'Mahendranagar, Tinkune','bhansaligaurav2000@gmail.com', 9940063535,  'c43591e4f076656e9ab46df5131e06d8', '', null, 1, 'GBHANSALI', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'aakash', 'das', 'Npj-8, Bhrikutinagar','	aakashpuchu@gmail.com', 9840033535,  'c43591e4f076656e9ab46df5131e06d8', '', null, 1, 'AKDAS', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'harsh', 'gupta', 'Kathmandu', 'gharsh18@tbc.edu.np', 9840063545,  'c43591e4f076656e9ab46df5131e06d8', '', null, 1, 'HGUPTA', 'VILEROZE');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS, ADMIN_ACCESS) VALUES (null, 'MAIN', 'ADMIN', 'NPJ-12, Banke Gaon','adminWala@gmail.com', 9820063535, 'c43591e4f076656e9ab46df5131e06d8', '', null, 1,'VILEROZE', 'VILEROZE');


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
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null, 'Sudha Gupta Shop', 'Bakery & Sweats ', 34);

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

