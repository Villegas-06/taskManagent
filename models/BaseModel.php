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
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit($table, $id, $data)
    {
        try {
            $fields = array();

            foreach ($data as $keys => $elem) {
                $fields = " " . $keys . "=:" . $keys;
            }

            $string = implode(", ", $fields);

            $sql = "UPDATE $table SET $string WHERE id=:id";
            $q = $this->db->prepare($sql);

            $data['id'] = $id;
            return $q->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAll($query)
    {
        try {
            return $this->db->query($query);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}