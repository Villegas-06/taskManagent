<?php

require_once 'BaseModel.php';

class TaskModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTasks()
    {
        $db = new BaseModel();
        $query = "SELECT * FROM task ORDER BY id";
        $result = $db->getAll($query);
        return $result;
    }

    public function insertTask($data)
    {
        $db = new BaseModel();
        try {
            $insert = $db->insert('task', $data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editTask($id, $data)
    {
        $db = new BaseModel();
        try {
            $edit = $db->edit('task', $id, $data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}