<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>

<body style="background-color: #85d0d9">
<h2>База данных кондиционеров и холодильного оборудования</h2>
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
$select_query = "select f.*, m.name as model_name,t.name as type_name from `fridges` as f
                            join `model` as m on m.model_id = f.model_id
                            join `type` as t on t.type_id = f.type_id";
if (isset($_POST['doFilter'])) {
    $type_id = $_POST['type_id'];
    $select_query .= " where f.type_id = $type_id";
}
$mysql_query = mysql_query($select_query, $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$fridges = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $fridges[] = $row;
}
mysql_free_result($mysql_query);

$mysql_query = mysql_query("select * from `type`", $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$types = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $types[] = $row;
}
echo("<br><form action='index.php' method='post'><select name='type_id'>");
foreach ($types as $t) {
    $id = $t['type_id'];
    $name = $t['name'];
    echo("<option value='$id'>$name</option> ");

}
echo("</select><input type='submit' name='doFilter' value='Найти'></form><br>");
?>


<table border=1 cellpadding=2 cellspacing=1>
    <tr>
        <td>Наименование</td>
        <td>Серийный №</td>
        <td>Модель</td>
        <td>Тип</td>
        <td>Мощность</td>
        <td>Цена</td>
    </tr>
    <?php
    foreach ($fridges as $f) {

        $name = $f["name"];
        $power = $f["power"];
        $price = $f["price"];
        $model_name = $f["model_name"];
        $type_name = $f["type_name"];
        $service_number = $f["service_number"];
        echo("<tr>");
        echo("<td>$name</td>");
        echo("<td>$service_number</td>");
        echo("<td>$model_name</td>");
        echo("<td>$type_name</td>");
        echo("<td>$power</td>");
        echo("<td>$price</td>");
        echo("</tr>");
    }

    ?>


</table>

</body>
</html>