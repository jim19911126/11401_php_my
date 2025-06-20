<?php
function dd($data)
{
    echo "<pre>";
    // print_r($data);
    var_dump($data);
    echo "</pre>";
}

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$sum = $_POST['num1'] + $_POST['num2'];

echo "總合為 {$sum}";

echo "<script>console.log('num1 {$num1}');</script>";
echo "<script>console.log('num2 {$num2}');</script>";
echo "<script>console.log('sum {$sum}');</script>";

$input = $_POST;
dd($input);