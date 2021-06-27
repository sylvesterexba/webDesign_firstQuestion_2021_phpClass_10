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



    // $arg: argument; 引數>
    // ... 是不定參數
    public function all(...$arg) {
        $sql="select * from $this->table ";
        // $arg=[] or [陣列],[SQL字串],[陣列,SQL字串],

        if(isset($arg[0])) {
            if(is_array($arg[0])) {
                // ["欄位"]=>"值""欄位"=>"值"]
                // where `欄位`='值' && `欄位`='`值'

                foreach($arg[0] as $key => $value) {
                    //變數在運算式內需要先宣告
                    // $tmp 暫時的字串 
                    $tmp=$tmp."`".$key."`='".$value."' && ";
                }
                echo implode(" && ",["`欄位`='值'","`欄位`='值'","`欄位`='值'"]);
                // echo $tmp;
                echo "<br>";
                // echo "處理陣列";
            }else {
                //當它是字串
                $sql=$sql . $arg[0];
            }

            if(isset($arg[1])) {
                //當它是字串
                $sql=$sql . $arg[1];
            }
        }

        echo $sql;
        // query: 查詢
        return $this->pdo->query($sql)->fetchAll();
    }
}


//  大寫代表特別意義，是我們寫程式的人自己設定，可能是常數或物件
// 一般變數用小寫或是駝峰式命名
$User=new DB("user");

echo "<pre>";
print_r($User->all(['name'=>'amy','visible'=>'Y']));
echo "</pre>";

// echo "<pre>";
// print_r($User->all(" where name='amy' "));
// echo "</pre>";

// echo "<pre>";
// print_r($User->all(" where `visible`='Y' " , " order by `id` DESC" ));
// echo "</pre>";





?>