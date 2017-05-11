DROP TRIGGER IF EXISTS Plan_Delete;
DROP TRIGGER IF EXISTS Billing_Delete_Subscription;
DROP TRIGGER IF EXISTS Address_Delete;
DROP TRIGGER IF EXISTS Customer_Delete;

CREATE TRIGGER `Billing_Delete_Subscription` BEFORE DELETE ON `Billing_Info`
 FOR EACH ROW DELETE FROM Subscription WHERE old.id = Subscription.billing_id;
 
DELIMITER $$
CREATE TRIGGER `Plan_Delete` BEFORE DELETE ON `Plan`
 FOR EACH ROW BEGIN
  DELETE FROM Address_Plans WHERE old.id = Address_Plans.plan_id;
  DELETE FROM Subscription WHERE old.id = Subscription.plan_id;
END
$$

DELIMITER $$
CREATE TRIGGER `Address_Delete` BEFORE DELETE ON `Address`
 FOR EACH ROW BEGIN
  DELETE FROM Address_Plans WHERE old.id = Address_Plans.address_id;
  DELETE FROM Subscription WHERE old.id = Subscription.address_id;
END
$$

DELIMITER $$
CREATE TRIGGER `Customer_Delete` BEFORE DELETE ON `Customer`
 FOR EACH ROW BEGIN
  DELETE FROM Subscription WHERE old.id = Subscription.customer_id;
  DELETE FROM Billing_Info WHERE old.id = Billing_Info.user_id;
END
$$
