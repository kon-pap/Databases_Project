/*Most famous product pairs , Top 10 -- Create View containing storeid*/
DROP VIEW famous_pairs;
CREATE VIEW famous_pairs AS
SELECT purch_prod.productid, product.name, product.brand, purchase.storeid, purchase.purid
FROM purchase, purch_prod, product
WHERE purchase.purid = purch_prod.purid 
AND purch_prod.productid = product.productid
ORDER BY purchase.purid;

SELECT COUNT(*) AS count, t1.productid, t1.name, t1.brand, t2.productid, t2.name, t2.brand
FROM famous_pairs t1, famous_pairs t2
WHERE t1.productid > t2.productid
AND t1.purid = t2.purid
AND t2.storeid IN (1,2,3,4)
GROUP BY t1.productid, t2.productid
ORDER BY count DESC
LIMIT 10;

/*Most famous places in store */
SELECT COUNT(*) AS count, offers.productid, offers.storeid, offers.corridor, offers.shelve
FROM purch_prod, offers, purchase
WHERE purchase.purid = purch_prod.purid 
AND purchase.storeid = offers.storeid 
AND purch_prod.productid = offers.productid 
AND offers.storeid =4
GROUP BY offers.productid, offers.storeid
ORDER BY count DESC
LIMIT 10;

/*isLabel % per store per category */
DROP VIEW isLabel_pref;
CREATE VIEW isLabel_pref AS
SELECT product.islabel, category.name, purchase.storeid
FROM purchase, purch_prod, product, category
WHERE purchase.purid = purch_prod.purid
AND purch_prod.productid = product.productid
AND product.catid = category.catid;

SELECT COUNT(*) AS count, islabel, name FROM isLabel_pref
WHERE storeid =1
GROUP BY name, islabel;

/*Hours most money spend per store */
SELECT TIME_FORMAT(purchase.time, "%H") AS hourspan, SUM(total) as profit
FROM purchase
WHERE storeid = 7
GROUP BY hourspan;

/*For testing purposes */
SELECT SUM(total)
from purchase
where TIME_FORMAT(purchase.time, "%H") = 09 and storeid = 1;

/*Age Groups per Hour per store
Age 15-24
Age 25-40
Age 41-64
Age 65+ */
SELECT COUNT(*) as count, TIME_FORMAT(purchase.time, "%H") AS hourspan,
(CASE
	WHEN YEAR(CURRENT_TIMESTAMP) - DATE_FORMAT(customer.date_of_birth, "%Y") <= 24 THEN "Age: 15-24"
    WHEN YEAR(CURRENT_TIMESTAMP) - DATE_FORMAT(customer.date_of_birth, "%Y") <= 40 THEN "Age: 25-40"
    WHEN YEAR(CURRENT_TIMESTAMP) - DATE_FORMAT(customer.date_of_birth, "%Y") <= 64 THEN "Age: 41-64"
    ELSE "Age: 65+"
END) AS age_group
FROM purchase, customer
WHERE purchase.cardid = customer.cardid and purchase.storeid = 1
GROUP BY hourspan, age_group;