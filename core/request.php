<?php

require_once 'config.php';

$page = isset($_GET['page']) ? $_GET['page'] : '';

if (!empty($page)) {
    $data = array(
        'index' => array('model' => 'TaskModel', 'view' => 'index', 'controller' => 'TaskController'),
        'insert' => array('model' => 'TaskModel', 'view' => 'handleAjaxInsert', 'controller' => 'TaskController'),
        'editar' => array('model' => 'TaskModel', 'view' => 'editar', 'controller' => 'TaskController'),
    );

    if (array_key_exists($page, $data)) {
        $components = $data[$page];
        $model = $components['model'];
        $view = $components['view'];
        $controller = $components['controller'];

        require_once 'controllers/' . $controller . '.php';
        $object = new $controller();
        if ($view === 'handleAjaxInsert') {
            $object->handleAjaxInsert();
        } else {
            $object->$view();
        }
    } else {
        header('Location: index.php?page=index');
    }
} else {
    header('Location: index.php?page=index');
}
