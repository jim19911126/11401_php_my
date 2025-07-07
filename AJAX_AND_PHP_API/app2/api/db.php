<?php
session_start();
date_default_timezone_set("Asia/Taipei");

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql)
{
    $dsn = 'mysql:host=localhost;dbname=student_system;charset=utf8';
    $pdo = new PDO($dsn, 'root', '');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function to($url)
{
    header("location:" . $url);
}

class DB
{
    private $dsn = "mysql:host=localhost;dbname=student_system;charset=utf8";
    private $pdo;
    private $table;

    function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, "root", '');
    }

    function all(...$arg)
    {
        $sql = "select * from $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $tmp);

            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function count(...$arg)
    {
        $sql = "select count(*) from $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arraytosql($arg[0]);
                $sql = $sql . " where " . join(" AND ", $tmp);

            } else {
                $sql .= $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

    function find($id)
    {
        $sql = "select * from $this->table ";

        if (is_array($id)) {
            $tmp = $this->arraytosql($id);
            $sql = $sql . " where " . join(" AND ", $tmp);

        } else {
            $sql .= " WHERE `id`='$id'";
        }
        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($array)
    {
        if (isset($array['id'])) {
            //update
            $sql = "update $this->table set ";
            $tmp = $this->arraytosql($array);
            $sql .= join(" , ", $tmp) . "where `id`= '{$array['id']}'";
        } else {
            //insert
            $cols = join("`,`", array_keys($array));
            $values = join("','", $array);
            $sql = "insert into $this->table (`$cols`) values('$values')";
        }

        return $this->pdo->exec($sql);
    }

    function del($id)
    {
        $sql = "delete  from $this->table ";

        if (is_array($id)) {
            $tmp = $this->arraytosql($id);
            $sql = $sql . " where " . join(" AND ", $tmp);

        } else {
            $sql .= " WHERE `id`='$id'";
        }
        //echo $sql;
        return $this->pdo->exec($sql);
    }


    private function arraytosql($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }

        return $tmp;
    }

}
$ref = [
    '101' => '一年一班',
    '102' => '一年二班',
    '103' => '一年三班',
    '104' => '一年四班',
    '105' => '一年五班',
    '106' => '一年六班',
    '107' => '一年七班',
    '108' => '一年八班',
    '109' => '一年九班',
    '110' => '一年十班',
];


$Stu = new DB('students');



?>