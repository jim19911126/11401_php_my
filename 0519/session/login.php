<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
</head>
<body>
    <form action="check.php" method='post'>
        <div>
            <label for="acc">帳號:</label>
            <input type="text" name="acc" step="0.01" min="0" required>
        </div>
        <div>
            <label for="pw">密碼:</label>
            <input type="text" name="pw">
        </div>

        <input type="submit" value="登入">
        <input type="reset" value="清空內容">
    </form>

    
</body>
</html>

