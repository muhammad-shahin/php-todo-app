<?php
include("Class/function.php");
$todo_app = new TodoApp();
if (isset($_POST['sign_up'])) {
 $email = $_POST['user_email'];
 $exist = $todo_app->is_exist($email);
 // echo "<pre>";
 // echo ($exist);
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
 <title>Sign Up - PHP TODO APP</title>
</head>

<body>
 <!-- navbar -->
 <?php
 include_once("includes/_navbar.php");
 ?>
 <div class="w-full h-[90vh] flex justify-center items-center flex-col">
  <form action="" method="POST" class="space-y-6 min-w-[450px] p-10 rounded shadow-2xl" id="signupForm">
   <h1 class="text-4xl text-center py-3">Create An Account</h1>
   <!-- full name -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Full Name</label>
    <input type="text" name="full_name" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Your Full Name" required>
   </div>

   <!-- Email -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Email</label>
    <input type="email" name="user_email" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Your Email Address" required>
   </div>

   <!-- Password -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Password</label>
    <input type="text" name="Password" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Enter Password" required>
   </div>

   <!-- confirm Password -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Confirm Password</label>
    <input type="text" name="c_Password" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Confirm Password" required>
   </div>

   <!-- sign up button -->
   <input type="submit" name="sign_up" class="w-full py-2 px-3 rounded bg-blue-500 border-2 border-blue-200 text-white font-semibold text-[1.2rem] cursor-pointer hover:bg-blue-700 duration-300" value="Create Account">

   <!-- show user exist status -->
   <?php if (isset($exist) && $exist === true) {
    echo '<p class="text-red-500 font-medium text-lg text-center">User Already Exist! </p>';
   } elseif (isset($exist) && $exist !== true) {
    echo '<p class="text-green-500 font-medium text-lg text-center">No User Found With This Email</p>';
   }   ?>
  </form>
 </div>
 <?php include_once("includes/scripts.php") ?>
 <script>
  document.getElementById('signupForm').addEventListener('submit', function(event) {
   const password = this.elements['Password'].value;
   const c_password = this.elements['c_Password'].value;

   if (password !== c_password) {
    swal("Password Not Matched!", "Please recheck your password", "warning");
    event.preventDefault(); // Prevent form submission if passwords don't match
   } else {
    // Form is valid, trigger a click on the submit button
    document.getElementsByName('sign_up')[0].click();
   }
  });
 </script>

</body>

</html>