<script src="assets/js/sweetalart.js"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"> </script>
<script>
  document.getElementById("logoutBtn").addEventListener("click", function() {
    console.log("logout clicked");

    // logout user
    fetch("logout.php")
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log(data);
        swal.fire({
          position: "center",
          title: "Successfully Logged Out",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        }).then(function() {
        location.reload();
      });
      })
  });

  // update todo
  $(document).ready(function() {
    $('.update-edit-btn').on('click', function() {
      var todoId = $(this).data('todo-id');
      var updatedContent = $('.editable-todo-' + todoId).text();
      var selectedStatus = $('.selected-status-' + todoId).val();
      // Ajax request to update todo
      $.ajax({
        type: 'POST',
        url: 'update_todo.php',
        data: {
          todo_id: todoId,
          updated_content: updatedContent,
          selected_status: selectedStatus,
        },
        success: function(response) {
          console.log('Update Status : ', response);
          if (response) {
            swal.fire({
              position: "center",
              title: "Successfully Update Last Edit",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            })
          }
        }
      });
    });
  });

  // delete todo
  $(document).ready(function() {
    $('.delete-todo-btn').on('click', function() {
      var todoId = $(this).data('todo-id');
      console.log(todoId);
      // Ajax request to update todo
      $.ajax({
        type: 'POST',
        url: 'delete_todo.php',
        data: {
          todo_id: todoId,
        },
        success: function(response) {
          console.log('Delete Status : ', response);
          if (response) {
            swal.fire({
              position: "center",
              title: "Todo Removed From List",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            }).then(function() {
              location.reload();
            });
          }
        }
      });
    });
  });

  // add new todo
  $(document).ready(function() {
    $('#addTodoForm').submit(function(e) {
      e.preventDefault();
      if (!e.target.new_todo.value) {
        swal.fire({
          position: "center",
          title: "Please Add Some Text",
          icon: "warning",
          showConfirmButton: false,
          timer: 1500
        })
      } else {
        $.ajax({
          type: 'POST',
          url: 'add_todo.php',
          data: $(this).serialize(),
          success: function(response) {
            console.log('Add Todo status : ', response);
            if (response) {
              swal.fire({
                position: "center",
                title: "New Todo Added On List",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                location.reload();
              });
            }
          }
        });
      }
    });
  });
</script>