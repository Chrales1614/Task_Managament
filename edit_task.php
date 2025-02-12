<?php
include('db.php');

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title='$title', description='$description', due_date='$due_date', 
            priority='$priority', status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch the current task details
$sql = "SELECT * FROM tasks WHERE id=$id";
$result = $conn->query($sql);
$task = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>
        <form method="POST">
            <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
            <input type="date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" required>
            <select name="priority" required>
                <option value="Low" <?php echo ($task['priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
                <option value="Medium" <?php echo ($task['priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                <option value="High" <?php echo ($task['priority'] == 'High') ? 'selected' : ''; ?>>High</option>
            </select>
            <select name="status" required>
                <option value="To Do" <?php echo ($task['status'] == 'To Do') ? 'selected' : ''; ?>>To Do</option>
                <option value="In Progress" <?php echo ($task['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                <option value="Done" <?php echo ($task['status'] == 'Done') ? 'selected' : ''; ?>>Done</option>
            </select>
            <button type="submit" class="btn">Update Task</button>
        </form>
    </div>
</body>
</html>
