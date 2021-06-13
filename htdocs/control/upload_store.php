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


$sql = "INSERT INTO store ( store_id,  address, salesperson_number,  manager, region_id)
VALUES ('$_POST[store_id_box]',  '$_POST[address_box]', '$_POST[salesperson_number_box]', '$_POST[manager_box]','$_POST[region_id_box]')";

$result = mysqli_query($link,$sql);

if ($result)
{
  echo 'query success<br><br>';


}
if(!$result)
{
  echo("query failed: " . mysqli_error($link)."<br><br>");

}






mysqli_close($link);




?>

<br>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>