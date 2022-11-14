SELECT property.name as property_names_with_unique_ids_in_category
FROM property
WHERE property.id IN (
	SELECT property.id as property_names_with_unique_ids_in_category
	FROM category
	JOIN product ON category.id = product.category_id
	JOIN property_value ON product.id = property_value.product_id
	JOIN property On property_value.property_id = property.id
	WHERE category.name = 'Название категории'
	GROUP BY property.id
	HAVING COUNT(*) = 1
)