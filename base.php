<?php

// 初始化
// 提供所有資料表使用的物件
class DB
{
    private $dsn="mysql:host=localhost; charset=utf8; dbname=db_story";
    // $dsn: data source name;資料來源名稱
    private $root='root';
    private $password='12345';
    private $table;
    private $pdo;

    // 建構式
    // construct 建構子
    // $this 指的是整個class裡面的某個東西
    public function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn, $this->root, $this->password);
    }



    // $arg: argument; 引數
    // ... 是不定參數
    public function all(...$arg)
    {
        $sql="select * from $this->table ";
    // query: 查詢
        return $this->pdo->query($sql)->fetchAll();
    }
}

$db=new DB("stories");

echo "<pre>";
print_r($db->all());
echo "</pre>";

$db2=new DB("user");

echo "<pre>";
print_r($db2->all());
echo "</pre>";