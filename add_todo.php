<?php
include("Class/function.php");
$todo_app = new TodoApp();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $user_id = $_SESSION['user_id'];
    $new_todo = $_POST['new_todo'];

    $add_todo_status = $todo_app->add_todo($user_id, $new_todo);

    echo json_encode(['message' =>  $add_todo_status]);
}
?>
