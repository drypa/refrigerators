<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body style="background-color: #85d0d9">
<h1>База данных кондиционеров и холодильного оборудования</h1>
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
?>

</body>
</html>