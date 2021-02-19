<?php

error_reporting(0);
ini_set('max_execution_time', '0');

require 'functions.php';

//product categories
$get_product_category_url = $main_url . "taxonomyterms";
$get_product_category_with_data = getData($get_product_category_url);
$get_product_category_data = $get_product_category_with_data['data'];

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

            $last_parent_id = $get_product_category_id_data['id'];
            $last_parent_name = $get_product_category_id_data['name'];

            $create_product_category_id_data = array(
                "parent_id" => 0,
                "name" => "$last_parent_name",
                "is_visible" => true,
            );
            // $product_category_id_response = createProductCategory($get_create_product_category_url, $create_method, json_encode($create_product_category_id_data, JSON_PRETTY_PRINT));
            echo '<pre>-------'."<br>";
            print_r($product_category_id_response);
//            die(/);
            $product_response_parent_id = $product_category_id_response['data']['id'];
            $create_product_category_response_id_data = array(
                "parent_id" => $product_response_parent_id,
                "name" => "$name",
                "is_visible" => true,
            );

            $product_category_new_response = createProductCategory($get_create_product_category_url, $create_method, json_encode($create_product_category_response_id_data, JSON_PRETTY_PRINT));
            echo '<pre>';
            print_r($product_category_new_response);
//            die();
        }
        $create_product_category_data = array(
            "parent_id" => $product_parent_id != null ? $product_parent_id : 0,
            "name" => "$name",
            "is_visible" => true,
        );

        $product_category_response = createProductCategory($get_create_product_category_url, $create_method, json_encode($create_product_category_data, JSON_PRETTY_PRINT));
        echo '<pre>';
        print_r($product_category_response);
//        die();
    }
}
?>
