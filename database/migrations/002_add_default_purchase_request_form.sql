-- Add the default "Purchase Request" form and its fields

-- First, insert the form definition
INSERT INTO forms (id, name, description) VALUES (1, 'Purchase Request', 'Use this form to request a new product purchase.');

-- Then, add the fields associated with this form
INSERT INTO form_fields (form_id, label, field_type, field_name, is_required, sort_order) VALUES
(1, 'Product Name', 'text', 'product_name', 1, 10),
(1, 'Brand (Optional)', 'text', 'brand', 0, 20),
(1, 'Quantity', 'text', 'quantity', 1, 30), -- Storing as text for now, will add number type later
(1, 'Technical Specifications and Description', 'textarea', 'product_description', 0, 40);
