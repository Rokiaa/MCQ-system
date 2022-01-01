<?php  include "../includes/db.php"; ?>
<?php  include "../includes/header.php"; ?>
<?php include "../admin/functions.php"; ?>

<?php 
 if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role']== 'admin')
    {
        redirect('../admin/admin.php');
    }
    else 
    {
        
        if(isset($_POST['submit'])) {
        
            $name = $_POST['name'];
        
            // the message
        $msg = "The test finished my name is {$name}";
        $msg = wordwrap($msg,70);
        $mail= "rokaelsharkawy81@gmail.com";
        mail($mail,"Test Complation",$msg);
        
            
            $email = $_POST['email'];
            if($name == '' || $email == '') {
                echo '<h2>Please fill all fields.</h2>';
            }
                $query = "SELECT * FROM questions";
                $select_questions= mysqli_query($connection,$query);
                confirmQuery($select_questions);
                $score = 0;  $q=0; $c=0;
               
                while($row= mysqli_fetch_assoc($select_questions))
                {
                    $Q_ans=$row['Q_ans'];
                    $qq= $_POST["$q"];
                     if($qq==$Q_ans)
                     {$score++;}
                     $q++; $c++;
                 }  
                 $x=$c -$score;
                 echo "
                 <h1 align='center'>Results</h1>
                 <h1>Total Questions: {$c}</h1>
                 <h1>True Answers: {$score}</h1>
                 <h1>Wrong Answers:   {$x}</h1>
                 <hr style='border: 1px solid black;'>
                 <center><h1>Review test answers</h1></center>";
                 //echo $mark = "{$score} / {$c}"   ;
                 
                 $query = "INSERT INTO tests(username,user_email,right_ans,wrong_ans,marks) VALUES ('{$name}','{$email}',$score,$x,$score)";
                 $add_user= mysqli_query($connection,$query);
                 confirmQuery($add_user);
                 
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
                $_SESSION['username']=null;
                $_SESSION['firstname']=null;
                $_SESSION['lastname']=null;
                $_SESSION['user_role']=null;
                 return 0;
        }
        ?>
        
        <html>
        <head>
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>
        <body>
        <div class="container">
        <h1>Multiple Choice Questions Answers</h1>
        <p>Please fill the details and answers the all questions-</p>
        <form action="" method="post">
        <div class="form-group">
        <strong>Name:</strong><br/>
         <input type="text" name="name" value="" required/>
        </div>
        <div class="form-group">
        <strong>Email:</strong><br/> 
        <input type="text" name="email" value="" required/>
        </div>
        
        <!-- /////////////////////////////////////////////////////////////////////////// -->
        <?php 
                global $connection;
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
                    ?>
                      <?php
                       echo "<h3>$Q_content</h3>";
                       echo "<div class='form-group'> <ol>";
                       echo "<li><input type='radio' name='{$q}' value='{$Option_1}' />$Option_1 </li>";
                       echo "<li><input type='radio' name='{$q}' value='{$Option_2}' />$Option_2</li>";
                       echo "<li><input type='radio' name='{$q}' value='{$Option_3}' />$Option_3</li>";
                       echo "<li><input type='radio' name='{$q}' value='{$Option_4}' />$Option_4</li>";
                       echo "</ol> </div>";
                       $q++; 
                      
                }  ?>
        <div class="form-group">
        <input type="submit" value="Submit" name="submit" class="btn btn-primary"/>
        </div> 
        </form>
        </div>
        </body>
        </html>
        <?php   }
 
}
 else {redirect('../index.php');}

?>
