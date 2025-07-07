<?php include_once "db.php";

$Stu->save($_POST);

header("Content-Type: application/json;");
echo json_encode(['success'=>true]);

?>