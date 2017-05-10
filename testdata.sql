INSERT INTO employees (id, username, salary, name)
VALUES ('1','The Hulk','20000','Bruce Banner'), ('2','Iron Man','200000','Tony Stark');

INSERT INTO addresses (id, num, street, st,city,zip,apt_no)
VALUES ('1','1234','SW GreenMachine','Drive','New York','97111',NULL), ('2','555','SW malibu','Pl','California','97000',3), ('0','000','space','GXY','Milky Way','00000', NULL);

INSERT INTO customers (id, username, name, address_id)
VALUES ('1','The Hulk','Bruce Banner','1'), ('2','Iron Man','Tony Stark','2'),('3','Star Lord','Peter Quill','0');

INSERT INTO billing_info (id, cc_number, cc_type, expiration_date, name, user_id)
VALUES ('1', '12345678910', 'VISA', '6/20/1994', 'Bruce Banner', '1'), ('2','10987654321','MASTERCARD', '5/10/2017','Tony Stark','2'),('3','1111111111111111','BUCKS','12/31/9999','Peter Quill','3');

INSERT INTO subscriptions (billing_id, customer_id, plan_id, address_id)
VALUES ('1','1','1','1'), ('2','2','2','2'),('3','3','0','0');

INSERT INTO plans (id, name, price,speed, added_by)
VALUES ('1','nada','5','10','1'), ('2','The kitchen Sink','10000','9999','2'),('1','nada','1','1000','1');

INSERT INTO address_plans (plan_id, address_id)
VALUES ('1','1'), ('2','2'), ('1','0');