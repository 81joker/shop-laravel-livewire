#Quick Database Diagrams

# Users Table
users
----
id PK int
name varchar
email string
password varchar


# Products Table
products
----
id PK int
name varchar
description text
price integer
main_image_id int FK >- images.id
created_at timestamp
updated_at timestamp


# Product Variants Table
product_variants
----
id PK int
product_id int FK >- products.id
color varchar 
size varchar 


# Carts Table
carts
----
id PK int
user_id int FK >- users.id
session_id varchar 


# Cart Items Table
cart_items
----
id PK int
cart_id int FK >- carts.id
product_variant_id int FK >- product_variants.id
quantity integer

# Images Table
images
----
id PK int
product_id int FK >- products.id
featured boolean 
path varchar
