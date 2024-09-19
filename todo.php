<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

require_once("todoDAO.php");
$todo = new todoDAO();
$api = $_SERVER["REQUEST_METHOD"];
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? ''; 

if($api == "GET"){

    // select
    if($action == 'selectAll'){
        $data = $todo->selectAll();
        echo json_encode($data);
    }

    // delete
    if($action == 'delete'){
        $data = $todo->deleteById($id);
        echo json_encode(['data' => $data]);
    }
}

if($api == "POST"){
    $action = $todo->check_input($_POST['action']);

    // insert
    if($action == "insert"){
        $detail = $todo->check_input($_POST['detail']);
        $data = $todo->insertTodo($detail);
        echo json_encode(['data' => $data]);
    }

    // update
    if($action == "updateTodo"){
        $id = $todo->check_input($_POST['id']);
        $detail = $todo->check_input($_POST['detail']);
        $data = $todo->updateTodo($id,$detail);
        echo json_encode(['data' => $data]);
        
    }

    // update
    if($action == "updateTodoStatus"){
        $id = $todo->check_input($_POST['id']);
        $status = $todo->check_input($_POST['status']);
        $status = ($status == 0) ? 1 : 0;
        $data = $todo->updateTodoStatus($id,$status);
        echo json_encode(['data' => $data]);
    }
    
}

?>