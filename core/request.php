<?php

require_once 'config.php';

$page = isset($_GET['page']) ? $_GET['page'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : null; // Obtener el parámetro ID si existe

if (!empty($page)) {
    $data = array(
        'index' => array('model' => 'TaskModel', 'view' => 'index', 'controller' => 'TaskController'),
        'insert' => array('model' => 'TaskModel', 'view' => 'insert', 'controller' => 'TaskController'),
        'update' => array('model' => 'TaskModel', 'view' => 'updateTask', 'controller' => 'TaskController'),
        'getTaskByid' => array('model' => 'TaskModel', 'view' => 'getTaskByid', 'controller' => 'TaskController')
    );

    if (isset($data[$page])) {
        $model = $data[$page]['model'];
        $view = $data[$page]['view'];
        $controller = $data[$page]['controller'];

        require_once 'controllers/' . $controller . '.php';
        $object = new $controller();
        
        // Llama al método correspondiente con el parámetro ID si existe
        if ($view == 'getTaskByid' && $id !== null) {
            $object->$view($id);
        } else {
            $object->$view();
        }
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Página no encontrada';
    }
} else {
    header('Location: index.php?page=index');
}
