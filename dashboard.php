<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch attendance records for the logged-in user
$stmt = $pdo->prepare("SELECT * FROM attendance WHERE user_id = ?");
$stmt->execute([$user_id]);
$attendance_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Welcome, <?php echo $username; ?></h2>

<h3>Attendance Records:</h3>
<table border="1">
    <tr>
        <th>Date</th>
        <th>Status</th>
    </tr>
    <?php foreach ($attendance_records as $record): ?>
    <tr>
        <td><?php echo $record['date']; ?></td>
        <td><?php echo $record['status']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>Mark Attendance:</h3>
<form method="POST" action="mark_attendance.php">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
    <label>Date:</label>
    <input type="date" name="date" required><br><br>
    
    <label>Status:</label>
    <select name="status" required>
        <option value="present">Present</option>
        <option value="absent">Absent</option>
    </select><br><br>
    
    <input type="submit" value="Submit">
</form>
