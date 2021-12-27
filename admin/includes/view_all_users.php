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

<table class="table table-bordered table-hover" > 
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                    <th></th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                        
                                </tr>
                            </thead>
                            <tbody>
        <?php 

        global $connection;
        $query= "SELECT * FROM users";
        $select_users= mysqli_query($connection,$query);
        confirmQuery($select_users);
        while($row= mysqli_fetch_assoc($select_users))
        {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role= $row['user_role'];
            
            echo "<tr>";
               echo "<td>$user_id</td>";
               echo "<td>$username</td>" ;
               echo "<td>$user_firstname</td>";
               echo "<td>$user_lastname</td>";
               echo "<td>$user_email</td>";
               echo "<td>$user_role</td>";
               echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>"; 
               echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
               echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
              echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
              
            echo "</tr>";
        }

        ?>
                            </tbody>
                        </table>
                    </div></div></div></div></div></div></div>


<?php 

if(isset($_GET['change_to_admin']))
{
    $the_user_id = $_GET['change_to_admin'];
    $query= "UPDATE users SET user_role='admin' WHERE user_id=$the_user_id";
    $change_to_admin_query= mysqli_query($connection,$query);
    header("Location: users.php");
}

if(isset($_GET['change_to_sub']))
{
    $the_user_id = $_GET['change_to_sub'];
    $query= "UPDATE users SET user_role= 'subscriber' WHERE user_id=$the_user_id";
    $change_to_sub_query= mysqli_query($connection,$query);
    header("Location: users.php");
}

if(isset($_GET['delete']))
{
    if(isset($_SESSION['user_role']))
    {
        if($_SESSION['user_role'] == 'admin'){
            $the_user_id =mysqli_real_escape_string($connection,$_GET['delete']) ;
            $query= "DELETE FROM users WHERE user_id ={$the_user_id}";
            $delete_user_query= mysqli_query($connection,$query);
            header("Location: users.php");
}
    }
}


?>