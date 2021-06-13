<?php

session_start();

$mysqli = new mysqli('localhost','root','','personality') or die(mysqli_error($mysqli));

$id = 0;
$update = FALSE;
$category = '';
$question = '';

if (isset($_POST['save'])){
    $category = $_POST['category'];
    $question = $_POST['question'];

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: question.php");

    $mysqli->query("INSERT INTO question (category,question) VALUES ('$category','$question')") or 
    die($mysqli->error);
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM question WHERE id=$id") 
    or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "warning";


    header("location: question.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = TRUE;
    $result = $mysqli->query("SELECT * FROM question WHERE id=$id") or die($mysqli->error());
    if ($result->num_rows){
        $row = $result->fetch_array();
        $category = $row['category'];
        $question = $row['question'];
    }

}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $category = $_POST['category'];
    $question = $_POST['question'];

    $mysqli->query("UPDATE question SET category = '$category', question = '$question' WHERE id=$id") or
    die($mysqli->error);

    $_SESSION['message'] = "Record has been updated! ";
    $_SESSION['msg_type'] = "warning";

    header("location: question.php");
}



?>
