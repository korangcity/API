# About Project

This API project supports :


## Register User
For this purpose, it's expected 4 items
- name
- email
- password (password must be atleast 8 characters)
- password_confirmation


## Login User
  For this purpose, it's expected 2 items
- email
- password

## Create Product
For this purpose, it's expected 3 items
- name
- price
- inventory


## Update Product
For this purpose, it's expected 4 items
- name
- price
- inventory
- product_id


## Create Order
For this purpose, it's expected 3 items
- user_id
- product_id(array of products)
- count(array of products count)

## Update Order
For this purpose, it's expected 3 items
- order_id
- product_id(array of products)
- count(array of products count)

## All of route are in api file
