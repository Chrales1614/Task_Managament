<?php
include 'database.php';

$filter_status = isset($_GET['status']) ? $_GET['status'] : '';
$filter_priority = isset($_GET['priority']) ? $_GET['priority'] : '';
$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'due_date';

$sql = "SELECT * FROM tasks WHERE 1";

if (!empty($filter_status)) {
    $sql .= " AND status = '" . $conn->real_escape_string($filter_status) . "'";
}
if (!empty($filter_priority)) {
    $sql .= " AND priority = '" . $conn->real_escape_string($filter_priority) . "'";
}

$sql .= " ORDER BY " . $conn->real_escape_string($sort_by);


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
</head>
<body>
    <h2>Task List</h2>
    <form method="GET">
        <label>Filter by Status:</label>
        <select name="status">
            <option value="">All</option>
            <option value="To do">To do</option>
            <option value="In progress">In progress</option>
            <option value="Done">Done</option>
        </select>
        
        <label>Filter by Priority:</label>
        <select name="priority">
            <option value="">All</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
        
        <label>Sort by:</label>
        <select name="sort">
            <option value="due_date">Due Date</option>
            <option value="priority">Priority</option>
            <option value="status">Status</option>
        </select>
        
        <button type="submit">Apply</button>
    </form>
    
    <table border="1">
        <tr>
            <th>Task</th>
            <th>Due Date</th>
            <th>Priority</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['task_name']); ?></td>
                <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                <td><?php echo htmlspecialchars($row['priority']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
