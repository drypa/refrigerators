<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>

<body style="background-color: #85d0d9">
<a href="index.php">Главная</a>
<a href="refrigerators.php">Оборудование</a>
<a href="type.php">Типы</a>
<a href="model.php">Модели</a>
<a href="feature_types.php">Доп. Функции</a>

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

if (isset($_POST["AddModel"])) {
    $model = $_POST["model"];
    mysql_query("INSERT INTO `model` (`name`) VALUES ('$model')", $mysql_connect);
}
if (isset($_POST["update"])) {
    $model = $_POST["model"];
    $id = $_POST["id"];
    mysql_query("update `model` set `name`='$model' where `model_id`=$id", $mysql_connect);
}
if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    mysql_query("delete from `model` where `model_id`=$id", $mysql_connect);
}


$mysql_query = mysql_query("select * from `model`", $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$models = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $models[] = $row;
}
mysql_free_result($mysql_query);

foreach ($models as $model) {
    $id = $model['model_id'];
    $name = $model['name'];
    ?>
<div>
    <form action="model.php" method="post">
        <table>
            <tr>
                <td>
                    <?php
                    echo("<input type = text value='$name' name ='model' ><input type='hidden' value='$id' name ='id' ></td >");
                    echo("<td ><input type='submit' value='Обновить' name ='update' >");
                    ?>

                </td>
            </tr>
        </table>
    </form>
    <form action="model.php" method="post">
        <table>
            <tr>
                <td>
                    <?php
                    echo("<input type='hidden' value='$id' name ='id' ></td >");
                    echo("<td ><input type='submit' value='Удалить' name ='delete' >");
                    ?>
                </td>
            </tr>
        </table>
    </form>
</div>
    <?php
}
?>
<br/>

<form action="model.php" method="POST">
    Добавить модель: <input type="text" name="model"> <input type="submit" name="AddModel" value="Добавить">
</form>
</body>
</html>