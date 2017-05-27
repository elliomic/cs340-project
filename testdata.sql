INSERT INTO Employee (username, salary, name)
VALUES ('hulk', 20000, 'Bruce Banner'), ('ironman', 200000, 'Tony Stark');

INSERT INTO Address (num, street, state, city, zip, apt_no)
VALUES (1234,'SW GreenMachine Dr.','NY','New York',97111,NULL), (555,'SW malibu Pl', 'CA', 'Los Angeles',97000,3), (000,'space GXY', 'MW', 'Milky Way',00000, NULL);

INSERT INTO Customer (username, name, address_id)
VALUES ('hulk','Bruce Banner',1), ('ironman','Tony Stark',2),('starlord','Peter Quill',3);

INSERT INTO Customer (username, name, address_id, pass_hash)
VALUES ('bob', 'Bob', 1, PASSWORD('password123'));

INSERT INTO Customer (username, name, address_id, pass_hash)
VALUES ('bob5', 'Bob', 1, 'password123');

INSERT INTO Billing_Info (cc_number, cc_type, expiration_date, name, user_id)
VALUES ('12345678910', 'VISA', '6/20/1994', 'Bruce Banner', 1), ('10987654321','MASTERCARD', '5/10/2017','Tony Stark',2),('1111111111111111','BUCKS','12/31/9999','Peter Quill',3);

INSERT INTO Plan (name, price,speed, added_by)
VALUES ('nada',5,10,1), ('The kitchen Sink',10000,9999,2),('nada',1,1000,1);

INSERT INTO Subscription (billing_id, customer_id, plan_id, address_id)
VALUES (1,1,1,1), (2,2,2,2),(3,3,3,3);

INSERT INTO Address_Plans (plan_id, address_id)
VALUES (1,1), (2,2), (1,3);
