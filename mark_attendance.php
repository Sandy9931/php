<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // Check if record already exists for the date
    $stmt = $pdo->prepare("SELECT * FROM attendance WHERE user_id = ? AND date = ?");
    $stmt->execute([$user_id, $date]);
    $existing_record = $stmt->fetch();

    if ($existing_record) {
        // Update existing record
        $stmt = $pdo->prepare("UPDATE attendance SET status = ? WHERE id = ?");
        $stmt->execute([$status, $existing_record['id']]);
    } else {
        // Insert new record
        $stmt = $pdo->prepare("INSERT INTO attendance (user_id, date, status) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $date, $status]);
    }

    header('Location: dashboard.php');
    exit();
}
?>
