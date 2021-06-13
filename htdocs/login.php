<form action='/control/login_db.php' method='post' enctype='multipart/form-data'>
  <div class="container">
    <h1>Login</h1>
    <hr>

    <label for="name"><b>User Name</b></label>
    <input type="text" placeholder="Enter your name" name ="name" id="name" required disabled><br><br>

    <label for="psw"><b>Password</b></label>
    <input type="text" placeholder="Enter Password" name="password"  id="password" required disabled><br><br>

   <input class='login_button' type='submit' name='login_button'  value='login'>
  </div>
  <div class="container signin">
    <p>Already have an account? <a href="#">Sign in</a>.</p>
  </div>
</form>


<br>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>