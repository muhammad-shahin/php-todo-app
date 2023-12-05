<?php
// if already logged in send user to home page
session_start();
if (isset($_SESSION['user_id'])) {
 header("Location: index.php");
 exit();
}

include("Class/function.php");
$todo_app = new TodoApp();
if (isset($_POST['login'])) {
 $login_status = $todo_app->login($_POST);
 // echo "<pre>";
 // print_r($login_status);
 // echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- tailwind css cdn -->
 <script src="https://cdn.tailwindcss.com"></script>
 <title>PHP TODO APP</title>
</head>

<body>
 <?php
 include_once("includes/_navbar.php");
 ?>

 <div class="w-full min-h-[90vh] flex justify-center items-center">
  <form action="" method="POST" class="space-y-6 min-w-[450px] p-10 rounded shadow-2xl">
   <h1 class="text-4xl text-center py-3">Login To Your Account</h1>

   <!-- Email -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Email</label>
    <input type="email" name="user_email" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Your Email Address">
   </div>

   <!-- Password -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Password</label>
    <input type="password" name="password" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Enter Password">
   </div>

   <!-- login button -->
   <input type="submit" name="login" class="w-full py-2 px-3 rounded bg-blue-500 border-2 border-blue-200 text-white font-semibold text-[1.2rem] cursor-pointer hover:bg-blue-700 duration-300" value="Login">

   <!-- navigate to sign up page -->
   <p class="text-lg font-medium text-center">Don't Have an Account? <a href="/php-todo-app/sign_up.php" class="text-blue-500 underline">Create Account</a></p>


   <!-- show wrong credential error msg -->
   <?php if (isset($login_status) && $login_status !== true) {
    echo '<p class="text-red-500 font-medium text-lg text-center">Invalid Email or Password</p>';
   } ?>
  </form>
 </div>
 <?php include_once("includes/scripts.php") ?>
 <script>
  <?php if (isset($login_status) && $login_status === true) {
   echo 'swal.fire({
    position: "center",
    title: "Successfully Logged In",
    icon: "success",
    showConfirmButton: false,
    timer: 1500
   }).then(function() {
    window.location.href = "/php-todo-app";
  });
   ';
  } ?>
 </script>
</body>

</html>