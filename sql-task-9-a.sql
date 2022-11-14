SELECT property.name, property_value.value
FROM property_value
JOIN property ON property.id = property_value.property_id
WHERE property_value.product_id = 'ID товара'