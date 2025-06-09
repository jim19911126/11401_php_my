<?php 
$dsn="mysql:host=localhost;dbname=store;charset=utf8";
$pdo=new PDO($dsn,'root','');

function all($table,$where=null){
    global $pdo;
    $sql="SELECT * FROM $table $where";
    //echo $sql;
    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;

}


function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function find($table,$id){
    global $pdo;

    if(is_array($id)){
        $tmp=[];
        foreach($id as $key=>$value){
            $tmp[]="`$key`='$value'";
        }
        $sql="SELECT * FROM $table WHERE ".join(" AND ",$tmp);
    }else{
        $sql="SELECT * FROM $table WHERE id='$id'";
    }

    //echo  $sql;

    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

function update($table,$data){
    global $pdo;
    $tmp=[];
        foreach($data as $key=>$value){
            if($key!='id'){
                $tmp[]="`$key`='$value'";
            }
        }
    $sql="UPDATE $table SET ".join(" , ",$tmp)."
                      WHERE id='{$data['id']}'";
    
     echo $sql;
    return $pdo->exec($sql);

}

function insert($table,$data){
    global $pdo;
    $keys=array_keys($data);

    $sql="INSERT INTO $table (`".join("`,`",$keys)."`) values('".join("','",$data)."');";
    echo $sql;
    return $pdo->exec($sql);
}

function save($table,$data){
    if(isset($data['id'])){
        update($table,$data);
    }else{
        insert($table,$data);
    }
}

function q($sql){
    global $pdo;

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    
}