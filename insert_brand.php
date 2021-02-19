<?php 
require_once 'dbconfig.php';
error_reporting(0);
$bigcommerce_api_url = "catalog/brands";
$api_method = "POST";
require 'functions.php'; 
?>
<nav>
  <ul>
   <?php  
          $depths = 0;
          $sql = "SELECT * from brand  order by id DESC LIMIT 600 , 200";   
          $query = $dbconn->prepare($sql);  
          $query->execute(); 
          $results=$query->fetchAll(PDO::FETCH_OBJ); 
		      //echo "<pre>"; print_r($results); echo "</pre>"; die;
          $cnt=1;
          if($query->rowCount() != 0){  
              foreach($results as $result){
              ?>
                 
                    <?php 
                    /* start new category level 1*/ 
                    $category_name_1 = stripslashes($result->name);
                    $newnames = strtolower($category_name_1);
                    $cat_names = str_replace(" ", "-", $newnames);
                    $cat_names = str_replace("&", "-", $cat_names); 

                    $final_url = "/brands/".$cat_names."/";
                    $meta_keywordarray[] = array();
                    $category_data_1 = array(
                                    "custom_url" => array("url"=>$final_url), 
                                    "name" => $category_name_1,
                                );
 
                    $product_category_response_1 = createBrand($bigcommerce_api_url, $api_method, json_encode($category_data_1, JSON_PRETTY_PRINT));
                    $category_data_level1 = $product_category_response_1['data']['id'];
                    echo "<pre>"; print_r($product_category_response_1); echo "</pre>";

                  } 
                } 
                    /* end new category level 1*/
                    ?>

                     