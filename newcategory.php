<?php
require_once 'dbconfig.php'; 
 
ini_set('max_execution_time', '0');

require 'functions.php'; 
 
$get_create_product_category_url = "catalog/categories";
$create_method = "POST";
$last_parent_name = 'First Category';
$create_product_category_id_data = array(
                "parent_id" => 0,
                "name" => "$last_parent_name",
                "is_visible" => true,
            );
$product_category_id_response = createProductCategory($get_create_product_category_url, $create_method, json_encode($create_product_category_id_data, JSON_PRETTY_PRINT));

echo "<pre>"; print_r($product_category_id_response); echo "</pre>";
echo "========================================================"."<br>";
//die(/);
$product_response_parent_id = $product_category_id_response['data']['id'];
$name = 'Sub First Category';

$create_product_category_response_id_data = array(
    "parent_id" => $product_response_parent_id,
    "name" => "$name",
    "is_visible" => true,
); 
echo "<pre>"; print_r($create_product_category_response_id_data); echo "</pre>";
$product_category_new_response = createProductCategory($get_create_product_category_url, $create_method, json_encode($create_product_category_response_id_data, JSON_PRETTY_PRINT));
          