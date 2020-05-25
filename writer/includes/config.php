<?php
$con=pg_connect("host=localhost dbname=wemedia user=postgres password=postgres");
if(!$con)
echo"connection fail";
?>