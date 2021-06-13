<?php
session_start();

include "config.php";

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])){
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $role = test_input($_POST['role']);

    if (empty($username)){
        header ("Location: index.php?error=Username is Required");
    }else if (empty($password)) {
        header ("Location: index.php?error=Password is Required");
    }else {
        //Hashing the password
        $password = md5($password);

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) === 1){
            //the user must be unique
            $row = mysqli_fetch_assoc($result);
           if ($row['password'] === $password && $row['role'] == $role){
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['username'] = $row['username'];

                if($_SESSION['role'] === 'admin'){
                    header("Location: question.php");
                } else if($_SESSION['role'] === 'student'){ 
                    header("Location: menu.php");
                } else {
                    header("Location: staff.php");
                }
        } else {
            header ("Location: index.php?error=Incorrect Username or Password");
        }
    }  else {
        header ("Location: index.php?error=Incorrect Username or Password");
    }
}

} else {
    header("Location: index.php");
}
?>