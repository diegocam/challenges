SELECT r.id, r.name, COUNT(t.id) AS total_tickets
FROM customer_service_representatives AS r
LEFT JOIN customer_service_tickets AS t
  ON t.customer_service_representative_id = r.id
GROUP BY r.id, r.name
