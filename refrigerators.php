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

if (isset($_POST["AddRef"])) {
    $type = $_POST["type_id"];
    $name = $_POST["name"];
    $model = $_POST["model_id"];
    $power = $_POST["power"];
    $price = $_POST["price"];
    $service_number = $_POST["service_number"];
    mysql_query("INSERT INTO `fridges` (`service_number`,`name`,`model_id`,`power`,`price`,`type_id`)
                 VALUES ('$service_number','$name',$model,$power,$price,'$type')", $mysql_connect);
}
if (isset($_POST["update"])) {
    $type = $_POST["type_id"];
    $name = $_POST["name"];
    $model = $_POST["model_id"];
    $power = $_POST["power"];
    $price = $_POST["price"];
    $service_number = $_POST["service_number"];
    $id = $_POST["id"];
    mysql_query("update `fridges` set `name`='$name',
                 `type_id`=$type,`model_id`=$model,`power`=$power,`price`=$price,`service_number`=$service_number
                  where `service_number`=$id", $mysql_connect);
}
if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    mysql_query("delete from `fridges` where `type_id`=$id", $mysql_connect);
}


$mysql_query = mysql_query("select * from `type`", $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$types = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $types[] = $row;
}
mysql_free_result($mysql_query);


$mysql_query = mysql_query("select * from `feature_types`", $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$feature_types = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $feature_types[] = $row;
}
mysql_free_result($mysql_query);


$mysql_query = mysql_query("select * from `model`", $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$models = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $models[] = $row;
}
mysql_free_result($mysql_query);


$mysql_query = mysql_query("select f.*, m.name as model_name,t.name as type_name from `fridges` as f
                            join `model` as m on m.model_id = f.model_id
                            join `type` as t on t.type_id = f.type_id", $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$fridges = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $fridges[] = $row;
}
mysql_free_result($mysql_query);

foreach ($fridges as $f) {
    $type = $f["type_id"];
    $name = $f["name"];
    $model = $f["model_id"];
    $power = $f["power"];
    $price = $f["price"];
    $model_name = $f["model_name"];
    $type_name = $f["type_name"];
    $service_number = $f["service_number"];
    ?>
<div>
    <form action="refrigerators.php" method="post">
        <table>
            <tr>
                <td>
                    <?php
                    echo("
                    <input type = text value='$service_number' name ='service_number' >
                    <input type = text value='$name' name ='name' >
                    <input type='hidden' value='$service_number' name ='id' ></td >");
                    echo(" <td><select name='model_id'>");
                    foreach ($models as $m) {
                        $id = $m['model_id'];
                        $name = $m['name'];
                        if($id == $model){
                            echo("<option selected value='$id'>$name</option>");
                        }else{
                            echo("<option value='$id'>$name</option>");
                        }
                    }
                    echo("</select> </td>");
                    echo(" <td><select name='type_id'>");
                    foreach ($types as $t) {
                        $id = $t['type_id'];
                        $name = $t['name'];
                        if($id == $type){
                            echo("<option selected value='$id'>$name</option>");
                        }else{
                            echo("<option value='$id'>$name</option>");
                        }
                    }
                    echo("</select> </td>");
                    echo("<td><input type = text value='$power' name ='power' ></td>");
                    echo("<td><input type = text value='$price' name ='price' ></td>");
                    echo("<td ><input type='submit' value='Обновить' name ='update' >");
                    ?>

                </td>
            </tr>
        </table>
    </form>
    <form action="type.php" method="post">
        <table>
            <tr>
                <td>
                    <?php
                    echo("<input type='hidden' value='$service_number' name ='service_number' ></td >");
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

<form action="refrigerators.php" method="POST">
    Добавить:<br/>
    Сервисный №:<input type="text" name="service_number"><br/>
    Название:<input type="text" name="name"><br/>
    Тип:<select name='type_id'>
    <?php
        foreach ($types as $f) {
            $id = $f['type_id'];
            $name = $f['name'];
            echo("<option value='$id'>$name</option>");
        }
    ?>
    </select><br/>
    Модель:<select name='model_id'>
    <?php
    foreach ($models as $model) {
        $id = $model['model_id'];
        $name = $model['name'];
        echo("<option value='$id'>$name</option>");
    }
    ?>
    </select><br/>
    Мощность:<input type="text" name="power"><br/>
    Цена:<input type="text" name="price"><br/>
    <input type="submit" name="AddRef" value="Добавить">
</form>
</body>
</html>