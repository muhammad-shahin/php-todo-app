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

  // hash the password using password_hash
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // using prepared statements to prevent SQL injection
  $query = "INSERT INTO users (user_full_name, user_email, password) VALUES (?, ?, ?)";

  // method to prepare the statement
  $stmt = mysqli_prepare($this->connection, $query);
  mysqli_stmt_bind_param($stmt, "sss", $full_name, $user_email, $hashedPassword);

  if (mysqli_stmt_execute($stmt)) {
   return true;
  } else {
   return false;
  }
 }

 public function login($data)
 {
  $user_email = $data['user_email'];
  $password = $data['password'];

  // prepared statement
  $query = "SELECT user_id, user_email, password FROM users WHERE user_email=?";
  // method to prepare the statement
  $stmt = mysqli_prepare($this->connection, $query);
  mysqli_stmt_bind_param($stmt, "s", $user_email);
  mysqli_stmt_execute($stmt);

  // bind the result variables
  mysqli_stmt_bind_result($stmt, $user_id, $db_user_email, $hashedPassword);
  // fetch result
  mysqli_stmt_fetch($stmt);
  $verification_status = password_verify($password, $hashedPassword);

  if ($db_user_email && $verification_status) {
   $_SESSION['user_id'] = $user_id;
   return true;
  } else {
   return false;
  }
 }
 public function logout()
 {
  session_start();

  unset($_SESSION['user_id']);

  if (isset($_SESSION)) {
   session_destroy();
  }

  echo json_encode(["message" => "Logout successful"]);
  exit();
 }
}
