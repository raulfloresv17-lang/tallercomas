<?php

header('Content-Type: application/json');

$productos = json_decode(file_get_contents('productos.json'), true);

$index = $_POST['index'];

if(!isset($productos[$index])){
    echo json_encode(['success'=>false]);
    exit;
}

$imagenActual = $productos[$index]['imagen'];

if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0){

    if(!empty($imagenActual)){
        $rutaVieja = 'imagenes/' . $imagenActual;

        if(file_exists($rutaVieja)){
            unlink($rutaVieja);
        }
    }

    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

    $imagenActual = time() . '_' . rand(1000,9999) . '.' . $extension;

    move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        'imagenes/' . $imagenActual
    );
}

$productos[$index] = [
    'codigo' => $_POST['codigo'],
    'cascos' => $_POST['cascos'],
    'pin' => $_POST['pin'],
    'producto' => $_POST['producto'],
    'marca' => $_POST['marca'],
    'modelo' => $_POST['modelo'],
    'apodo' => $_POST['apodo'],
    'stock' => $_POST['stock'],
    'precio' => $_POST['precio'],
    'imagen' => $imagenActual
];

file_put_contents(
    'productos.json',
    json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo json_encode([
    'success' => true
]);