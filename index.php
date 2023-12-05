<?php
// check if user id found in session then stay otherwise send to login page
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
 header("Location: login.php");
 exit();
}
$user_name = $_SESSION['user_name'];
include("Class/function.php");
$todo_app = new TodoApp();
$all_todos = $todo_app->get_todo($user_id);
if (isset($all_todos)) {
 $todo_count = count($all_todos);
 // echo "<pre>";
 // echo $todo_count;
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
 <div class="w-full min-h-[90vh] flex justify-center items-center flex-col gap-10">
  <h1 class="text-4xl text-center py-3">Your Todo List</h1>
  <table class="min-w-[70%] max-w-[90%] shadow-2xl">
   <thead class="">
    <tr class="border-2 border-gray-500 text-center text-white bg-blue-500 font-semibold text-lg ">
     <td class="border-2 border-gray-500 p-3">#</td>
     <td class="border-2 border-gray-500">Task</td>
     <td class="border-2 border-gray-500">Status</td>
     <td class="border-2 border-gray-500">Date Created</td>
     <td class="border-2 border-gray-500">Action</td>
    </tr>
   </thead>

   <tbody>
    <?php if (isset($all_todos)) {
     foreach ($all_todos as $index => $todo) {
    ?>
      <tr class="border-2 border-gray-500 text-center text-blue-500 font-medium text-lg bg-gray-50">
       <!-- todo serial number -->
       <td class="border-2 border-gray-500 p-3"><?php echo $index + 1 ?></td>

       <!-- todo content -->
       <td class="border-2 border-gray-500  p-3 max-w-[450px]">
        <div contenteditable="true" class="editable-todo-<?php echo $todo['todo_id'] ?>">
         <?php echo $todo['todo'] ?>
        </div>
       </td>

       <!-- todo status -->
       <td class="border-2 border-gray-500 p-3">
        <select class="py-2 px-3 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem] selected-status-<?php echo $todo['todo_id'] ?>">
         <?php echo $todo['status'] == false ? '<option value="0">Pending</option> <option value="1">Complete</option>' : '<option value="1">Complete</option> <option value="0">Pending</option>'; ?>
        </select>
       </td>

       <!-- todo created date -->
       <td class="border-2 border-gray-500 p-3"> <?php echo $todo['date_created'] ?></td>

       <!-- action buttons -->
       <td class="flex flex-col gap-4 justify-center items-center p-3">
        <!--  -->
        <button data-todo-id="<?php echo $todo['todo_id'] ?>" class="px-5 py-2 bg-green-500 text-white rounded update-edit-btn">Update Edit</button>

        <button data-todo-id="<?php echo $todo['todo_id'] ?>" class="px-5 py-2 bg-red-500 text-white rounded delete-todo-btn">Delete</button>
       </td>
      </tr>
     <?php }
    } if ( count($all_todos) === 0) {  ?>
     <!-- when no todo item available -->
     <tr class="border-2 border-gray-500 text-center text-blue-500 font-medium text-lg bg-gray-50">
      <td class="border-2 border-gray-500 text-center p-3" colspan="5">No Available Task</td>
     </tr>

    <?php } ?>
   </tbody>
  </table>



  <!-- add task -->
  <form action="" method="POST" class="space-y-6 min-w-[70%] p-10 rounded shadow-2xl" id="addTodoForm">
   <h1 class="text-4xl text-center py-3">Add New Todo</h1>
   <div class="flex flex-col gap-2 w-full">
    <label class="text-lg font-semibold text-blue-400">Create New Todo</label>
    <textarea name="new_todo" class="py-2 px-1 bg-gray-50 rounded outline-blue-500 border-2 border-blue-200 text-blue-400 font-semibold text-[1.2rem] add-todo" cols="30" rows="3" required>
      </textarea>
   </div>

   <!-- add task button -->
   <input type="submit" name="add_todo" class="w-full py-2 px-3 rounded bg-blue-500 border-2 border-blue-200 text-white font-semibold text-[1.2rem] cursor-pointer hover:bg-blue-700 duration-300" value="ADD">
  </form>

 </div>


 <!-- scripts -->
 <?php
 include_once("includes/scripts.php");
 ?>

</body>

</html>