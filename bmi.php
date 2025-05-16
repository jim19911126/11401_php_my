<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算BMI</title>
</head>

<body>

    <?php

    if (isset($_POST['height'])) {
        echo "身高為:" . $_POST['height'] . "<br>";
    }

    if (isset($_POST['weight'])) {
        echo "體重為:" . $_POST['weight'] . "<br>";
    }

    
    $bmi = round($_POST['weight'] / ($_POST['height'] * $_POST['height']), 2);
echo "BMI為: " . $bmi . "<br>";
    ?>

    <a href="index.php">返回首頁</a>


</body>

</html>