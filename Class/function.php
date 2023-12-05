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
  $query = "SELECT user_id, user_full_name, user_email, password FROM users WHERE user_email=?";
  // method to prepare the statement
  $stmt = mysqli_prepare($this->connection, $query);
  mysqli_stmt_bind_param($stmt, "s", $user_email);
  mysqli_stmt_execute($stmt);

  // bind the result variables
  mysqli_stmt_bind_result($stmt, $user_id, $db_user_name, $db_user_email, $hashedPassword);
  // fetch result
  mysqli_stmt_fetch($stmt);
  $verification_status = password_verify($password, $hashedPassword);

  if ($db_user_email && $verification_status) {
   $_SESSION['user_id'] = $user_id;
   $_SESSION['user_name'] = $db_user_name;
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

 // get todos by user id
 public function get_todo($user_id)
 {
  $query = "SELECT * FROM todos WHERE user_id=?";
  // prepare statement and bind the result
  $stmt = mysqli_prepare($this->connection, $query);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);

  $result_set = mysqli_stmt_get_result($stmt);
  mysqli_stmt_fetch($stmt);

  $result = mysqli_fetch_all($result_set, MYSQLI_ASSOC);

  if (isset($result)) {
   return $result;
  } else {
   return false;
  }
 }

 // update todo
 public function update_todo($data)
 {
  $todoId = $data['todo_id'];
  $updatedContent = $data['updated_content'];
  $selectedStatus = $data['selected_status'];

  $query = "UPDATE todos SET todo='$updatedContent', status=$selectedStatus WHERE todo_id=$todoId ";

  $result = mysqli_query($this->connection, $query);
  if ($result) {
   return true;
  } else {
   return false;
  }
 }
 // delete todo
 public function delete_todo($todo_id)
 {

  $query = "DELETE FROM todos WHERE todo_id=$todo_id ";

  $result = mysqli_query($this->connection, $query);
  if ($result) {
   return true;
  } else {
   return false;
  }
 }
}
