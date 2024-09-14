<?php

require_once './libs/DB.php';

class BaseModel extends DB
{
    public $db;
    public $string;

    public function __construct()
    {
        $this->db = new DB();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function insert($table, $data)
    {
        try {
            $keys = array_keys($data);
            $sql = "INSERT INTO $table (" . implode(", ", $keys) . ") VALUES ( :" . implode(", :", $keys) . ")";
            $q = $this->db->prepare($sql);
            return $q->execute($data);
        } catch (PDOException $e) {
            echo "Error en la inserción: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function edit($table, $id, $data)
    {
        try {
            // Construir una cadena de campos para la consulta SQL
            $fields = [];
            foreach ($data as $key => $value) {
                $fields[] = "$key = :$key";
            }
            $fieldsString = implode(", ", $fields);

            // Crear la consulta SQL
            $sql = "UPDATE $table SET $fieldsString WHERE id = :id";
            $q = $this->db->prepare($sql);

            // Añadir el ID al array de datos
            $data['id'] = $id;

            // Ejecutar la consulta
            return $q->execute($data);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function getAll($query)
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}