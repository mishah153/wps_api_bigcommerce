<?php 
require_once 'dbconfig.php';
error_reporting(0);
?>
<nav>
  <ul>
   <?php  
          $depths = 0;
          $sql = "SELECT * from category WHERE depths = :depths order by id  ";   
          $query = $dbconn->prepare($sql); 
          $query->bindparam(":depths",addslashes($depths));
          $query->execute(); 
          $results=$query->fetchAll(PDO::FETCH_OBJ); 
          $cnt=1;
          if($query->rowCount() != 0){  
              foreach($results as $result){
              ?>
                <li>
                    <a href="#"><?php echo $result->name; ?></a>
                    <?php 
                    $depths = 1;
                    $sql1 = "SELECT * from category WHERE depths = :depths AND parent_id = :parent_id order by id ";   
                    $query1 = $dbconn->prepare($sql1); 
                    $query1->bindparam(":depths",addslashes($depths));
                    $query1->bindparam(":parent_id",addslashes($result->cat_id));
                    $query1->execute(); 
                    $results1=$query1->fetchAll(PDO::FETCH_OBJ);   
                    if($query1->rowCount() != 0){  
                        ?><ul level1><?php 
                        foreach($results1 as $result1){ ?>
                            <li>
                              <a href="#"><?php echo $result1->name; ?></a>
                              <?php 
                                  $depths = 2;
                                  $sql2 = "SELECT * from category WHERE depths = :depths AND parent_id = :parent_id order by id ";   
                                  $query2 = $dbconn->prepare($sql2); 
                                  $query2->bindparam(":depths",addslashes($depths));
                                  $query2->bindparam(":parent_id",addslashes($result1->cat_id));
                                  $query2->execute(); 
                                  $results2=$query2->fetchAll(PDO::FETCH_OBJ);  
                                  if($query2->rowCount() != 0){  
                                      ?><ul level2><?php 
                                      foreach($results2 as $result2){ ?>
                                          <li>
                                            <a href="#"><?php echo $result2->name; ?></a>
                                            <?php 
                                                $depths = 3;
                                                $sql3 = "SELECT * from category WHERE depths = :depths AND parent_id = :parent_id order by id ";   
                                                $query3 = $dbconn->prepare($sql3); 
                                                $query3->bindparam(":depths",addslashes($depths));
                                                $query3->bindparam(":parent_id",addslashes($result2->cat_id));
                                                $query3->execute(); 
                                                $results3=$query3->fetchAll(PDO::FETCH_OBJ);  
                                                if($query3->rowCount() != 0){  
                                                    ?><ul level3><?php 
                                                    foreach($results3 as $result3){ ?>
                                                        <li>
                                                          <a href="#"><?php echo $result3->name; ?></a>
                                                          <?php 
                                                              $depths = 4;
                                                              $sql4 = "SELECT * from category WHERE depths = :depths AND parent_id = :parent_id  order by id ";   
                                                              $query4 = $dbconn->prepare($sql4); 
                                                              $query4->bindparam(":depths",addslashes($depths));
                                                              $query4->bindparam(":parent_id",addslashes($result3->cat_id));
                                                              $query4->execute(); 
                                                              $results4=$query4->fetchAll(PDO::FETCH_OBJ);  
                                                              if($query4->rowCount() != 0){  
                                                                  ?><ul level4><?php 
                                                                  foreach($results4 as $result4){ ?>
                                                                      <li>
                                                                        <a href="#"><?php echo $result4->name; ?></a>
                                                                      </li>
                                                                  <?php }
                                                                  ?>     
                                                                  </ul>
                                                                  <?php 
                                                                  }
                                                              ?>
                                                        </li>
                                                    <?php }
                                                    ?>     
                                                    </ul>
                                                    <?php 
                                                    }
                                                ?>
                                          </li>
                                      <?php }
                                      ?>     
                                      </ul>
                                      <?php 
                                      }
                                  ?>
                            </li>
                        <?php }
                        ?>     
                        </ul>
                        <?php 
                        }
                    ?>
                </li>
              <?php 
              } 
        }
      
   ?>
 </ul>
</nav>

<style>
  /*
ul {
    position: absolute;
    margin: 0;
    list-style:none;
    background: rgb(22, 160, 133);
}

li {
    display: inline-block;
    padding: 5px 10px;
    position: relative;
}
li:hover > ul {
    display: block;
}
ul ul {
    position: absolute;
    display: none;
    margin: 0;
    padding: 5px 10px;
}
ul ul li {
    display: block;
}

ul ul ul {
    position: absolute;
    top: 0;
    left: 100%;
} 
a{
  color: #FFF;
  text-decoration: none;
}
a:hover {
  border-bottom: 1px dashed #FFF;
} 

*/
 
</style>