<?php

require_once 'config.php';

$page = $_GET['page'];

if(!empty($page)){
    $data = array(
        'index' => array('model' => 'TaskModel', 'view' => 'index', 'controller' => 'TaskController'),
        'insertar' => array('model' => 'TaskModel', 'view' => 'insertar', 'controller' => 'TaskController'),
        'editar' => array('model' => 'TaskModel', 'view' => 'editar', 'controller' => 'TaskController'),
    );

    foreach($data as $key => $components){
        if($page == $key){
            $model = $components['model'];
            $view = $components['view'];
            $controller = $components['controller'];
            break;
        }
    }

    if(isset($model)){
        require_once 'controllers/' .$controller.'.php';
        $object = new $controller();
        $object->$view();
    }
}else{
    header('Location: index.php?page=index');
}