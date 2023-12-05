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

  // handle connection error
  if ($this->connection->connect_error) {
   die("Connection Failed: " . $this->connection->connect_error);
  }
 }


 public function is_exist($email)
 {
  // check user already exist or not
  $query = "SELECT * FROM users WHERE user_email='$email'";
  $result = mysqli_query($this->connection, $query);

  if ($result) {
   if (mysqli_num_rows($result) > 0) {
    return true;
   } else {
    return "No User Found";
   }
  } else {
   die("is_exist Query Failed : " . mysqli_error($this->connection));
  }
 }

 public function signup($data)
 {
  $full_name = $data['full_name'];
  $user_email = $data['user_email'];
  $password = $data['password'];
 }
}
