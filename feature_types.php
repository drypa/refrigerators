<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        form{
            display: inline-block;
        }
    </style>
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

if (isset($_POST["AddFeatureType"])) {
    $type = $_POST["type"];
    mysql_query("INSERT INTO `feature_types` (`name`) VALUES ('$type')", $mysql_connect);
}
if (isset($_POST["update"])) {
    $type = $_POST["type"];
    $id = $_POST["id"];
    mysql_query("update `feature_types` set `name`='$type' where `feature_type_id`=$id", $mysql_connect);
}
if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    mysql_query("delete from `feature_types` where `feature_type_id`=$id", $mysql_connect);
}


$mysql_query = mysql_query("select * from `feature_types`", $mysql_connect);
if (!$mysql_query) {
    die(mysql_error());
}
$types = array();
while ($row = mysql_fetch_array($mysql_query)) {
    $types[] = $row;
}
mysql_free_result($mysql_query);

foreach ($types as $t) {
    $id = $t['feature_type_id'];
    $name = $t['name'];
    ?>
<form action="feature_types.php" method="post" >
    <table>
        <tr>
            <td>
                <?php
                echo("<input type = text value='$name' name ='type' ><input type='hidden' value='$id' name ='id' ></td >");
                echo("<td ><input type='submit' value='Обновить' name ='update' >");
                ?>

            </td>
        </tr>
    </table>
</form>
<form action="feature_types.php" method="post">
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
    <?php
}
?>
<br/>
<form action="feature_types.php" method="POST">
    Добавить доп.опцию: <input type="text" name="type"> <input type="submit" name="AddFeatureType" value="Добавить">
</form>
</body>
</html>