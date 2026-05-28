<?php

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$index = $data['index'];

$productos = json_decode(file_get_contents('productos.json'), true);

if(isset($productos[$index])){

    if(!empty($productos[$index]['imagen'])){

        $rutaImagen = 'imagenes/' . $productos[$index]['imagen'];

        if(file_exists($rutaImagen)){
            unlink($rutaImagen);
        }
    }

    array_splice($productos, $index, 1);

    file_put_contents(
        'productos.json',
        json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

echo json_encode([
    'success' => true
]);