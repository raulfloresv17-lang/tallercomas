<?php

header("Content-Type: text/plain");

$data = file_get_contents("php://input");

if($data){

file_put_contents("productos.json", $data);

echo "ok";

}else{

echo "error";

}

?>