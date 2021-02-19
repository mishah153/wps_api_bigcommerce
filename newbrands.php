<?php
require_once 'dbconfig.php'; 
 
ini_set('max_execution_time', '0');

require 'functions.php'; 
 
 
for($k=0;$k<=150;$k++){
	if($k == 0){
		$final_url = $main_url . "brands";
		$fetch = getData($final_url);
		$data = $fetch['data'];
		$meta = $fetch['meta'];
		if(!empty($meta)){
			$_SESSION['cursor'] = $meta['cursor'];
			$_SESSION['first_current'] = $cursor['cursor'];
			$_SESSION['first_first_prev'] = $cursor['prev'];
			$_SESSION['first_next'] = $cursor['next'];
			$_SESSION['first_count'] = $cursor['count'];  
		}else{ 

		}
		if(!empty($data)){
			insert_data($data,$dbconn);	
		}
		
	}else{ 
		$cursor = $_SESSION['cursor'];
		$first_current = $_SESSION['first_current'];
		$first_first_prev = $_SESSION['first_first_prev'];
		$first_next = $_SESSION['first_next'];
		$first_count = $_SESSION['first_count']; 
		$final_url = $main_url . "brands?page[cursor]=".$first_next;
		$fetch = getData($final_url);
		$data = $fetch['data'];
		$meta = $fetch['meta']; 
		if(!empty($meta)){
			$cursor = $meta['cursor'];
			$_SESSION['first_current'] = $cursor['cursor'];
			$_SESSION['first_first_prev'] = $cursor['prev'];
			$_SESSION['first_next'] = $cursor['next'];
			$_SESSION['first_count'] = $cursor['count']; 
			if($cursor['next'] == '' || $cursor['next'] == NULL || $cursor['next'] == 'null'){
				unset($_SESSION);
			}
		}else{
			 
		} 
		if(!empty($data)){
			insert_data($data,$dbconn);	
		} 
	} 
	echo "first_next=".$first_next."<br>"; 
} 


function insert_data($data,$dbconn){
	//echo "<pre>"; print_r($data); echo "</pre>"; die; 
	$array_data = array();
	foreach($data as $key => $value){  
		$brand_id = $value['id'];
		$name = $value['name']; 
		$created_at = $value['created_at'];
		$updated_at = $value['updated_at'];  

		 	
		 	$sql = "SELECT * from brand WHERE brand_id = :brand_id ";   
            $query = $dbconn->prepare($sql); 
            $query->bindparam(":brand_id",addslashes($brand_id));
            $query->execute(); 
            $results=$query->fetchAll(PDO::FETCH_OBJ); 
            $cnt=1;
            if($query->rowCount() == 0){ 
				$sql="INSERT INTO brand(brand_id,name,created_at,updated_at) VALUES(:brand_id,:name,:created_at,:updated_at)";  

				$query = $dbconn->prepare($sql);  
				$query->bindparam(":brand_id",addslashes($brand_id));  
				$query->bindparam(":name",addslashes($name));  
				$query->bindparam(":created_at",addslashes($created_at)); 
				$query->bindparam(":updated_at",addslashes($updated_at));   
				$query->execute();   
				$lastInsertId = $dbconn->lastInsertId(); 
            }

			
		 
		   
	}

}


 
 
?>
