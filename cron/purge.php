<?php
$mysqli = new mysqli("localhost","root","","");
$mysqli->query('DELETE FROM tweets WHERE del=1');

$mysqli->close();
?>