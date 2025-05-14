<?php
session_start();
include('db_connection.php');
$task_name = trim($_POST['task_name']);
$task_time = trim($_POST['task_time']);
$id = trim($_POST['id']);
if(empty($id)){
    header("Location:index.php");
    exit;
}

if (empty($task_name)) {
    $_SESSION['errors']['task_name'] = "Task Name is Required";
}
if (empty($task_time)) {
    $_SESSION['errors']['task_time'] = "Task Time is Required";
}

if (!empty($_SESSION['errors'])) {
    header("Location: edit_form.php?id=$id");
    exit;
}

$sql = "UPDATE to_do_list SET task_name='$task_name', task_time='$task_time' WHERE id='$id'";

if($conn->query($sql)===TRUE){
    $_SESSION['success'] = "Task Update successful";
}
else {
    $_SESSION['error'] = "Database error: " . $conn->error;
}

$conn->close();
header("Location:index.php");
exit;
