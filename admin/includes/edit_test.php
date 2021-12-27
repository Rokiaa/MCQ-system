<form action="" method="post">
            <div class="form-group">
                <label for="test-title">Edit Test</label>
                <?php 

if(isset($_GET['p_id'])){
    $the_user_id = $_GET['p_id'];

}

                // if(isset($_GET['edit']))
                // {
                //     $Q_id=$_GET['edit'];
                    
                    $query= "SELECT * FROM tests WHERE user_id= $the_user_id"; //"SELECT * FROM categories LIMIT 3" to show only 3 
                    $select_user_id= mysqli_query($connection,$query);
                    while($row= mysqli_fetch_assoc($select_user_id))
                    {
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_email = $row['user_email'];
                    $right_ans = $row['right_ans'];
                    $wrong_ans = $row['wrong_ans'];
                    $marks= $row['marks'];
                    ?>
                    
                   <input value= "<?php if(isset($username)) {echo $username;} ?>" type="text" class= "form-control" name= "username">
                   <input value= "<?php if(isset($user_email)) {echo $user_email;} ?>" type="text" class= "form-control" name= "user_email">
                   <input value= "<?php if(isset($right_ans)) {echo $right_ans;} ?>" type="text" class= "form-control" name= "right_ans">
                   <input value= "<?php if(isset($wrong_ans)) {echo $wrong_ans;} ?>" type="text" class= "form-control" name= "wrong_ans">
                   <input value= "<?php if(isset($marks)) {echo $marks;} ?>" type="text" class= "form-control" name= "marks">
                   <?php  }// }   ?>

                   <?php  
                   //////////////UPDATE QUERY/////////////
                    if (isset($_POST['update_test']))
                    {
                        $username=$_POST['username'];
                        $user_email=$_POST['user_email'];
                        $right_ans=$_POST['right_ans'];
                        $wrong_ans=$_POST['wrong_ans'];
                        $marks=$_POST['marks'];

                        $stmt= mysqli_prepare($connection, "UPDATE tests SET username=?, user_email=?, right_ans=?, wrong_ans=?, marks=? WHERE user_id=?"); //we pass ? 
                        mysqli_stmt_bind_param($stmt, "ssiiii", $username, $user_email, $right_ans, $wrong_ans,$marks, $user_id);  // 's' --> string instead of $cat_title  and 'i' --> integer instead of cat_id
                        mysqli_stmt_execute($stmt);
                        //$query= "UPDATE categories SET cat_title='{$cat_title}' WHERE cat_id={$cat_id}";
                       // $update_query=mysqli_query($connection,$query);
                        if(! $stmt)
                        {
                            die("QUERY FAILED".mysqli_error($connection));
                        }
                        mysqli_stmt_close($stmt);  // close statment to close the DB connection
                        redirect("view_all_tests.php");
                    }

                   
                   ?>



                
            </div>
            <div class="form-group">
                <input class= "btn btn-primary" type="submit" name= "update_test" value="Update Test">
            </div>
        </form>