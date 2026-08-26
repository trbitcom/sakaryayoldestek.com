<?php
require_once '../app/db.php';
$stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($settings);
echo "</pre>";
?>