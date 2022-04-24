<?php  
 $connect = mysqli_connect("localhost", "root", "", "dictionary");  
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM `wn_synset` WHERE  word='".$_POST["query"]."' OR word LIKE '%".$_POST["query"]."%' GROUP BY word LIMIT 25";
      $result = mysqli_query($connect, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li data-wid="'.$row["synset_id"].'" data-wnum="'.$row["w_num"].'">'.$row["word"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>Word Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  