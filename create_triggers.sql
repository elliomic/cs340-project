CREATE TRIGGER `Customers_Delete` BEFORE DELETE ON `customers`
 FOR EACH ROW BEGIN
DELETE FROM subscriptions WHERE old.id = subscriptions.customer_id;
DELETE FROM billing_info WHERE old.id = billing_info.user_id;
END

CREATE TRIGGER `Customers_Update` BEFORE UPDATE ON `customers`
 FOR EACH ROW UPDATE subscriptions SET address_id = new.address_id WHERE old.id = subscriptions.customer_id;

CREATE TRIGGER `Addresses_Delete` BEFORE DELETE ON `addresses`
 FOR EACH ROW DELETE FROM address_plans WHERE old.id = address_plans.address_id;
 
CREATE TRIGGER `Plans_Delete` BEFORE DELETE ON `plans`
 FOR EACH ROW DELETE FROM address_plans WHERE old.id = address_plans.plan_id;