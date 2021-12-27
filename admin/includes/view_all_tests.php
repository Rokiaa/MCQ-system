<?php include "../functions.php"; 
$connection= mysqli_connect('localhost','root','','MCQ');
$query = "SET NAMES utf8";
mysqli_query($connection,$query); ?>
<?php session_start(); ?>

<?php 
if(! isset($_SESSION['user_role']))
{
   
        header("Location: ../index.php");
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="../css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
 <!-- <link rel="stylesheet" href="css/summernote.css">
 <link rel="stylesheet" href="css/summernote.min.css"> -->




    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="../js/jquery.js"></script>

    
</head>

<body>

<div id="wrapper">
    <!-- Navigation -->
    <?php include "admin_navigation.php"; ?>
    <div id="page-wrapper">

            <div class="container-fluid">

    <div class="row">
    <div class="col-lg-9 col-md-6">
        <!-- <div class="panel panel-primary">
            <div class="panel-heading"> -->
                <div class="row">
                    <div class="col-xs-6">

<form action="" method="post">

<table class="table table-bordered table-hover"> 
                   
<thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>User_email</th>
                                    <th>Right_ans</th>
                                    <th>Wrong_ans</th>
                                    <th>Marks</th>
                                    <th>Edite</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
        <?php 
       // $user = currentUser();
       global $connection;
        $query = "SELECT * FROM tests";
        $select_tests= mysqli_query($connection,$query);
        confirmQuery($select_tests);
        while($row= mysqli_fetch_assoc($select_tests))
        {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_email = $row['user_email'];
            $right_ans = $row['right_ans'];
            $wrong_ans = $row['wrong_ans'];
            $marks = $row['marks'];

            echo "<tr>";
            ?>
               <?php
               echo "<td>$user_id</td>";
               echo "<td>$username</td>";
               echo "<td>$user_email</td>";
               echo "<td>$right_ans</td>";
               echo "<td>$wrong_ans</td>";
               echo "<td>$marks</td>";
               echo "<td><a class='btn btn-info' href='tests.php?source=edit_test&p_id={$user_id}'>Edit</a></td>"; 
               ?>
               <form action="" method="post">
                   <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                   <?php 
                     echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                   ?>
               </form>
               <?php
            echo "</tr>";
        }

        ?>
                            </tbody>
                        </table>
                        </form>
                    </div>  </div> </div> </div> </div></div></div>


<?php 

if(isset($_POST['delete']))
{
    $the_user_id= $_POST['user_id'];
    $query= "DELETE FROM tests WHERE user_id ={$the_user_id}";
    $delete_query= mysqli_query($connection,$query);
    header("Location: view_all_tests.php");
}
?>


<script>
    $(document).ready(function(){

        $(".delete_link").on('click', function(){
            var id= $(this).attr("rel");
            var delete_url = "posts.php?delete="+ id +" ";

            $(".modal_delete_link").attr("href", delete_url);

            $("#myModal").modal('show');

        });


    });
</script>
