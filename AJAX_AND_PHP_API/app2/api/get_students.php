<?php include_once "db.php";

$classroom=$_GET['classroom']??'101';

$student=$stu->all(
    ['classroom'=>$classroom]
);

foreach ($student as $key => $student) {
    $student[$key]['classname']=$ref[$student['classroom']];
    # code...
}


header('Content-Type: application/json;');
echo json_encode($student);

?>