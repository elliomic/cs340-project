DROP TABLE IF EXISTS address_plans;
DROP TABLE IF EXISTS subscriptions;
DROP TABLE IF EXISTS plans;
DROP TABLE IF EXISTS billing_info;
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS addresses;
DROP TABLE IF EXISTS employees;


CREATE TABLE employees (
	id				INT AUTO_INCREMENT NOT NULL,
	username		VARCHAR(255) UNIQUE NOT NULL,
	salary			INT,
	name			VARCHAR(255),
	PRIMARY KEY	(id)
) ENGINE=InnoDB;

CREATE TABLE addresses (
	id				INT AUTO_INCREMENT NOT NULL,
	num				INT NOT NULL,
	street			VARCHAR(255) NOT NULL,
	state				CHAR(2) NOT NULL,
	city			VARCHAR(255) NOT NULL,
	zip				DECIMAL(5) NOT NULL,
	apt_no			DECIMAL(3),
	PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE customers (
	id				INT AUTO_INCREMENT NOT NULL,
	username		VARCHAR(255) UNIQUE NOT NULL,
	name			VARCHAR(255) NOT NULL,
	address_id		INT,
	PRIMARY KEY (id),
	FOREIGN KEY (address_id) REFERENCES addresses(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE billing_info (
	id				INT AUTO_INCREMENT NOT NULL,
	cc_number		DECIMAL(16,0) NOT NULL,
	cc_type			VARCHAR(10) NOT NULL,
	expiration_date	DATE NOT NULL,
	name			VARCHAR(255) NOT NULL,
	user_id			INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES customers(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE subscriptions (
	billing_id		INT,
	customer_id		INT,
	plan_id			INT,
	address_id		INT,
	PRIMARY KEY (plan_id, address_id), -- Can't subscribe to the same plan at the same address
	FOREIGN KEY (billing_id) REFERENCES billing_info(id) ON DELETE CASCADE,
	FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
	FOREIGN KEY (address_id) REFERENCES addresses(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE plans (
	id				INT AUTO_INCREMENT NOT NULL,
	name			VARCHAR(255),
	price			DECIMAL(5, 2),
	speed			INT,
	added_by		INT,
	PRIMARY KEY (id),
	FOREIGN KEY (added_by) REFERENCES employees(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Junction table between addresses and plans
-- These are which plans are available at which addresses
-- (as opposed to subscriptions, which is actual subscriptions)
CREATE TABLE address_plans (
	plan_id			INT NOT NULL,
	address_id		INT NOT NULL,
	PRIMARY KEY (plan_id, address_id),
	FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE,
	FOREIGN KEY (address_id) REFERENCES addresses(id) ON DELETE CASCADE
) ENGINE=InnoDB;
