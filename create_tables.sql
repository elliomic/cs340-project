DROP TABLE IF EXISTS Address_Plans;
DROP TABLE IF EXISTS Subscription;
DROP TABLE IF EXISTS Plan;
DROP TABLE IF EXISTS Billing_Info;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Address;
DROP TABLE IF EXISTS Employee;

DROP PROCEDURE IF EXISTS UpdateAddressCustomer;
DROP PROCEDURE IF EXISTS CheckValidState;

DELIMITER $$
CREATE PROCEDURE UpdateAddressCustomer(customerId INT, addNum INT, addStreet
	VARCHAR(255), addAptNo INT, addCity VARCHAR(255), addSt CHAR(2), addZip DECIMAL(5))
	BEGIN
		DECLARE addressId INT;
		IF NOT EXISTS(SELECT * FROM Address WHERE num = addNum AND street = addStreet AND (addAptNo IS NULL OR apt_no = addAptNo) AND city = addCity AND state = addSt AND zip = addZip) THEN
		BEGIN
			INSERT INTO Address (num, street, apt_no, city, state, zip)
			VALUES (addNum, addStreet, addAptNo, addCity, addSt, addZip);
		END;
	END IF;
	
	SET addressId = (SELECT id FROM Address WHERE num = addNum AND
	street = addStreet AND (addAptNo IS NULL OR apt_no = addAptNo) AND
	city = addCity AND state = addSt AND zip = addZip);
	
	UPDATE Customer SET address_id = addressId WHERE id = customerId;
END
$$


CREATE PROCEDURE CheckValidState(s CHAR(2))
BEGIN
 IF s NOT IN ('AK', 'AL', 'AR', 'AZ', 'CA', 'CO', 'CT', 'DE',
'FL', 'GA', 'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA',
'MD', 'ME', 'MI', 'MN', 'MO', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH',
'NJ', 'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD',
'TN', 'TX', 'UT', 'VA', 'VT', 'WA', 'WI', 'WV', 'WY') THEN
 SIGNAL SQLSTATE '45000'
 SET MESSAGE_TEXT = 'That is not a valid state.';
 END IF;
END;
$$

DELIMITER ;

CREATE TABLE Employee (
	id				INT AUTO_INCREMENT NOT NULL,
	username		VARCHAR(255) UNIQUE NOT NULL,
    	pass			CHAR(32),
	salary			INT,
	name			VARCHAR(255),
	PRIMARY KEY	(id)
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Address (
	id				INT AUTO_INCREMENT NOT NULL,
	num				INT NOT NULL,
	street			VARCHAR(255) NOT NULL,
	apt_no			INT,
    city			VARCHAR(255) NOT NULL,
	state				CHAR(2) NOT NULL,
	zip				DECIMAL(5) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Customer (
	id				INT AUTO_INCREMENT NOT NULL,
	username		VARCHAR(255) UNIQUE NOT NULL,
    	pass			CHAR(32),
    name			VARCHAR(255) NOT NULL,
	address_id		INT,
	PRIMARY KEY (id),
	FOREIGN KEY (address_id) REFERENCES Address(id) ON DELETE SET NULL
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Billing_Info (
	id				INT AUTO_INCREMENT NOT NULL,
	cc_number		DECIMAL(16) NOT NULL,
	cc_type			VARCHAR(255) NOT NULL,
	expiration_date	DATE NOT NULL,
	name			VARCHAR(255) NOT NULL,
	user_id			INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES Customer(id) ON DELETE CASCADE
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Subscription (
	plan_id			INT,
	address_id		INT,
	billing_id		INT,
	customer_id		INT,
	PRIMARY KEY (plan_id, address_id), -- Can't subscribe to the same plan at the same address
	FOREIGN KEY (billing_id) REFERENCES Billing_Info(id) ON DELETE CASCADE,
	FOREIGN KEY (customer_id) REFERENCES Customer(id) ON DELETE CASCADE,
	FOREIGN KEY (address_id) REFERENCES Address(id) ON DELETE CASCADE
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Plan (
	id				INT AUTO_INCREMENT NOT NULL,
	name			VARCHAR(255),
	price			DECIMAL(9, 2),
	speed			INT,
	added_by		INT,
	PRIMARY KEY (id),
	FOREIGN KEY (added_by) REFERENCES Employee(id) ON DELETE SET NULL
) ENGINE=InnoDB, CHARACTER SET=UTF8;

-- Junction table between Address and Plan
-- These are which plans are available at which addresses
-- (as opposed to subscriptions, which is actual subscriptions)
CREATE TABLE Address_Plans (
	plan_id			INT NOT NULL,
	address_id		INT NOT NULL,
	PRIMARY KEY (plan_id, address_id),
	FOREIGN KEY (plan_id) REFERENCES Plan(id) ON DELETE CASCADE,
	FOREIGN KEY (address_id) REFERENCES Address(id) ON DELETE CASCADE
) ENGINE=InnoDB, CHARACTER SET=UTF8;

INSERT INTO Address (num, street, state, city, zip, apt_no) VALUES
(123, '1st St.', 'OR', 'Corvallis', 97333, NULL),
(456, '2nd St.', 'OR', 'Corvallis', 97333, NULL);

INSERT INTO Customer (username, name, address_id, pass) VALUES
('juli', 'Julianne Schutfort', 1, MD5('tigger')),
('bob', 'Bob', 1, MD5('password123'));

INSERT INTO Employee (username, salary, name, pass) VALUES
('hulk', 20000, 'Bruce Banner', MD5('smash'));

INSERT INTO Plan (name, price, speed, added_by) VALUES
('Sluggy 56k', 10, 56, 1),
('Cheetah Cable', 49, 500, 1);

INSERT INTO Address_Plans (address_id, plan_id) VALUES
(1, 1),
(2, 1),
(2, 2);
