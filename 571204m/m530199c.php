<?php
$m530199a = 'localhost'; // host
$m530199b = 'root'; // user
$m530199c = '1234'; // pw
$m530199d = 'ReplaceDB'; // Database name

$conn = new PDO('mysql: host='.$m530199a.';dbname='.$m530199d.';charset=utf8', $m530199b, $m530199c);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
