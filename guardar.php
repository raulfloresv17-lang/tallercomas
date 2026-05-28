<?php

$data = file_get_contents("php://input");
file_put_contents("productos.json", $data);

echo "OK";
?>