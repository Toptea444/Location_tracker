<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM ip_history ORDER BY created_at DESC");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
?>
