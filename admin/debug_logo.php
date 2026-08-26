<?php
require_once '../app/db.php';
$stmt = $pdo->query("SELECT logo FROM settings WHERE id = 1");
$res = $stmt->fetch(PDO::FETCH_ASSOC);
echo "LOGO VALUE: [" . $res['logo'] . "]";
?>