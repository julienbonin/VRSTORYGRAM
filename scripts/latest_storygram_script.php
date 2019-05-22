<?php

include "db_connection.php";

$sql = "SELECT uri FROM isvr_spaces WHERE status = 'published' Order By created_at DESC LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->execute();

$title = $stmt->fetch(PDO::FETCH_ASSOC);

echo $title['uri'];
?>
