<?php
require_once('config.php');

class todoDAO extends Config {

    // SELECT
    public function selectAll() {
        $sql = "SELECT * FROM todo";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $arrList =[];
        foreach ($rows as $val) {
            $obj=array(
                "id"=>$val["id"],
                "detail"=>$val["detail"], 
                "status"=>$val["status"],

            );
            array_push($arrList,$obj);
        }
        return $arrList;
    }
    // DELETE
    public function deleteById($id) {
        $sql = "DELETE FROM todo WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
    
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // INSERT
    public function insertTodo($detail){
        $sql = "INSERT INTO todo (detail) VALUES (:detail);";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "detail" => $detail,
        ]);
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // UPDATE
    public function updateTodo($id, $detail){
        $sql = "UPDATE todo SET detail = :detail WHERE id = :id;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "detail" => $detail
        ]);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // UPDATE
    public function updateTodoStatus($id, $status){
        $sql = "UPDATE todo SET status = :status WHERE id = :id;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "status" => $status
        ]);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
?>