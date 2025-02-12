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
