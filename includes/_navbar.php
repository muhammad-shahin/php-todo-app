<nav class="bg-blue-500 w-full py-3 flex justify-evenly items-center">
 <ul class="text-white font-semibold text-lg flex justify-center items-center gap-6">
  <!-- <a href="index.php">
   <li class="hover:text-gray-700  duration-300">Todo</li>
  </a> -->
  <?php
  if (!isset($_SESSION['user_id'])) {
   echo '<a href="login.php">
  <li class="hover:text-gray-700 duration-300">Login</li>
 </a>
 <a href="sign_up.php">
  <li class="hover:text-gray-700 duration-300">Sign Up</li>
 </a>';
  } else {
   echo `<li class="hover:text-gray-700 duration-300">`;
   echo "Welcome Back," .  '<span class="text-gray-700 text-2xl">' . $_SESSION['user_name'] . '</span>';
   echo `</li>`;
  }
  ?>

 </ul>
 <?php
 if (isset($_SESSION['user_id'])) {
  echo '<button class="px-5 py-2 rounded text-blue-500 bg-white font-semibold text-lg hover:bg-gray-500 hover:text-white duration-300" id="logoutBtn">Logout</button>';
 }
 ?>

</nav>