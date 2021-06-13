<?php

$user = 'root';
$password = 'root';
$db = 'digital_shop';
$host = 'localhost';
$port = 3306;

$link = mysqli_init();
if ($link)
  {
  echo 'init success<br><br>';
  }


$success = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);


if ($success)
{
  echo 'connection success<br><br>';
}



if($_POST[customer_type] == "home")
{

$sum = "SELECT COUNT(customer_id) AS value_sum FROM customer";
$result = mysqli_query($link,$sum);
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
$new_id = $sum + 1;

$customer_sql = "INSERT INTO customer (customer_id, name,address,kind,password)
VALUES ($new_id, '$_POST[name]', '$_POST[address]','home', '$_POST[password]')";


$result_1 = mysqli_query($link,$customer_sql);

if ($result_1)
{
  echo 'Add to customer query success<br><br>';

}
if(!$result_1)
{
  echo("Add to customer query failed: " . mysqli_error($link)."<br><br>");

}



$chome_sql = "INSERT INTO chome (customer_id, gender,  marriage,  age, income)
VALUES ($new_id, '$_POST[gender]', '$_POST[marriage]', '$_POST[age]', '$_POST[income]')";
$result_2 = mysqli_query($link,$chome_sql);
if ($result_2)
{
  echo 'Add to chome query success<br><br>';
  echo 'You will be redirected to the main page in 3 seconds.';
  session_start();
  $_SESSION['user_id'] = $new_id;
  $_SESSION['user_name'] = $_POST['name'];

}
if(!$result_2)
{
  echo("Add to chome query failed: " . mysqli_error($link)."<br><br>");
  
}



}

if($_POST[customer_type] == "business")
{


$sum = "SELECT COUNT(customer_id) AS value_sum FROM customer";
$result = mysqli_query($link,$sum);
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];
$new_id = $sum + 1;

$customer_sql = "INSERT INTO customer (customer_id, name,address,kind,password)
VALUES ($new_id, '$_POST[name]', '$_POST[address]','business', '$_POST[password]')";


$result_1 = mysqli_query($link,$customer_sql);

if ($result_1)
{
  echo 'Add to customer query success<br><br>';


}
if(!$result_1)
{
  echo("Add to customer query failed: " . mysqli_error($link)."<br><br>");

}



$cbusiness_sql = "INSERT INTO cbusiness (customer_id, category, annual_income)
VALUES ($new_id, '$_POST[category]', '$_POST[income]')";
$result_2 = mysqli_query($link,$cbusiness_sql);
if ($result_2)
{
  echo 'Add to cbusiness query success<br><br>';
  echo 'You will be redirected to the main page in 3 seconds.';
  session_start();
  $_SESSION['user_id'] = $new_id;
  $_SESSION['user_name'] = $_POST['name'];
}
if(!$result_2)
{
  echo("Add to chome query failed: " . mysqli_error($link)."<br><br>");
  
}


}
?>


<script>
if( <?php echo $result_2 ?>&&<?php echo $result_1 ?>)
{


  setTimeout(goto_main, 3000);
  

  function goto_main()
  {
   window.location.href = '../client_page.php';
  }

}


function goBack() {
  window.history.back();
}
</script>
