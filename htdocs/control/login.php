<form action='/control/login_db.php' method='post' enctype='multipart/form-data'>
  <div class="container">
    <h1>Login</h1>
    <hr>

    <label for="name"><b>User Name</b></label>
    <input type="text" placeholder="Enter your name" name ="name" id="name" required><br><br>

    <label for="psw"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" name="password"  id="password" required><br><br>

   <input class='login_button' type='submit' name='login_button'  value='login'>
  </div>
</form>



<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>