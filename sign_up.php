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
  <form action="" method="POST" class="space-y-6 min-w-[450px] p-10 rounded shadow-2xl">
   <h1 class="text-4xl text-center py-3">Create An Account</h1>
   <!-- full name -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Full Name</label>
    <input type="text" name="full_name" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Your Full Name">
   </div>

   <!-- Email -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Email</label>
    <input type="email" name="email" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Your Email Address">
   </div>

   <!-- Password -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Password</label>
    <input type="text" name="Password" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Enter Password">
   </div>

   <!-- confirm Password -->
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Confirm Password</label>
    <input type="text" name="c_Password" class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem]" placeholder="Confirm Password">
   </div>

   <!-- sign up button -->
   <input type="button" name="sign_up" class="w-full py-2 px-3 rounded bg-blue-500 border-2 border-blue-200 text-white font-semibold text-[1.2rem] cursor-pointer hover:bg-blue-700 duration-300" value="Create Account" onclick="handleButtonClick()">
  </form>
 </div>
 <?php include_once("includes/scripts.php") ?>

</body>

</html>