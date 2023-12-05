<?php
class TodoApp
{
 public $connection;
 // connect database
 public function __construct()
 {
  $db_hostname = 'localhost';
  $db_username = 'root';
  $db_password = '';
  $db_name = 'todo_app';
  $this->connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
 }

 public function signup($data)
 {
  $full_name = $data['full_name'];
  $user_email = $data['user_email'];
  $password = $data['password'];
 }
}
