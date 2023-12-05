<script src="assets/js/sweetalart.js"></script>
<script>
 document.getElementById("logoutBtn").addEventListener("click", function() {
  console.log("logout clicked");

  // Make an asynchronous request to logout.php using fetch
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
    })
    setTimeout(() => {
     window.location.href = "/php-todo-app/login.php";
    }, 1200)
   })
   .catch(error => {
    console.error("Error during logout:", error);
   });
 });
</script>