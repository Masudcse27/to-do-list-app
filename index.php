<?php 
session_start();
include('db_connection.php');
$sql = "SELECT id, task_name, task_time FROM to_do_list";
$task_list = $conn->query($sql);
$conn->close();
$task_name = $_SESSION['old']['task_name']??'';
$task_time = $_SESSION['old']['task_time']??'';
$task_name_error = $_SESSION['errors']['task_name']??'';
$task_time_error = $_SESSION['errors']['task_time']??'';
unset($_SESSION['errors'],$_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_de.css">
     <link rel="stylesheet" href="css/index_style.css">
</head>
<body>
    <div class="container">
        <form action="create_task.php" method="post">
            <h1>Add a New Task</h1>
            <?php if(isset($_SESSION['error'])): ?>
                <p class="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']) ?></p>
            <?php endif; ?>
            <div>
                <label for="">Task Name</label><br>
                <?php if($task_name_error!=''): ?>
                    <p class="alert"><?php echo $task_name_error;?></p>
                <?php endif ?>
                <input class="input_round" type="text" name="task_name" value="<?php echo $task_name; ?>">
            </div>
            <div>
                <label for="">Task Time</label><br>
                <?php if($task_time_error!=''): ?>
                    <p class="alert"><?php echo $task_time_error;?></p>
                <?php endif ?>
                <span><input class="input_round" type="number" name="task_time" value="<?php echo $task_time; ?>"> Hours</span>
            </div>
            <div >
                <button class="btn" type="submit">Add Task</button>
            </div>
        </form>
        <div class="table_container">
            <table>
                <tr>
                    <th>Task</th>
                    <th>Task Time</th>
                    <th>Action</th>
                </tr>
                <?php 
                    if($task_list && $task_list->num_rows>0):
                        while($task = $task_list->fetch_object()):
                ?>
                <tr>
                    <td><?php echo $task->task_name ?></td>
                    <td><?php echo $task->task_time ?></td>
                    <td> <a href="edit_form.php?id=<?php echo $task->id; ?>" class="btn">edit</a> <a href="#" class="btn_delete">delete</a></td>
                </tr>
                <?php endwhile; endif; ?>
            </table>
        </div>
    </div>
</body>
</html>