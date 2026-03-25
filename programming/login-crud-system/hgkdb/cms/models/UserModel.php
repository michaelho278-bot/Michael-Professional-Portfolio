<?php
require_once __DIR__ . "/../helpers/Database.php";

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        try {
            return $this->db->query("SELECT uID, uName, uRole, uUsername FROM userList");
        } catch (Exception $e) {
            throw new Exception("DB error in getAll: " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            return $this->db->queryOne(
                "SELECT uID, uName, uRole, uUsername FROM userList WHERE uID=?",
                [$id]
            );
        } catch (Exception $e) {
            throw new Exception("DB error in getById: " . $e->getMessage());
        }
    }

    public function add($data) {
        try {
            $hashed = password_hash($data['uPassword'], PASSWORD_BCRYPT);
            return $this->db->execute(
                "INSERT INTO userList (uName, uRole, uUsername, uPassword) VALUES (?,?,?,?)",
                [$data['uName'], $data['uRole'], $data['uUsername'], $hashed]
            );
        } catch (Exception $e) {
            throw new Exception("DB error in add: " . $e->getMessage());
        }
    }

    public function update($id, $data) {
        try {
            return $this->db->execute(
                "UPDATE userList SET uName=?, uRole=?, uUsername=? WHERE uID=?",
                [$data['uName'], $data['uRole'], $data['uUsername'], $id]
            );
        } catch (Exception $e) {
            throw new Exception("DB error in update: " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            return $this->db->execute("DELETE FROM userList WHERE uID=?", [$id]);
        } catch (Exception $e) {
            throw new Exception("DB error in delete: " . $e->getMessage());
        }
    }
}
