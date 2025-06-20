<?php
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯資料</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #4a4a4a;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
 <h1 class="header">編輯資料</h1>
 <!----建立你的表單及設定編碼----->
<?php 
include_once "db.php";

    $row=find("uploads",$_GET['id']);

?>
<form action="save_upload.php" method="post" enctype="multipart/form-data">
    <?php 
    switch($row['type']) {
        case 'image':
            echo "<img src='./files/{$row['name']}' alt='檔案預覽' style='max-width: 200px; max-height: 200px;'>";
            break;
        case 'document':
            echo "<img src='./icon/document.png' alt='文件預覽' style='max-width: 64px; max-height: 64px;'>";
            break;
        case 'video':
            echo "<img src='./icon/video.png' alt='影片預覽' style='max-width: 64px; max-height: 64px;'>";
            break;
        case 'music':
            echo "<img src='./icon/music.png' alt='音樂預覽' style='max-width: 64px; max-height: 64px;'>";
            break;
        default:
            echo "<img src='./icon/others.png' alt='未知檔案類型' style='max-width: 64px; max-height: 64px;'>";
    }
    ?>

    <label for="name">選擇檔案上傳：</label>
    <input type="file" name="name" id="name" required>
    <br>
    <select name="type" id="type">
        <option value="image" <?=($row['type']=='image')?'selected':'';?>>影像</option>
        <option value="document" <?=($row['type']=='document')?'selected':'';?>>文件</option>
        <option value="video" <?=($row['type']=='video')?'selected':'';?>>影片</option>
        <option value="music" <?=($row['type']=='music')?'selected':'';?>>音樂</option>
    </select>
    <br>
    <textarea name="description" id="description"><?=$row['description'];?></textarea>
    <br>
    <input type="hidden" name="id" value="<?=$row['id'];?>">
    <button type="submit">上傳檔案</button>
</form>



<!----建立一個連結來查看上傳後的圖檔---->  


</body>
</html>