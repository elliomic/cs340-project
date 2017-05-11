DROP TABLE IF EXISTS Address_Plans;
DROP TABLE IF EXISTS Subscription;
DROP TABLE IF EXISTS Plan;
DROP TABLE IF EXISTS Billing_Info;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Address;
DROP TABLE IF EXISTS Employee;


CREATE TABLE Employee (
	id				INT AUTO_INCREMENT NOT NULL,
	username		VARCHAR(255) UNIQUE NOT NULL,
    pass_hash       BINARY(60) NOT NULL,
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
    pass_hash       BINARY(60) NOT NULL,
    name			VARCHAR(255) NOT NULL,
	address_id		INT,
	PRIMARY KEY (id),
	FOREIGN KEY (address_id) REFERENCES addresses(id) ON DELETE SET NULL
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Billing_Info (
	id				INT AUTO_INCREMENT NOT NULL,
	cc_number		DECIMAL(16) NOT NULL,
	cc_type			VARCHAR(255) NOT NULL,
	expiration_date	DATE NOT NULL,
	name			VARCHAR(255) NOT NULL,
	user_id			INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Subscription (
	plan_id			INT,
	address_id		INT,
	billing_id		INT,
	customer_id		INT,
	PRIMARY KEY (plan_id, address_id), -- Can't subscribe to the same plan at the same address
	FOREIGN KEY (billing_id) REFERENCES billing_info(id) ON DELETE CASCADE,
	FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
	FOREIGN KEY (address_id) REFERENCES addresses(id) ON DELETE CASCADE
) ENGINE=InnoDB, CHARACTER SET=UTF8;

CREATE TABLE Plan (
	id				INT AUTO_INCREMENT NOT NULL,
	name			VARCHAR(255),
	price			DECIMAL(9, 2),
	speed			INT,
	added_by		INT,
	PRIMARY KEY (id),
	FOREIGN KEY (added_by) REFERENCES employees(id) ON DELETE SET NULL
) ENGINE=InnoDB, CHARACTER SET=UTF8;

-- Junction table between addresses and plans
-- These are which plans are available at which addresses
-- (as opposed to subscriptions, which is actual subscriptions)
CREATE TABLE Address_Plans (
	plan_id			INT NOT NULL,
	address_id		INT NOT NULL,
	PRIMARY KEY (plan_id, address_id),
	FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE,
	FOREIGN KEY (address_id) REFERENCES addresses(id) ON DELETE CASCADE
) ENGINE=InnoDB, CHARACTER SET=UTF8;
