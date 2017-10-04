<?php
$m530199a = 'insert_here'; // host
$m530199b = 'insert_here'; // user
$m530199c = 'insert_here'; // pw
$m530199d = 'insert_here'; // Database name

$conn = new PDO('mysql: host='.$m530199a.';dbname='.$m530199d.';charset=utf8', $m530199b, $m530199c);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>