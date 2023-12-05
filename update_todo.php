<?php
include("Class/function.php");
$todo_app = new TodoApp();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $update_status = $todo_app->update_todo($_POST);

 echo json_encode(['message' =>  $update_status]);
}
