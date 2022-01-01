<?php  include "includes/db.php"; ?>
<?php  //include "includes/header.php"; ?>
<?php include "admin/functions.php"; ?>
<?php // include ""; ?>
<?php
   $query = "SELECT * FROM questions";
   $select_questions= mysqli_query($connection,$query);
   confirmQuery($select_questions);
   $q=0;
   while($row= mysqli_fetch_assoc($select_questions))
   {
      
       $Q_content = $row['Q_content'];
       $Option_1 = $row['Option_1'];
       $Option_2= $row['Option_2'];
       $Option_3 = $row['Option_3'];
       $Option_4 = $row['Option_4'];        
      
          echo "<h3>$Q_content</h3>";
          echo "<div class='form-group'> <ol>";
          $Q_ans=$row['Q_ans'];
          $qq= $_POST["$q"];
          if($qq==$Q_ans){
             if($qq == $Option_1){
              echo "<li><input type='radio' name='{$q}' value='{$Option_1}' checked />$Option_1 <b style='color:green'>correct answer</b></li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_2}' />$Option_2</li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_3}' />$Option_3</li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_4}' />$Option_4</li>";
             }
             else if($qq==$Option_2){
              echo "<li><input type='radio' name='{$q}' value='{$Option_1}' />$Option_1 </li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_2}' checked />$Option_2 <b style='color:green'>correct answer</b></li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_3}' />$Option_3</li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_4}' />$Option_4</li>";
             }
             else if($qq==$Option_3){
              echo "<li><input type='radio' name='{$q}' value='{$Option_1}' />$Option_1 </li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_2}'  />$Option_2</li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_3}' checked />$Option_3 <b style='color:green'>correct answer</b></li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_4}' />$Option_4</li>";
             }
             else{
              echo "<li><input type='radio' name='{$q}' value='{$Option_1}' />$Option_1 </li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_2}'  />$Option_2</li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_3}' />$Option_3</li>";
              echo "<li><input type='radio' name='{$q}' value='{$Option_4}' checked/>$Option_4 <b style='color:green'>correct answer</b></li>";
             }
       }
       else{  
       if($qq == $Option_1){
          echo "<li><input type='radio' name='{$q}' value='{$Option_1}' checked />$Option_1 <b style='color:red'>Wrong answer</b></li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_2}' />$Option_2</li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_3}' />$Option_3</li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_4}' />$Option_4</li>";
         }
         else if($qq==$Option_2){
          echo "<li><input type='radio' name='{$q}' value='{$Option_1}' />$Option_1 </li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_2}' checked />$Option_2 <b style='color:red'>Wrong answer</b></li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_3}' />$Option_3</li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_4}' />$Option_4</li>";
         }
         else if($qq==$Option_3){
          echo "<li><input type='radio' name='{$q}' value='{$Option_1}' />$Option_1 </li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_2}'  />$Option_2</li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_3}' checked />$Option_3 <b style='color:red'>Wrong answer</b></li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_4}' />$Option_4</li>";
         }
         else{
          echo "<li><input type='radio' name='{$q}' value='{$Option_1}' />$Option_1 </li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_2}'  />$Option_2</li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_3}' />$Option_3</li>";
          echo "<li><input type='radio' name='{$q}' value='{$Option_4}' checked/>$Option_4 <b style='color:red'>wrong answer</b></li>";
         }


       }
          
          echo "</ol> </div>";
          $q++; 
   }  

         ?>