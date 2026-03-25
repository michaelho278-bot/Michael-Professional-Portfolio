<?php
require_once __DIR__ . "/../helpers/Database.php";

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // 取得全部產品
    public function getAll() {
        try {
            return $this->db->query("SELECT pID, pCate, pName, pDescription, pSpec, pImage, pPrice, pStock FROM productlist");
        } catch (Exception $e) {
            throw new Exception("DB error in getAll: " . $e->getMessage());
        }
    }

    // 取得單一產品
    public function getById($pID) {
        try {
            return $this->db->queryOne(
                "SELECT pID, pCate, pName, pDescription, pSpec, pImage, pPrice, pStock FROM productlist WHERE pID=?",
                [$pID]
            );
        } catch (Exception $e) {
            throw new Exception("DB error in getById: " . $e->getMessage());
        }
    }

    // 新增產品
    public function create($data) {
        try {
            return $this->db->execute(
                "INSERT INTO productlist (pCate, pName, pDescription, pSpec, pImage, pPrice, pStock) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)",
                [
                    $data['pCate'], $data['pName'], $data['pDescription'],
                    $data['pSpec'], $data['pImage'], $data['pPrice'], $data['pStock']
                ]
            );
        } catch (Exception $e) {
            throw new Exception("DB error in create: " . $e->getMessage());
        }
    }

    // 更新產品
    public function update($id, $data) {
    try {
        return $this->db->execute(
            "UPDATE productlist 
             SET pCate=?, pName=?, pDescription=?, pSpec=?, pImage=?, pPrice=?, pStock=? 
             WHERE pID=?",
            [
                $data['pCate'], $data['pName'], $data['pDescription'],
                $data['pSpec'], $data['pImage'], $data['pPrice'], $data['pStock'], $id
            ]
        );
    } catch (Exception $e) {
        throw new Exception("DB error in update: " . $e->getMessage());
    }
    }

    // 刪除產品
    public function delete($pID) {
        try {
            return $this->db->execute("DELETE FROM productlist WHERE pID=?", [$pID]);
        } catch (Exception $e) {
            throw new Exception("DB error in delete: " . $e->getMessage());
        }
    }

    public function updateImage($pID, $path) {
    try {
        $sql = "UPDATE productList SET pImage=? WHERE pID=?";
        $result = $this->db->execute($sql, [$path, $pID]);

        if (!$result) {
            throw new Exception("Update failed for pID=$pID, path=$path");
        }
        return $result;
    } catch (Exception $e) {
        error_log("DB error in update image: " . $e->getMessage());
        throw $e;
    }
}
}