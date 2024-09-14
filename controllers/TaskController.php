<?php

require_once './models/TaskModel.php';

class TaskController
{
    public function index()
    {
        require_once __DIR__ . '/../views/includes/header.php';
        require_once __DIR__ . '/../views/includes/navbar.php';
        require_once __DIR__ . '/../views/pages/index.php';
        require_once __DIR__ . '/../views/includes/footer.php';
    }

    public function getTasks()
    {
        $task = new TaskModel();
        return $task->getTasks();
    }
}