<?php
session_start();
include('db_connection.php'); 
$id = trim($_GET['id']);
if(empty($id)){
    header("Location:index.php");
    exit;
}

$sql = "DELETE FROM to_do_list WHERE id='$id'";

if($conn->query($sql)===TRUE){
    $_SESSION['success'] = "Task delete successful";
}
else {
    $_SESSION['error'] = "Database error: " . $conn->error;
}

$conn->close();
header("Location:index.php");
exit;