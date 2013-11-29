<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body style="background-color: #85d0d9">
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
        $id = $model['mode_id'];
        $name = $model['name'];
    ?>
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
    <?php
}
?>

<form action="model.php" method="POST">
    Добавить модель: <input type="text" name="model"> <input type="submit" name="AddModel" value="Добавить">
</form>
</body>
</html>