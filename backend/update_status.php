<?php

require_once('connDB.php');

$id = intval($_GET['id']);
$status = intval($_GET['status']);

// Update status
try {
  $stmt = $db->prepare('UPDATE couponadmin SET usage_status = ? WHERE id = ?');
  $stmt->execute([$status == 0 ? 1 : 0, $id]);

  // Log success

  echo json_encode(['message' => 'Status updated successfully']);
} catch (PDOException $e) {
  http_response_code(500); // Internal server error
  echo json_encode(['message' => 'Error updating status: ' . $e->getMessage()]);
  exit();
}

?>
