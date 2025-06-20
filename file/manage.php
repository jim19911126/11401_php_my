<?php
/**
 * 1.建立資料庫及資料表來儲存檔案資訊
 * 2.建立上傳表單頁面
 * 3.取得檔案資訊並寫入資料表
 * 4.製作檔案管理功能頁面
 */


?>
<?php include_once "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案管理功能</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 80%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            padding: 14px 18px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            font-size: 16px;
        }
        .table th {
            background: #f5f6fa;
            color: #333;
            font-weight: 600;
        }
        .table tr:hover {
            background: #eaf6ff;
            transition: background 0.2s;
        }
        .table img {
            border-radius: 6px;
            border: 1px solid #ddd;
            background: #fafafa;
        }
        button {
            padding: 7px 18px;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            margin: 0 3px;
            transition: background 0.2s, color 0.2s;
        }
        button:first-child {
            background: #27ae60;
            color: #fff;
        }
        button:first-child:hover {
            background: #219150;
        }
        button:last-child {
            background: #e74c3c;
            color: #fff;
        }
        button:last-child:hover {
            background: #c0392b;
        }
        .header {
            text-align: center;
            margin-top: 30px;
            color: #222;
            font-size: 2em;
            letter-spacing: 2px;
        }
        .add-file {
            display: block;
            width: 150px;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.2s, color 0.2s;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1 class="header">檔案管理練習</h1>
<!----建立上傳檔案表單及相關的檔案資訊存入資料表機制----->

<a class='add-file' href="upload.php">新增檔案</a>
<?php 

$rows=all("uploads");

if(isset($_GET['msg'])){
    echo "<h2 style='color:pink;text-align:center'>".$_GET['msg']."</h2>";
}

?>
<style>
.pages {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 30px auto 20px auto;
    gap: 8px;
    width: 80%;
}
.pages a {
    display: inline-block;
    padding: 7px 16px;
    margin: 0 2px;
    background: #f5f6fa;
    color: #3498db;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    border: 1px solid #dbeafe;
    transition: background 0.2s, color 0.2s, border 0.2s;
}
.pages a:hover, .pages a.active {
    background: #3498db;
    color: #fff;
    border: 1px solid #3498db;
}
</style>

<?php 
$total_rows=$pdo->query("select count(*) from uploads")->fetchColumn();
$div=5; //每頁顯示的資料筆數
$pages=ceil($total_rows/$div); //總頁數
$now=$_GET['p']??1; //目前頁數
$start=($now-1)*$div; //起始位置

$rows=all("uploads"," limit $start,$div");

?>

<div class="pages">
    <a href="?p=1">第一頁</a>
    <div>
    <?php 
    
    if($now-1>0){
        echo "<a href='?p=".($now-1)."'> << </a>";
    } else {
        echo "<a href='#'> << </a>";
    }
    
    for($i=1;$i<=$pages;$i++){
        echo "<a href='?p=$i'>$i</a>";
    }


    if($now+1<=$pages){
        echo "<a href='?p=".($now+1)."'> >> </a>";
    } else {
        echo "<a href='#'> >> </a>";
    }
    ?>
    </div>
    <a href="?p=<?=$pages;?>">最後頁</a>
</div>

<!-- table.table>(tr>th*5)+(tr>td*5) -->
 <table class="table">
    <tr>
        <th>序號</th>
        <th>縮圖</th>
        <th>檔名</th>
        <th>類型</th>
        <th>操作</th>
    </tr>
    <?php foreach($rows as $key => $row): ?>
    <tr>
        <td><?=$row['id'];?></td>
        <td>
        <?php
         if($row['type']=='image'){
            //如果是圖片就顯示縮圖
            echo "<img src='./files/".$row['name']."' style='width:100px;'>";
            } else {

                switch($row['type']){
                    case 'document':
                        echo "<img src='icon/document.png' style='width:50px;'>";
                        break;
                    case 'video':
                        echo "<img src='icon/video.png' style='width:50px;'>";
                        break;
                    case 'music':
                        echo "<img src='icon/music.png' style='width:50px;'>";
                        break;
                    default:
                        echo "<img src='icon/others.png' style='width:50px;'>";
                }
            }

        ?>
            
        
        </td>
        <td><?=$row['name'];?></td>
        <td><?=$row['type'];?></td>
        <td>
            <button onclick="location.href='edit_upload.php?id=<?=$row['id'];?>'">編輯</button>
            <button class="del" data-id="<?=$row['id'];?>">刪除</button>
        </td>
    </tr>
    <?php endforeach; ?>
 </table>
<div class="pages">
    <a href="?p=1">第一頁</a>
    <div>
    <?php 
    
    if($now-1>0){
        echo "<a href='?p=".($now-1)."'> << </a>";
    } else {
        echo "<a href='#'> << </a>";
    }
    
    for($i=1;$i<=$pages;$i++){
        echo "<a href='?p=$i'>$i</a>";
    }


    if($now+1<=$pages){
        echo "<a href='?p=".($now+1)."'> >> </a>";
    } else {
        echo "<a href='#'> >> </a>";
    }
    ?>
    </div>
    <a href="?p=<?=$pages;?>">最後頁</a>
</div>
<!----透過資料表來顯示檔案的資訊，並可對檔案執行更新或刪除的工作----->

<script>
$(".del").on("click",function(){
        if(confirm("確定要刪除這個檔案嗎？")){
            location.href="del_upload.php?id="+$(this).data("id");
        }   
})
</script>


</body>
</html>