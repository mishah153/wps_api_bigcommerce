<?php

error_reporting(0);
ini_set('max_execution_time', '0');

require 'functions.php';

 


//product categories
$get_product_category_url = $main_url . "brands";
$get_product_category_with_data = getData($get_product_category_url);
$get_product_category_data = $get_product_category_with_data['data'];
echo "<pre>"; print_r($get_product_category_data); echo "</pre>"; 
die;
$get_product_category_count = count($get_product_category_data);
$create_method = "POST";

if ($get_product_category_count > 0) {
    for ($i = 0; $i < $get_product_category_count; $i++) {

        $get_product_category_field = $get_product_category_data[$i];

        $get_create_product_category_url = "catalog/categories";
        $item_id = $get_product_category_field['id'];
        $product_parent_id = $get_product_category_field['parent_id'];
        $name = $get_product_category_field['name'];

        if ($product_parent_id != null || $product_parent_id != 0) {
            //product categories search by ids
            $get_product_category_id_url = $main_url . "taxonomyterms/$product_parent_id";
            $get_product_category_id_with_data = getData($get_product_category_id_url);
            $get_product_category_id_data = $get_product_category_id_with_data['data'];

            
        }
         
         
    }
}
?>
