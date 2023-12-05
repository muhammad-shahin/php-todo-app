<?php
include("Class/function.php");
$todo_app = new TodoApp();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $todo_id = $_POST['todo_id'];
 $delete_status = $todo_app->delete_todo($todo_id);

 echo json_encode(['message' =>  $delete_status]);
}
