<?php
session_start();
include('db_connection.php');

$task_name = trim($_POST['task_name']);
$task_time = trim($_POST['task_time']);

if (empty($task_name)) {
    $_SESSION['errors']['task_name'] = "Task Name is Required";
}
if (empty($task_time)) {
    $_SESSION['errors']['task_time'] = "Task Time is Required";
}

if (!empty($_SESSION['errors'])) {
    $_SESSION['old'] = ['task_name' => $task_name, 'task_time' => $task_time];
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("INSERT INTO to_do_list (task_name, task_time) VALUES (?, ?)");

if ($stmt) {
    $stmt->bind_param("ss", $task_name, $task_time);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Task created successfully.";
    } else {
        $_SESSION['error'] = "Task creation failed: " . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Database error: " . $conn->error;
}

$conn->close();
header("Location: index.php");
exit;
