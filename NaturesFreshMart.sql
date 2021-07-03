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
	first_name	VARCHAR2(20) NOT NULL,
	last_name	VARCHAR2(20) NOT NULL,
	address	VARCHAR2(50) NOT NULL,
	email	VARCHAR2(50) NOT NULL UNIQUE,
    phone_number INTEGER NOT NULL UNIQUE,
	password	VARCHAR2(255) NOT NULL,
    profile_img VARCHAR(100),
    token VARCHAR2(255),
    status INTEGER,
    permissions VARCHAR2(40)
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
	product_image VARCHAR2(50),
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
    --PRIMARY KEY (fk_product_id, fk_basket_id),
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
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS) VALUES (null, 'saugat', 'thapa', 'Npj-12, Banke Gaon','neplese931@gmail.com', 9840064535,  'saugat123', '11/profile.jpg', null, 1, 'STHAPA');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS) VALUES (null, 'rajesh', 'birse', 'Kathmandu', 'brajesh18@tbc.edu.np', 9840263535,  'saugat123', '12/profile.jpg', null, 1, 'RBASNET');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS) VALUES (null, 'gaurav', 'bhansali', 'Mahendranagar, Tinkune','bhansaligaurav2000@gmail.com', 9940063535,  'saugat123', '13/profile.jpg', null, 1, 'GBHANSALI');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS) VALUES (null, 'aakash', 'Verma', 'Npj-8, Bhrikutinagar','	aakashpuchu@gmail.com', 9840033535,  'saugat123', '14/profile.jpg', null, 1, 'AKDAS');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS, PERMISSIONS) VALUES (null, 'harsh', 'Teewary', 'Kathmandu', 'gharsh18@tbc.edu.np', 9840063545,  'saugat123', '15/profile.jpg', null, 1, 'HGUPTA');
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS) VALUES (null, 'MAIN', 'ADMIN', 'NPJ-12, Banke Gaon','adminWala@gmail.com', 9820063535, 'saugat123', '1/profile.png', null, 1);

INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS) VALUES (null, 'prdeep', 'Verma', 'satdobato','prdeep@gmail.com', 9824063535, 'saugat123', '16/profile.jpg', null, 1);
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS) VALUES (null, 'sunny', 'Teewary', 'Kathmandu', 'sunny@gmail.com', 986003535, 'saugat123', '17/profile.jpg', null, 1);
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS) VALUES (null, 'jamla', 'Teewary', 'Kathmandu', 'jamal@gmail.com', 986006535, 'saugat123', '17/profile.jpg', null, 1);
INSERT INTO USERS (USER_ID, FIRST_NAME, LAST_NAME, ADDRESS, EMAIL, PHONE_NUMBER, PASSWORD, PROFILE_IMG, TOKEN, STATUS) VALUES (null, 'harry', 'Teewary', 'Kathmandu', 'harry@gmail.com', 986063535, 'saugat123', '17/profile.jpg', null, 1);


-- trader data
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (10, null, 'greengrocer');
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (11, null, 'fishmonger');
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (12, null, 'delicatessen');
INSERT INTO traders (USER_ID, TRADER_ID, trader_type) VALUES (13, null, 'butcher');
INSERT INTO traders(USER_ID, TRADER_ID, trader_type) VALUES (14, null, 'baker');


-- customer data
INSERT INTO customers (USER_ID, customer_id) VALUES (16, null);
INSERT INTO customers(USER_ID, customer_id) VALUES (17, null);
INSERT INTO customers(USER_ID, customer_id) VALUES (18, null);
INSERT INTO customers(USER_ID, customer_id) VALUES (19, null);

-- admin data
INSERT INTO admin (USER_ID, admin_id) VALUES (15, null);


-- shop data
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null, 'John Legend Shop','Fresh Meat', 30);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null,  'Rajbir Chand Shop','Fresh Daal', 31);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null, 'Bijay Giri Shop','Bhaat', 32);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null,  'Kadamber Verma Shop','Tarkari', 33);
INSERT INTO SHOPS (SHOP_ID, SHOP_NAME, PRODUCT_CATEGORY, fk_trader_id) VALUES (null, 'Sushant Teewary Shop', 'Roti', 34);





