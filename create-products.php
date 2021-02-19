<?php

error_reporting(0);
ini_set('max_execution_time', '0');

require 'functions.php';

//products
$get_products_url = $main_url . "products";
$get_products_with_data = getData($get_products_url);
$get_products_data = $get_products_with_data['data'];
$get_products_count = count($get_products_data);
$create_method = "POST";

if ($get_products_count > 0) {
    for ($i = 0; $i < $get_products_count; $i++) {

        $get_product_field = $get_products_data[$i];
        $item_id = $get_product_field['id'];
        $product_id = $get_product_field['product_id'];
        $product_description = $get_product_field['description'];

        //get products data
        $all_product_data_get_url = $main_url . "products/" . $item_id . "/items?include=attributevalues,attributevalues.attributekey,images,quantities";
        $all_product_data_with_data = getData($all_product_data_get_url);
        $get_all_products_data = $all_product_data_with_data['data'];

        for ($j = 0; $j < count($get_all_products_data); $j++) {

            $get_all_product_field = $get_all_products_data[$j];

            $price = ($get_all_product_field['list_price'] == "" ? 0.00 : $get_all_product_field['list_price']) * ($get_all_product_field['standard_dealer_price'] == "" ? 0.00 : $get_all_product_field['standard_dealer_price']);

            //get quantities data
            $get_all_product_quantities_data = $get_all_product_field['quantities']['data'];
            $count_all_product_quantities_data = count($get_all_product_quantities_data);
            $get_all_product_quantity_field = $get_all_product_quantities_data[$i];

            if ($count_all_product_quantities_data > 0) {
                $count_obtainable = 0;
                foreach ($get_all_product_quantities_data as $get_all_product_quantity_value) {
                    $count_obtainable = $count_obtainable + $get_all_product_quantity_value['obtainable'];
                }
            }

            $upc_value = $get_all_product_field['upc'] = "" ? "test upc" : $get_all_product_field['upc'];
            $search_keywords = $get_all_product_field['name'] = "" ? "search keywords" : $get_all_product_field['name'];

            //all brands create and get
            $brand_id = $get_all_product_field['brand_id'];
            //get brand name
            $get_brand_url = "http://api.wps-inc.com/brands/$brand_id";
            $get_brand_with_data = getData($get_brand_url);
            $get_brand_data = $get_brand_with_data['data'];
            $get_brand_count = count($get_brand_data);
            if ($get_brand_count > 0) {
                $brand_name = ucwords($get_brand_data['name']);
            }

            //get all products images and added in images
            $get_all_product_images_data = $get_all_product_field['images']['data'];
            $count_all_product_images_data = count($get_all_product_images_data);
            $get_all_product_image_field = $get_all_product_images_data[$i];
            $image_file_path = "http://" . $get_all_product_image_field['domain'] . $get_all_product_image_field['path'] . $get_all_product_image_field['filename'];


            //get vehicle year, model
            $get_vehicle_url = "http://api.wps-inc.com/vehicles?include=vehiclemodel.vehiclemake,vehicleyear";
            $get_vehicle_with_data = getData($get_vehicle_url);
            $get_vehicle_data = $get_vehicle_with_data['data'];

            $get_vehicle_count = count($get_vehicle_data);
            if ($get_vehicle_count > 0) {
                for ($k = 0; $k < $get_vehicle_count; $k++) {
                    $vehicle_model = $get_vehicle_data[$k]['vehiclemodel']['data']['name'];
                    $vehicle_make = $get_vehicle_data[$k]['vehiclemodel']['data']['vehiclemake']['data']['name'];
                    $vehicle_year = $get_vehicle_data[$k]['vehicleyear']['data']['name'];

                    $vehicle_model_field = $vehicle_model == '' ? '' : array("name" => "vehicle name", "value" => "$vehicle_model");
                    $vehicle_make_field = $vehicle_make == '' ? '' : array("name" => "vehicle make", "value" => "$vehicle_make");
                    $vehicle_year_field = $vehicle_year == '' ? '' : array("name" => "vehicle year", "value" => "$vehicle_year");
                }
            }
            $custom_fields = array($vehicle_model_field, $vehicle_make_field, $vehicle_year_field);


            //create products
            $product_name = ucwords($get_all_product_field['name']);
            $product_title = ucwords($brand_name . " " . $product_name);
            $ssku = "WPS-SK" . $get_all_product_field['sku']; 
            $page_title = $product_title;
            $meta_keywords = array('meta_keywords' => $product_name = "" ? "test meta " : $product_name);
            $meta_description = $brand_name . " makes the Best Selling " . $product_name . " in the Powersports Industry";

            $create_product_url = "catalog/products";
            $create_product_fields_data = array(
                'id' => $item_id,
                'brand_name' => "$brand_name",
                'name' => $product_title = "" ? rand(000000, 999999) : $product_title,
                'price' => $price,
                'cost_price' => 0.00,
//                "categories" => array(94),
                "categories" => array(51),
                'description' => "$product_description",
                'upc' => "$upc_value",
                'sku' => $ssku,
                'height' => $get_all_product_field['height'] = "" ? 0.00 : $get_all_product_field['height'],
                'weight' => $get_all_product_field['weight'] = "" ? 0.00 : $get_all_product_field['weight'],
                'width' => $get_all_product_field['width'] = "" ? 0.00 : $get_all_product_field['width'],
                'length' => $get_all_product_field['length'] = "" ? 0.00 : $get_all_product_field['length'],
                'depth' => $get_all_product_field['length'] = "" ? 0.00 : $get_all_product_field['length'],
                "type" => "physical",
                'inventory_tracking' => "product",
                'inventory_level' => $count_obtainable,
                'mpn' => $get_all_product_field['mpn'] = "" ? "test mpn string added" : $get_all_product_field['mpn'],
                'search_keywords' => "$search_keywords",
                'is_visible' => true,
                'is_free_shipping' => true,
                'page_title' => "$page_title",
                'meta_keywords' => $meta_keywords,
                'meta_description' => $meta_description,
                'custom_fields' => $custom_fields,
            );

            $create_product_response = createProduct($create_product_url, $create_method, json_encode($create_product_fields_data, JSON_PRETTY_PRINT));

            //create product images
            $new_product_id = $create_product_response['data']['id'];
            $create_product_image_url = "catalog/products/$new_product_id/images";
            $create_product_image_data = array(
                "product_id" => $new_product_id,
                "image_url" => "$image_file_path",
                "description" => "test description",
                "is_thumbnail" => true,
                "sort_order" => 0,
            );
            createProduct($create_product_image_url, $create_method, json_encode($create_product_image_data, JSON_PRETTY_PRINT));


            //get variants options and values data
            $get_all_product_variant_values_data = $get_all_product_field['attributevalues']['data'];
            $attribute_value_id = $get_all_product_variant_values_data[0]['id'];
            $attribute_value_name = $get_all_product_variant_values_data[0]['name'];
            $attribute_key_id = $get_all_product_variant_values_data[0]['attributekey']['data']['id'];
            $attribute_key_name = $get_all_product_variant_values_data[0]['attributekey']['data']['name'];
           // $explode_data_of_attribute_value_name = explode("/", 'ABC/DEF/HIF/DSHJ');
             $explode_data_of_attribute_value_name = explode("/", $attribute_value_name);
            if (count($explode_data_of_attribute_value_name) > 0) {
                $variant_option_values = array();
                for ($v = 0; $v < count($explode_data_of_attribute_value_name); $v++) {
                    $variant_option_values[] = array('label' => $explode_data_of_attribute_value_name[$v]);
                }
            }

            //create product variant options
            $create_product_variant_option_url = "catalog/products/$new_product_id/options";
            $create_product_variant_option_data = array(
                "product_id" => $new_product_id,
                "name" => "$attribute_key_name",
                "display_name" => "$attribute_key_name",
                "type" => "dropdown",
                "option_values" => $variant_option_values,
            );

            $create_product_variant_response = createProductVariantOption($create_product_variant_option_url, $create_method, json_encode($create_product_variant_option_data, JSON_PRETTY_PRINT));

            //create product variant
            $count_product_variant_response_data = count($create_product_variant_response['data']['option_values']);

            for ($l = 0; $l < $count_product_variant_response_data; $l++) {
                $new_option_id = $create_product_variant_response['data']['id'];
                $new_option_value_id = $create_product_variant_response['data']['option_values'][$l]['id'];
                $new_variant_option_values = array('id' => $new_option_value_id, 'option_id' => $new_option_id);


                $create_product_variant_url = "catalog/products/$new_product_id/variants";

                $create_product_variant_data = array(
                    "sku" => "New" . rand(000000, 999999),
                    "option_values" => array($new_variant_option_values),
                    "cost_price" => $price,
                    'height' => $get_all_product_field['height'] = "" ? 0.00 : $get_all_product_field['height'],
                    'weight' => $get_all_product_field['weight'] = "" ? 0.00 : $get_all_product_field['weight'],
                    'width' => $get_all_product_field['width'] = "" ? 0.00 : $get_all_product_field['width'],
                    'length' => $get_all_product_field['length'] = "" ? 0.00 : $get_all_product_field['length'],
                    'inventory_tracking' => "product",
                    'inventory_level' => $count_obtainable,
                        //                'image_url' => "$image_file_path",
                );

                $variant_response = createProductVariant($create_product_variant_url, $create_method, json_encode($create_product_variant_data, JSON_PRETTY_PRINT));
            }
        }
    }
}
?>
