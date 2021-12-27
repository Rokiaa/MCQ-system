<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
        <?php    insert_question();      ?>
    
        <form action="" method="post">
            <div class="form-group">
                <label for="cat-title">Add Question</label>
                <input type="text" class= "form-control" name= "Q_content" placeholder="Enter the content ">
                <input type="text" class= "form-control" name= "Option_1" placeholder="Enter the first option">
                <input type="text" class= "form-control" name= "Option_2" placeholder="Enter the second option">
                <input type="text" class= "form-control" name= "Option_3" placeholder="Enter the third option">
                <input type="text" class= "form-control" name= "Option_4" placeholder="Enter the forth option">
                <input type="text" class= "form-control" name= "Q_ans" placeholder="Enter the answer">
            </div>
            <div class="form-group">
                <input class= "btn btn-primary" type="submit" name= "submit" value="Add Question">
            </div>
        </form>

        <?php 
         if(isset($_GET['edit']))
         {
             $Q_id=$_GET['edit'];
             include "includes/update_questions.php";
         }
        
        ?>





        </div> <!-- add category form -->
        <div class="col-xs-6">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Question Content</th>
                        <th>Option_1</th>
                        <th>Option_2</th>
                        <th>Option_3</th>
                        <th>Option_4</th>
                        <th>Question Answer</th>
                    </tr>
                </thead>
                <tbody>
    <?php findAllQuestions() ?> <!--FIND ALL CATEGORIES QUEREY-->
    <?php  deleteQuestions() //Delete Query ?>
  
                                    </tbody>
                                </table>
                            </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>