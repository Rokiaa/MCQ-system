<form action="" method="post">
            <div class="form-group">
                <label for="cat-title">Edit Question</label>
                <?php 
                if(isset($_GET['edit']))
                {
                    $Q_id=$_GET['edit'];
                    
                    $query= "SELECT * FROM questions WHERE Q_id= $Q_id"; //"SELECT * FROM categories LIMIT 3" to show only 3 
                    $select_Q_id= mysqli_query($connection,$query);
                    while($row= mysqli_fetch_assoc($select_Q_id))
                    {
                    $Q_id = $row['Q_id'];
                    $Q_content = $row['Q_content'];
                    $Option_1 = $row['Option_1'];
                    $Option_2 = $row['Option_2'];
                    $Option_3 = $row['Option_3'];
                    $Option_4= $row['Option_4'];
                    $Q_ans = $row['Q_ans'];
                    ?>
                    
                   <input value= "<?php if(isset($Q_content)) {echo $Q_content;} ?>" type="text" class= "form-control" name= "Q_content">
                   <input value= "<?php if(isset($Option_1)) {echo $Option_1;} ?>" type="text" class= "form-control" name= "Option_1">
                   <input value= "<?php if(isset($Option_2)) {echo $Option_2;} ?>" type="text" class= "form-control" name= "Option_2">
                   <input value= "<?php if(isset($Option_3)) {echo $Option_3;} ?>" type="text" class= "form-control" name= "Option_3">
                   <input value= "<?php if(isset($Option_4)) {echo $Option_4;} ?>" type="text" class= "form-control" name= "Option_4">
                   <input value= "<?php if(isset($Q_ans)) {echo $Q_ans;} ?>" type="text" class= "form-control" name= "Q_ans">
                   <?php  } }   ?>

                   <?php  
                   //////////////UPDATE QUERY/////////////
                    if (isset($_POST['update_question']))
                    {
                        $Q_content=$_POST['Q_content'];
                        $Option_1=$_POST['Option_1'];
                        $Option_2=$_POST['Option_2'];
                        $Option_3=$_POST['Option_3'];
                        $Option_4=$_POST['Option_4'];
                        $Q_ans=$_POST['Q_ans'];

                        $stmt= mysqli_prepare($connection, "UPDATE questions SET Q_content=?, Option_1=?, Option_2=?, Option_3=?, Option_4=?, Q_ans=? WHERE Q_id=?"); //we pass ? 
                        mysqli_stmt_bind_param($stmt, "ssssssi", $Q_content, $Option_1, $Option_2, $Option_3,$Option_4, $Q_ans, $Q_id);  // 's' --> string instead of $cat_title  and 'i' --> integer instead of cat_id
                        mysqli_stmt_execute($stmt);
                        //$query= "UPDATE categories SET cat_title='{$cat_title}' WHERE cat_id={$cat_id}";
                       // $update_query=mysqli_query($connection,$query);
                        if(! $stmt)
                        {
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        mysqli_stmt_close($stmt);  // close statment to close the DB connection
                        redirect("questions.php");
                    }

                   
                   ?>



                
            </div>
            <div class="form-group">
                <input class= "btn btn-primary" type="submit" name= "update_question" value="Update Qusetion">
            </div>
        </form>