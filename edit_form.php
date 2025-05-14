<?php
session_start();
include('db_connection.php');
$id = trim($_GET['id']);
if(empty($id)){
    header("location:index.php");
    exit;
}
$sql = "SELECT task_name, task_time FROM to_do_list WHERE id=$id";

$task = $conn->query($sql)->fetch_object();
$task_name_error = $_SESSION['errors']['task_name']??'';
$task_time_error = $_SESSION['errors']['task_time']??'';
unset($_SESSION['errors']);
$conn->close()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/edit_form_style.css">
    <link rel="stylesheet" href="css/style_de.css">
</head>
<body>
    <div class="container">
        <form action="create_task.php" method="post">
            <h1>Edit Task</h1>
            <?php if(isset($_SESSION['error'])): ?>
                <p class="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']) ?></p>
            <?php endif; ?>
            <div>
                <label for="">Task Name</label><br>
                <?php if($task_name_error!=''): ?>
                    <p class="alert"><?php echo $task_name_error;?></p>
                <?php endif ?>
                <input class="input_round" type="text" name="task_name" value="<?php echo $task->task_name; ?>">
            </div>
            <div>
                <label for="">Task Time</label><br>
                <?php if($task_time_error!=''): ?>
                    <p class="alert"><?php echo $task_time_error;?></p>
                <?php endif ?>
                <span><input class="input_round" type="number" name="task_time" value="<?php echo $task->task_time; ?>"> Hours</span>
            </div>
            <div >
                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>