<?php 
session_start(); 
include "db_conn.php";
     //creating variables for username and data 
if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data){
        //code should not have special characters, username ans passwors is in the correct format 
       $data = trim($data); 
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
        //check if the username and passwords are valid 
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
         //check if the username field is not empty 
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
         //check if the password field is not empty 
    }else if(empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    }else{
        //send a query: check for valis username and password in the db 
        //sql stands for structure query language 
        //$ = the data the user enters. therefor user_name is the one in the db and $uname is the one the user enters 
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
        //if the username ans pass. match the uname and pass from db, then log in 
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                echo "Logged in!";
        //if pass n uname are correct = create session 
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
                exit();
        //else senf an error message 
            }
            else{
                header("Location: index.php?error=Incorect User name or password");
                exit();
            }
    ¨
        }}else{
    header("Location: index.php");
    exit();
}