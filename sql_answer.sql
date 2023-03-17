-- Display all items having active status.

SELECT * FROM products
WHERE items_status = 'A';

-- Display all users that are inactive.

SELECT * FROM users
WHERE status = 'I';


-- Display the list of order's Descriptive information:
-- order_id, date_ordered, username, item_name, total_amount
-- Note: total_amount = SUM(item_qty * item_price)

SELECT
o.order_id, o.date_ordered, u.username, p.item_name
,SUM (o.item_qty * p.item_price) AS total_amount
FROM orders o
JOIN users u
ON o.user_id = u.user_id
JOIN products p
ON o.item_id = p.item_id
GROUP BY u.username;

-- Display all the order information having "Delivered" status
-- order_status, order_id, user_name, item_name, total_amount, total_qty
-- Note: total_qty = SUM(item_qty)

SELECT *, 
o.ordered_status
, o.order_id
, u.username, p.item_name
, SUM (o.item_qty * p.item_price) AS total_amount, SUM (o.item_qty) AS total_qty,
FROM orders o
JOIN users u
ON o.user_id = u.user_id
JOIN products p
ON o.item_id = p.item_id
WHERE order_status = 'D'
GROUP BY u.username;

-- Display active items ordered by all active users and has been ordered for the year 2023 or after Dec. 31, 2022 and is still pending

SELECT
p.item_id, p.item_name, p.item_price,
o.item_qty, o.date_ordered,
o.order_status, u.username, u.user_status
FROM orders o
JOIN user u 
ON o.user_id = u.user_id
JOIN products p
ON o.item_id = p.item_id
WHERE p.item_status = 'A' AND u.user_status = 'A' AND o.date_ordered >='2023/01/01' AND order_status = 'P'
GROUP BY u.username;





-- BONUS ANSWERS --



-- Display all delivered orders on February 14, 2023.
SELECT o.order_id, o.item_qty, u.user_id, COUNT(o.order_id)
FROM orders o
JOIN users u
ON o.user_id = u.user_id
WHERE o.oder_status = 'D' AND o.date_ordered = '2022-02-14'
GROUP BY o.order_id;

-- Insert new item called "Choco Mocha" with a price of 49 pesos.
INSERT INTO 'items' ('item_id', 'item_name', 'item_price', 'item_status', 'cat_id') VALUES ('10','Choco Mocha','39','A','1');

-- Update the product under item_id 2 due to fact that it is out of stock.
UPDATE 'products' 
SET 'item_status'='I'
WHERE 'item_id' = 2;

-- Delete all users where user status is inactive
DELETE FROM 'users' 
WHERE 'user_status' = 'I';