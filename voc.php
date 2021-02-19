<?php

error_reporting(0);
ini_set('max_execution_time', '0');

require 'functions.php'; 
$ids = $_REQUEST['ids'];
//get product count product categories
$get_1_level = $main_url . "vocabularies/".$ids."/taxonomyterms";
$get_1_data = getData($get_1_level);
$get_1_details = $get_1_data['data'];
 
echo "<pre>"; print_r($get_1_data); echo "</pre>";die; 
 
 
?>
