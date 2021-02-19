<?php  
	include_once 'dbconfig.php';  	
	if(isset($_POST['submit'])){ 
		$filename=$_FILES["uploadcsv"]["tmp_name"];	 
		if($_FILES["uploadcsv"]["size"] > 0)
		{ 
			 
			$file = fopen($filename, "r");
			$i=0;
			$numbers=1;
			$makeArray = NULL;
			while (($getData = fgetcsv($file, 100000000, ",")) !== FALSE)
			{ 
				 
				 if($i != 0 && $i > 0  && $i <= 100000) 
				 {   			   
					//$sku = clean($getData[0]);					   
					$sku = $getData[0];					   
					$name =  $getData[1];	
					$list_price =  $getData[2];	
					$standard_dealer_price =  $getData[3];	
					$brand =  $getData[4];	
					$vendor_number =  $getData[5];	
					$status =  $getData[6];					   
					$upc =  $getData[7];	
					$length =  $getData[8];	
					$width =  $getData[9];	
					$height =  $getData[10];	
					$weight =  $getData[11];	
					$has_map_policy =  $getData[12];	
					$country_of_origin_code =  $getData[13];	
					$country_of_origin_name =  $getData[14];	
					$superseded_sku =  $getData[15];	
					$product_name =  $getData[16];	
					$product_description =  $getData[17];	
					$product_features =  $getData[18];	
					$primary_item_image =  $getData[19];	
					$street_catalog =  $getData[20];	
					$offroad_catalog =  $getData[21];	
					$snow_catalog =  $getData[22];	
					$atv_catalog =  $getData[23];	
					$watercraft_catalog =  $getData[24];	
					$bicycle_catalog =  $getData[25];	
					$flyracing_catalog =  $getData[26];	
					$harddrive_catalog =  $getData[27];	
					$apparel_catalog =  $getData[28];	 
					

					$sql3 = "SELECT * from master_product WHERE sku = '".addslashes($sku)."'";   
					$query3 = $dbconn->prepare($sql3); 
					$query3->execute(); 
					$results=$query3->fetchAll(PDO::FETCH_OBJ); 
					$newsku = $results[0]->sku;
					if($newsku == '' ){
						if($sku != '' ){
							$sql="INSERT INTO master_product(
							sku,
							name,
							list_price,
							standard_dealer_price,
							brand,
							vendor_number,
							status,
							upc,
							length,
							width,
							height,
							weight,
							has_map_policy,
							country_of_origin_code,
							country_of_origin_name,
							superseded_sku,
							product_name,
							product_description,
							product_features,
							primary_item_image,
							street_catalog,
							offroad_catalog,
							snow_catalog,
							atv_catalog,
							watercraft_catalog,
							bicycle_catalog,
							flyracing_catalog,
							harddrive_catalog,
							apparel_catalog ) 
							VALUES(
							:sku,
							:name,
							:list_price,
							:standard_dealer_price,
							:brand,
							:vendor_number,
							:status,
							:upc,
							:length,
							:width,
							:height,
							:weight,
							:has_map_policy,
							:country_of_origin_code,
							:country_of_origin_name,
							:superseded_sku,
							:product_name,
							:product_description,
							:product_features,
							:primary_item_image,
							:street_catalog,
							:offroad_catalog,
							:snow_catalog,
							:atv_catalog,
							:watercraft_catalog,
							:bicycle_catalog,
							:flyracing_catalog,
							:harddrive_catalog,
							:apparel_catalog )"; 
							$query = $dbconn->prepare($sql); 					
							$query->bindparam(":sku",addslashes($sku));
							$query->bindparam(":name",addslashes($name));
							$query->bindparam(":list_price",addslashes($list_price));                
							$query->bindparam(":standard_dealer_price",addslashes($standard_dealer_price));
							$query->bindparam(":brand",addslashes($brand));
							$query->bindparam(":vendor_number",addslashes($vendor_number));
							$query->bindparam(":status",addslashes($status));
							$query->bindparam(":upc",addslashes($upc));
							$query->bindparam(":length",addslashes($length));
							$query->bindparam(":width",addslashes($width));
							$query->bindparam(":height",addslashes($height));
							$query->bindparam(":weight",addslashes($weight));
							$query->bindparam(":has_map_policy",addslashes($has_map_policy));
							$query->bindparam(":country_of_origin_code",addslashes($country_of_origin_code));
							$query->bindparam(":country_of_origin_name",addslashes($country_of_origin_name));
							$query->bindparam(":superseded_sku",addslashes($superseded_sku));
							$query->bindparam(":product_name",addslashes($product_name));
							$query->bindparam(":product_description",addslashes($product_description));
							$query->bindparam(":product_features",addslashes($product_features));
							$query->bindparam(":primary_item_image",addslashes($primary_item_image));
							$query->bindparam(":street_catalog",addslashes($street_catalog));
							$query->bindparam(":offroad_catalog",addslashes($offroad_catalog));
							$query->bindparam(":snow_catalog",addslashes($snow_catalog));
							$query->bindparam(":atv_catalog",addslashes($atv_catalog));
							$query->bindparam(":watercraft_catalog",addslashes($watercraft_catalog));
							$query->bindparam(":bicycle_catalog",addslashes($bicycle_catalog));
							$query->bindparam(":flyracing_catalog",addslashes($flyracing_catalog));
							$query->bindparam(":harddrive_catalog",addslashes($harddrive_catalog));
							$query->bindparam(":apparel_catalog",addslashes($apparel_catalog)); 
							$query->execute(); 					
							$lastInsertId = $dbconn->lastInsertId(); 
						}
					} 
					
					   
				 }
				 $i++; 
			 }
		}
	}  

	function clean($string) {
	   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.

	   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

?>  
<form name="uploadform" id="uploadform" action="import_master_product.php" method="POST" enctype="multipart/form-data" >
	<input type="file" name="uploadcsv" id="uploadcsv">
	<input type="submit" name="submit" id="submit" >
</form>