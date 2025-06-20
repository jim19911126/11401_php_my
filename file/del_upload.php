<?php include_once "db.php";
$id = $_GET['id'] ?? null;
$row=find("uploads", $id);
del('uploads', $id);
header("location:manage.php?msg=檔案".$row['name']."刪除成功");