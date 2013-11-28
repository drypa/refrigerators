<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body style="background-color: #85d0d9">
<h2>База данных кондиционеров и холодильного оборудования</h2>
<?php
$server = 'localhost:3306';
$login = 'root';
$password = '123456';
$mysql_connect = mysql_connect($server, $login, $password);
if (!$mysql_connect) {
    die (mysql_error());
}
mysql_select_db('fridges', $mysql_connect);
mysql_set_charset('utf8');

if(isset($_POST["AddModel"])){
    $model = $_POST["model"];
    mysql_query("INSERT INTO `model` (`name`) VALUES ('$model')", $mysql_connect);
}

?>
<table>
    <tr>
        <td>Наименование</td>
        <td>Серийный №</td>
        <td>Модель</td>
        <td>Тип</td>
        <td>Мощность</td>
        <td>Цена</td>
    </tr>


</table>
<form action="index.php" method="POST">
    Добавить модель: <input type="text" name="model"> <input type="submit" name="AddModel" value="Добавить">
</form>
</body>
</html>