<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php include "admin/functions.php"; ?>

 <?php 

if($_SERVER['REQUEST_METHOD'] == "POST") //isset($_POST['register']) //another way to avoid couple of complications out especially with the internet explorer
{
   $username= trim($_POST['username']) ;
   $email =  trim($_POST['email'] ) ;
   $password=  trim($_POST['password']) ;

   $error = [
       'username'=> '',
       'email' => '',
       'password'=>''
   ];
   
   if(empty($username)){
       $error['username']= 'Username cannot be empty';
   }

   if(strlen($username)< 4 && strlen($username) >0){
       $error['username']= 'Username need to be longer';
   }

   
   if(username_exists($username)){
       $error['username']= 'Username already exists, pick another';
   }

   if(empty($email)){
       $error['email']= 'Email cannot be empty';
   }
   if(email_exists($email)){
       $error['email']= 'Email already exists, <a href="login.php">Please Login </a>';
   }
   if($password == '')
   {
       $error['password']='Password cannot be empty';
   }
   //clean all errors
   foreach($error as $key => $value){
       if(empty($value)){
           unset($error[$key]);
       }
   } // foreach

   if(empty($error)){
       register_user($username, $email, $password);

       login_user($username,$password);
   }

}
 
 
 ?>

 
    <!-- Page Content -->
    <div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="signup.php" method="post" id="login-form" autocomplete="off">
                  
                    <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" 
                            autocomplete="on" 
                            value="<?php echo isset($username)? $username : '' ?>">
                            <p><?php echo isset($error['username'])? $error['username'] : '' ?></p>
                    </div> 
                        
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                             autocomplete="on"
                             value="<?php echo isset($email)? $email : '' ?>">
                            <p> <?php echo isset($error['email'])? $error['email'] : '' ?> </p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Enter password">
                            <p> <?php echo isset($error['password'])? $error['password'] : '' ?> </p>
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-primary btn-lg btn-block" value="register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

  <!-- Footer -->
  <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; MCQ by rokia</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

