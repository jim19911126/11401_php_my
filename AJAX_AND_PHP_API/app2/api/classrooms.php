<?php include_once "db.php";

$sql="select classroom from students group by classroom";
$classroom=q($sql);

$ref=[
    '101'=>'一年一班',
    '102'=>'一年二班',
    '103'=>'一年三班',
    '104'=>'一年四班',
    '105'=>'一年五班',
    '106'=>'一年六班',
    '107'=>'一年七班',
    '108'=>'一年八班',
    '109'=>'一年九班',
    '110'=>'一年十班',
];
foreach($classrooms as $key => $classroom){
    $classrooms[$key]['name']=$ref[$classroom['classroom']];
}

header('Content-Type: application/json;');
echo json_encode($classroom);

?>