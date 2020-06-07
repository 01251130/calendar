<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <title>カレンダー</title>
    <style>
        body{
            width: 500px;
        }
        .header{
            text-align : center;
        }
        table th{
            padding : 10px 10px;
        }
        table td{
            padding : 10px 10px;
            text-align:center;
        }
        th,td{
            border:solid 3px #8ac6d1;
        }
        .changeMonth{
            display: flex;
            margin: 20px auto;
        }
        .btn{
            margin: 0 auto;
            display:block;font-weight: bold;
            background-color : #204969;
            color: #dadada;
            width : 120px;
            height: 50px;
            border-radius:30px;
            text-align: center;
            line-height: 40px;

        }
    
    
    
    </style>
</head>
<body>
    <?php 
        require_once(__DIR__ . '/lib/Main.php');

        $cal = new Calendar();
        $data = $cal->run();

    ?>

<!-- TODO: getValuesを参考に、HTMLで使っている変数の値を連想配列で返却するようにする！！！！ -->
    <div class="header">
        <h1>カレンダー</h1>
        <h3><?php echo $data['firstDay']->format('Y年m月') ?></h3>
    </div>
    <table align="center">
        <tr>
            <?php for($i=0; $i<count($data['dayname']) ;$i++){ 
                echo "<th>{$data['dayname'][$i]}</th>";
            } ?>
        </tr>

        <?php 
            for($x=0; $x < count($data['weeksDate']); $x++){
                echo '<tr>';
                for($y=0; $y < $data['weeklyCount']; $y++){ 
                    echo "<td>{$data['weeksDate'][$x][$y]}</td>";
                }
                echo '</tr>';
            }
        ?>
    </table>
    <div class="changeMonth">
        <a class="btn" href="?ym=<?php echo $data['befYm'] ?>">前月へ</a>
        <a class="btn" href="?ym=<?php echo $data['aftYm'] ?>">来月へ</a>
    </div>
</body>
</html>
