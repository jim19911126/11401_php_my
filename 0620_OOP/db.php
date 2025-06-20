<?php 
$dsn="mysql:host=localhost;dbname=files;charset=utf8";
$pdo=new PDO($dsn,'root','');

/*
all($table, $array = null, $str = null)
$table: 資料表名稱 (string)
$array: 條件陣列 (array|null)，可選，若為陣列則產生 WHERE 條件
$str: 其他SQL語法 (string|null)，可選，附加在SQL語句後
回傳: 查詢結果的關聯式陣列
*/
function all($table,$array=null,$str=null){
    global $pdo;
   
    $sql="SELECT * FROM $table ";

        if(is_array($array)){
            $tmp=array2sql($array);
            $sql = $sql ." WHERE ".join(" AND ", $tmp);
        }else{
            $sql .= $array;
        }

        $sql .= $str;
 
    // echo $sql;
    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;

}

/*
dd($array)
$array: 要輸出的陣列 (array)
功能: 以pre格式印出陣列內容，方便除錯
*/
function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

/*
find($table, $id)
$table: 資料表名稱 (string)
$id: 主鍵值或條件陣列 (int|string|array)
    - 若為陣列，則產生多條件查詢
    - 若為單一值，則以id欄位查詢
回傳: 查詢到的單筆資料 (關聯式陣列)
*/
function find($table,$id){
    global $pdo;

    if(is_array($id)){
        $tmp=array2sql($id);
        $sql="SELECT * FROM $table WHERE ".join(" AND ",$tmp);
    }else{
        $sql="SELECT * FROM $table WHERE id='$id'";
    }

    //echo  $sql;

    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

/*
update($table, $data)
$table: 資料表名稱 (string)
$data: 欲更新的資料陣列，必須包含id欄位 (array)
回傳: 執行結果 (成功筆數)
*/
function update($table,$data){
    global $pdo;
    $tmp=array2sql($data);

    $sql="UPDATE $table SET ".join(" , ",$tmp)."
                      WHERE id='{$data['id']}'";
    
     echo $sql;
    return $pdo->exec($sql);

}

/*
insert($table, $data)
$table: 資料表名稱 (string)
$data: 欲新增的資料陣列 (array)
回傳: 執行結果 (成功筆數)
*/
function insert($table,$data){
    global $pdo;
    $keys=array_keys($data);

    $sql="INSERT INTO $table (`".join("`,`",$keys)."`) values('".join("','",$data)."');";
    echo $sql;
    return $pdo->exec($sql);
}

/*
save($table, $data)
$table: 資料表名稱 (string)
$data: 欲儲存的資料陣列 (array)
功能: 若$data有id欄位則執行update，否則執行insert
*/
function save($table,$data){
    if(isset($data['id'])){
        update($table,$data);
    }else{
        insert($table,$data);
    }
}

/*
del($table, $id)
$table: 資料表名稱 (string)
$id: 主鍵值或條件陣列 (int|string|array)
    - 若為陣列，則產生多條件刪除
    - 若為單一值，則以id欄位刪除
回傳: 執行結果 (成功筆數)
*/
function del($table,$id){
    global $pdo;
    $sql="DELETE FROM $table WHERE ";
    if(is_array($id)){
        $tmp=array2sql($id);
        $sql .= join(" AND ",$tmp);
    }else{
        $sql .= "id='$id'";
    }

    //echo  $sql;

    return $pdo->exec($sql);
}

/*
array2sql($array)
$array: 欲轉換的條件或資料陣列 (array)
回傳: 轉換成SQL語法片段的陣列 (array)
*/
function array2sql($array){
    $tmp=[];
    foreach($array as $key=>$value){
        $tmp[]="`$key`='$value'";
    }

    return $tmp;
}

/*
q($sql)
$sql: 欲執行的SQL語法 (string)
回傳: 查詢結果的關聯式陣列
*/
function q($sql){
    global $pdo;

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    
}