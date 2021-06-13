<?php
$user = 'root';
$password = 'root';
$db = 'digital_shop';
$host = 'localhost';
$port = 3306;

$link = mysqli_init();

$success = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);


$password = "SELECT * FROM customer WHERE name = '$_POST[name]' ";
$result = mysqli_query($link,$password);
$row = mysqli_fetch_assoc($result); 

if($_POST[password] == $row['password'])
{
  $flag = 1;
  echo "Login success!<br>";
  echo 'You will be redirected to the main page in 3 seconds.';
  session_start();
  $_SESSION['user_id'] = $row['customer_id'];
  $_SESSION['user_name'] = $_POST['name'];
  $_SESSION['bag_total'] = 0;
}
else
{
  echo "Wrong password or user name!";
}


?>

<br>
<button onclick="goBack()">Go Back</button>
<script>
  function goBack() {
  window.history.back();
}

</script>



<script>




if( <?php echo $flag ?> == 1)
{


  setTimeout(goto_main, 3000);
  

  function goto_main()
  {
   window.location.href = '../client_page.php';
  }

}


</script>

