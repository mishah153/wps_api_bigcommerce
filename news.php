<?php
require_once 'dbconfig.php'; 
 
ini_set('max_execution_time', '0');

require 'functions.php'; 
 
 
for($k=0;$k<=75;$k++){
	if($k == 0){
		$final_url = $main_url . "taxonomyterms";
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
		$final_url = $main_url . "taxonomyterms?page[cursor]=".$first_next;
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
		$cat_id = $value['id'];
		$vocabulary_id = $value['vocabulary_id'];
		$parent_id = $value['parent_id'] ? $value['parent_id'] : '0';
		$name = $value['name'];
		$slug = $value['slug'];
		$description = $value['description'];
		$link = $value['link'];
		$link_target_blank = $value['link_target_blank'];
		$lefts = $value['left'];
		$rights = $value['right'];
		$depths = $value['depth'];
		$created_at = $value['created_at'];
		$updated_at = $value['updated_at'];  

		 	
		 	$sql = "SELECT * from category WHERE cat_id = :cat_id ";   
            $query = $dbconn->prepare($sql); 
            $query->bindparam(":cat_id",addslashes($cat_id));
            $query->execute(); 
            $results=$query->fetchAll(PDO::FETCH_OBJ); 
            $cnt=1;
            if($query->rowCount() == 0){ 
				$sql="INSERT INTO category(cat_id,vocabulary_id,parent_id,name,slug,description,link,link_target_blank,lefts,rights,depths,created_at,updated_at) VALUES(:cat_id,:vocabulary_id,:parent_id,:name,:slug,:description,:link,:link_target_blank,:lefts,:rights,:depths,:created_at,:updated_at)";  

				$query = $dbconn->prepare($sql);  
				$query->bindparam(":cat_id",addslashes($cat_id)); 
				$query->bindparam(":vocabulary_id",addslashes($vocabulary_id)); 
				$query->bindparam(":parent_id",addslashes($parent_id)); 
				$query->bindparam(":name",addslashes($name)); 
				$query->bindparam(":slug",addslashes($slug)); 
				$query->bindparam(":description",addslashes($description)); 
				$query->bindparam(":link",addslashes($link)); 
				$query->bindparam(":link_target_blank",addslashes($link_target_blank)); 
				$query->bindparam(":lefts",addslashes($lefts)); 
				$query->bindparam(":rights",addslashes($rights)); 
				$query->bindparam(":depths",addslashes($depths)); 
				$query->bindparam(":created_at",addslashes($created_at)); 
				$query->bindparam(":updated_at",addslashes($updated_at));   
				$query->execute();   
				$lastInsertId = $dbconn->lastInsertId(); 
            }

			
		 
		   
	}

}


 
 
?>
