DROP TRIGGER IF EXISTS Plans_Delete;
DROP TRIGGER IF EXISTS billing_Delete_subscription;
DROP TRIGGER IF EXISTS Addresses_Delete;
DROP TRIGGER IF EXISTS Customers_Delete;

CREATE TRIGGER `billing_Delete_subscription` BEFORE DELETE ON `billing_info`
 FOR EACH ROW DELETE FROM subscriptions WHERE old.id = subscriptions.billing_id;
 
 DELIMITER $$
 CREATE TRIGGER `Plans_Delete` BEFORE DELETE ON `plans`
 FOR EACH ROW BEGIN
DELETE FROM address_plans WHERE old.id = address_plans.plan_id;
DELETE FROM subscriptions WHERE old.id = subscriptions.plan_id;
END
$$

 DELIMITER $$
CREATE TRIGGER `Addresses_Delete` BEFORE DELETE ON `addresses`
 FOR EACH ROW BEGIN
DELETE FROM address_plans WHERE old.id = address_plans.address_id;
DELETE FROM subscriptions WHERE old.id = subscriptions.address_id;
END
$$

 DELIMITER $$
CREATE TRIGGER `Customers_Delete` BEFORE DELETE ON `customers`
 FOR EACH ROW BEGIN
DELETE FROM subscriptions WHERE old.id = subscriptions.customer_id;
DELETE FROM billing_info WHERE old.id = billing_info.user_id;
END
$$