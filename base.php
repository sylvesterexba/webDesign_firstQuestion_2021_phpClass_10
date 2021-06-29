<?php
session_start();
date_default_timezone_set("Asia/Taipei");
//設定後台的抬頭文字



$ts=[
    "title"=>"網站標題管理",
    "ad"=>"動態文字廣告管理",
    "mvim"=>"動畫圖片管理",
    "image"=>"校園映像圖片管理",
    "total"=>"進站總人數管理",
    "bottom"=>"頁尾版權資料管理",
    "news"=>"最新消息資料管理",
    "admin"=>"管理者帳號管理",
    "menu"=>"選單管理"
];
$as=[
    "title"=>"新增網站標題",
    "ad"=>"新增動態文字廣告管理",
    "mvim"=>"新增動畫圖片管理",
    "image"=>"新增校園映像圖片管理",
    "news"=>"新增最新消息資料管理",
    "admin"=>"新增管理者帳號管理",
    "menu"=>"新增選單管理"
];
$hs=[
    "title"=>"網站標題",
    "ad"=>"動態文字廣告管理",
    "mvim"=>"動畫圖片管理",
    "image"=>"校園映像圖片管理",
    "total"=>"進站總人數：",
    "bottom"=>"頁尾版權資料：",
    "news"=>"最新消息資料管理",
    "admin"=>"管理者帳號管理",
    "menu"=>"選單管理"
];

// 初始化
// 提供所有資料表使用的物件
class DB
{
    private $dsn="mysql:host=localhost; charset=utf8; dbname=db01";
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


    //1.建立取出全部資料的函式 - all(…$arg)
    // $arg: argument; 引數>
    // ... 是不定參數
    public function all(...$arg)
    {
        $sql="select * from $this->table ";
        // $arg=[] or [陣列],[SQL字串],[陣列,SQL字串],

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                // ["欄位"]=>"值""欄位"=>"值"]
                // where `欄位`='值' && `欄位`='值'
                // "欄位"=>"值" ====> `欄位`='值'

                foreach ($arg[0] as $key => $value) {
                    // 正規表達式
                    // $tmp[]=sprintf("%s你好，這是你的錢一共%d",$name,$money);
                    $tmp[] = sprintf("`%s`='%s'", $key, $value);
                }

                // print_r($tmp);

                // &&前後一定要加空白
                // print_r(implode(" && ",$tmp));
                // echo implode(" && ",["`欄位`='值'","`欄位`='值'","`欄位`='值'"]);

                $sql = $sql . " where " . implode(" && ", $tmp);

            // echo $tmp;
                // echo "<br>";
                // echo "處理陣列";
            } else {
                //當它是字串
                $sql=$sql . $arg[0];
            }

            if (isset($arg[1])) {
                //當它是字串
                $sql=$sql . $arg[1];
            }
        }

        // 用來檢查語法哪邊出問題
        // echo $sql;
        // query: 查詢
        return $this->pdo->query($sql)->fetchAll();
    }

    //2.計算筆數 - count(…$arg)
    // public function all(...$arg) {
    public function count(...$arg)
    {
        // $sql="select * from $this->table ";
        $sql="select count(*) from $this->table ";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                foreach ($arg[0] as $key => $value) {
                    $tmp[] = sprintf("`%s`='%s'", $key, $value);
                }
                $sql = $sql . " where " . implode(" && ", $tmp);
            } else {
                $sql=$sql . $arg[0];
            }
            if (isset($arg[1])) {
                $sql=$sql . $arg[1];
            }
        }

        // echo $sql;
        // return $this->pdo->query($sql)->fetchAll();
        return $this->pdo->query($sql)->fetchColumn();
    }


    //3.取得單筆資料 - find($id)
    // public function count(...$arg) {
    public function find($id)
    {
        // $sql="select count(*) from $this->table ";
        $sql="select * from $this->table ";

        // if(isset($arg[0])) {
        // if(is_array($arg[0])) {
        if (is_array($id)) {
            // foreach($arg[0] as $key => $value) {
            foreach ($id as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql = $sql . " where " . implode(" && ", $tmp);
        } else {
            // $sql=$sql . $arg[0];
            $sql=$sql . " where `id`='$id'";
        }
        // if(isset($arg[1])) {
        //     $sql=$sql . $arg[1];

        // echo $sql;
        // return $this->pdo->query($sql)->fetchColumn();
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        // return $this->pdo->query($sql)->fetch();
    }

    //4.刪除資料 - del($id)
    // public function find($id)
    public function del($id)
    {
        // $sql="select * from $this->table ";
        $sql=" delete from $this->table ";

        if (is_array($id)) {
            foreach ($id as $key => $value) {
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
            $sql = $sql . " where " . implode(" && ", $tmp);
        } else {
            $sql=$sql . " where `id`='$id'";
        }

        // echo $sql;
        // return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $this->pdo->exec($sql);
    }

    //5.新增或更新資料 - save($array)
    public function save($array)
    {
        if (isset($array['id'])) {
            //update
            foreach ($array as $key => $value) {
                // 如果key值是id就跳過不重覆顯示
                if ($key!='id') {
                    $tmp[] = sprintf("`%s`='%s'", $key, $value);
                }
            }

            $sql="update $this->table set " . implode(',', $tmp) . " where `id` = '{$array['id']}'";
        } else {
            //insert
            // `name`,`addr`,`tel`

            $sql="insert into $this->table 
            (`".implode("`,`", array_keys($array))."`) values
            ('".implode("','", $array) ."')";
        }

        // echo $sql;
        return $this->pdo->exec($sql);
    }
}

//6.網頁導向功能 - to($url)
function to($url)
{
    header("location:".$url);
}

$Total=new DB('total');
$Bottom=new DB('bottom');



if (!isset($_SESSION['total'])) {
    $total=$Total->find(1);
    $total['total']++;
    $Total->save($total);
    $_SESSION['total']=1;
    // print_r($total);
}

?>