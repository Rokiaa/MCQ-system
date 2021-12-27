<?php 

function currentUser(){
    if(isset($_SESSION['username'])){
        return $_SESSION['username'];
    } 
    return false;
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD']== strtoupper($method)){
        return true;
    }
    return false;
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}
function query($query){
    global $connection;
    $result=mysqli_query($connection,$query);
    confirmQuery($result);
    return $result;
}

function fetchRecords($result){
    return mysqli_fetch_array($result);
}


function is_admin()
{
    global $connection;
    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id=".$_SESSION['user_id']."");
        // $result =mysqli_query($connection, $query);
        // confirmQuery($result);
       $row = fetchRecords($result);
       //var_dump($username);
      // var_dump($row); 
        if(! empty($row) && is_array($row) && isset($row['user_role']) && $row['user_role']== 'admin')
        {
            return true;
        } else { 
            return false;
        }

    } return false;
   
}



function login_user($username,$password){
    global $connection;

    $username = trim($username);
    $password = trim($password);
    //to avoid injection
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);

    $query= "SELECT * FROM users WHERE username='{$username}'";
    $select_user_query= mysqli_query($connection,$query);
    if(! $select_user_query)
    {
        die("Query Failed". mysqli_error($connection));
    }

    while($row= mysqli_fetch_array($select_user_query))
    {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    if(password_verify($password, $db_user_password)){
        $_SESSION['user_id']=$db_user_id;
        $_SESSION['username']=$db_username;
        $_SESSION['firstname']=$db_user_firstname;
        $_SESSION['lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;
       if($db_user_role == 'admin') {
        redirect("/MCQ/admin/admin.php");
       }
       else {
        redirect("/MCQ/index.php");

       }
        

    }
    else{
        false;
    }

    } return true;
  
}

//============DATABASE HELPER FUNCTIONS =======/
function redirect($location){
    header("Location:". $location);
   exit;
}

// function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
//     if(isLoggedIn()){
//         redirect($redirectLocation);
//     }
// }


function confirmQuery($result)
{
    global $connection;
    if(! $result)
{
    die("Failed Query".mysqli_error($connection));
}

} 
function email_exists($email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email='$email'";
    $result = mysqli_query($connection,$query);
    confirmQuery($result);
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
} 


function username_exists($username){

    global $connection;
    $query = "SELECT username FROM users WHERE username='$username'";
    $result = mysqli_query($connection,$query);
    confirmQuery($result);
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
}

function register_user($username, $email, $password){
    global $connection;
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $password = password_hash($password, PASSWORD_BCRYPT,array('cost'=> 12));
        $query= "INSERT INTO users (username, user_email, user_password, user_role) VALUES ('{$username}','{$email}','{$password}','subscriber') "; //user_role --> access
        $register_user_query = mysqli_query($connection, $query);
        confirmQuery($register_user_query);

   

}

function escape($string){  //adding this function to anywhere you have DB
    global $connection;
    return mysqli_real_escape_string($connection,trim($string) );
}
 
function insert_question(){
    if(isset($_POST['submit']))
    {
        global $connection;
        $Q_content= escape($_POST['Q_content']);
        $Option_1= escape($_POST['Option_1']);
        $Option_2= escape($_POST['Option_2']);
        $Option_3= escape($_POST['Option_3']);
        $Option_4= escape($_POST['Option_4']);
        $Q_ans= escape($_POST['Q_ans']);
        if($Q_content == "" || empty($Q_content) || $Option_1 == "" || empty($Option_1) || $Option_2 == "" || empty($Option_2)|| $Option_3 == "" || empty($Option_3) || $Option_4== "" || empty($Option_4)  || $Q_ans == "" || empty($Q_ans))
        {
            echo "this field should not empty";
        }
        else 
        {
            // 1- prepare    2- bind     3- execute
            $stmt= mysqli_prepare($connection, "INSERT INTO questions(Q_content, Option_1, Option_2, Option_3, Option_4, Q_ans) VALUES (?,?,?,?,?,?)"); //we pass ? 
            mysqli_stmt_bind_param($stmt, "ssssss", $Q_content, $Option_1, $Option_2, $Option_3, $Option_4,$Q_ans);  // 's' --> string
            mysqli_stmt_execute($stmt);
           // $create_category_query= mysqli_query($connection,$query);
            if(! $stmt)
            {die('query failed'. mysqli_error($connection));}
        } mysqli_stmt_close($stmt);
    }
    
}


function findAllQuestions(){
    global $connection;
            $query= "SELECT * FROM questions"; //"SELECT * FROM categories LIMIT 3" to show only 3 
            $select_questions= mysqli_query($connection,$query);
            while($row= mysqli_fetch_assoc($select_questions))
            {
                $Q_id = $row['Q_id'];
                $Q_content = $row['Q_content'];
                $Option_1 = $row['Option_1'];
                $Option_2 = $row['Option_2'];
                $Option_3  = $row['Option_3'];
                $Option_4  = $row['Option_4'];
                $Q_answer = $row['Q_ans'];
                echo "<tr>";
                echo "<td> {$Q_id} </td>";
                echo "<td> {$Q_content} </td>";
                echo "<td> {$Option_1} </td>";
                echo "<td> {$Option_2} </td>";
                echo "<td> {$Option_3} </td>";
                echo "<td> {$Option_4} </td>";
                echo "<td> {$Q_answer} </td>";
                echo "<td> <a href='questions.php?delete={$Q_id}'>Delete</a> </td>";
                echo "<td> <a href='questions.php?edit={$Q_id}'>Edit</a> </td>";
                echo "</tr>";
            }

}

function deleteQuestions(){
    global $connection;
    if (isset($_GET['delete']))
    {
        $the_Q_id=escape($_GET['delete']);
        $query= "DELETE FROM questions WHERE Q_id={$the_Q_id}";
        $delete_query=mysqli_query($connection,$query);
        header("Location: questions.php"); //to refresh the page
    }
    

}

function get_user_name(){
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}

function recordCount($table){
    global $connection;
    $query="SELECT * FROM ". $table;
    $select_all_posts= mysqli_query($connection,$query);
    //to count the n.of rows(the num of posts)
    $result= mysqli_num_rows($select_all_posts);
    confirmQuery($result);
    return $result;
}
