<?php 
session_start();

unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
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
                <input class="input_round" type="text" name="task_name">
            </div>
            <div>
                <label for="">Task Time</label><br>
                <span><input class="input_round" type="number" name="task_time"> Hours</span>
            </div>
            <div >
                <button class="btn" type="submit">Add Task</button>
            </div>
        </form>
        <table>
            <tr>
                <th>Task</th>
                <th>Task Time</th>
                <th>Action</th>
            </tr>
        </table>
    </div>
</body>
</html>