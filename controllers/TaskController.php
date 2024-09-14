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

    public function insert()
    {
        require_once __DIR__ . '/../views/includes/header.php';
        require_once __DIR__ . '/../views/includes/navbar.php';
        require_once __DIR__ . '/../views/pages/insert.php';
        require_once __DIR__ . '/../views/includes/footer.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../views/includes/header.php';
        require_once __DIR__ . '/../views/includes/navbar.php';
        require_once __DIR__ . '/../views/pages/update.php';
        require_once __DIR__ . '/../views/includes/footer.php';
    }

    public function getTasks()
    {
        $task = new TaskModel();
        return $task->getTasks();
    }

    public function insertTask($data)
    {
        $db = new BaseModel();
        try {
            $validStatuses = ['pending', 'in-progress', 'completed'];
            if (!in_array($data['status'], $validStatuses)) {
                throw new Exception('Valor de estado inválido');
            }

            // Inserción de datos
            $insert = $db->insert('task', $data);

            // Devolver una respuesta JSON
            if ($insert) {
                echo json_encode(['status' => 'success', 'message' => 'Registro exitoso']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error al agregar el registro']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

        // Terminar el script para evitar salida extra
        exit;
    }


    public function handleAjaxInsert()
    {
        header('Content-Type: application/json'); // Asegura que la respuesta sea JSON
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $status = isset($_POST['status']) ? trim($_POST['status']) : '';

            $errors = [];
            if (empty($name)) {
                $errors[] = 'El nombre es obligatorio.';
            }
            if (empty($description)) {
                $errors[] = 'La descripción es obligatoria.';
            }
            if (empty($status)) {
                $errors[] = 'El estado es obligatorio.';
            }

            if (!empty($errors)) {
                echo json_encode(['status' => 'error', 'message' => implode('<br>', $errors)]);
            } else {
                $data = array(
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                );

                $this->insertTask($data);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
        }

        exit;
    }

    public function getTaskByid($id)
    {
        $task = new TaskModel();
        $taskData = $task->getTasksById($id);

        if ($taskData) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'data' => $taskData[0]]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Tarea no encontrada']);
        }
        exit;
    }


    public function updateTask()
    {
        header('Content-Type: application/json'); // Asegura que la respuesta sea JSON
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskId = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $description = isset($_POST['description']) ? trim($_POST['description']) : '';
            $status = isset($_POST['status']) ? trim($_POST['status']) : '';

            $errors = [];
            if (empty($name)) {
                $errors[] = 'El nombre es obligatorio.';
            }
            if (empty($description)) {
                $errors[] = 'La descripción es obligatoria.';
            }
            if (empty($status)) {
                $errors[] = 'El estado es obligatorio.';
            }

            if (!empty($errors)) {
                echo json_encode(['status' => 'error', 'message' => implode('<br>', $errors)]);
            } else {
                $data = array(
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                );

                $task = new TaskModel();
                $update = $task->updateTask($taskId, $data);

                if ($update) {
                    echo json_encode(['status' => 'success', 'message' => 'Tarea actualizada con éxito']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la tarea']);
                }
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
        }
        exit;
    }

}