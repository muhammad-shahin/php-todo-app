<?php
// check if user id found in session then stay otherwise send to login page
session_start();
if (!isset($_SESSION['user_id'])) {
 header("Location: login.php");
 exit();
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
 <h1 class="text-4xl">Hello Ji</h1>


 <!-- scripts -->
 <?php
 include_once("includes/scripts.php");
 ?>
</body>

</html>