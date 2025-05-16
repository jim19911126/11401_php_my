<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container {
        width: 400px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fefefe;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        font-family: "Segoe UI", sans-serif;
    }

    input {
        margin: 10px 0;
        padding: 6px;
        width: 80%;
    }

    input[type="submit"],
    input[type="reset"] {
        width: 40%;
    }
</style>

<body>

    <div class="container">

        <h2>BMI 計算機</h2>

        <form action="bmi.php" method='post'>
            <div>
                <label for="height">身高(公尺):</label>
                <input type="number" name="height" step="0.01" min="0" required>
            </div>
            <div>
                <label for="weight">體重(公斤):</label>
                <input type="number" name="weight" step="0.1" required>
            </div>
            <br>
            <input type="submit" value="計算BMI">
            <input type="reset" value="清空內容">
        </form>
    </div>


</body>

</html>