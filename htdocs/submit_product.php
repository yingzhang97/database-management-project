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


$pic_name = $_FILES['user_file']['name'];

$sql = "INSERT INTO products (id, product_name, inventory_amount, price,kind,product_pic)
VALUES ('$_POST[id_box]', '$_POST[name_box]', '$_POST[amount_box]', '$_POST[price_box]', '$_POST[kind_box]','$pic_name')";

$result = mysqli_query($link,$sql);

if ($result)
{
  echo 'query success<br><br>';



  $uploaddir = 'pic/';
  $uploadfile = $uploaddir . basename($_FILES['user_file']['name']);


  if (move_uploaded_file($_FILES['user_file']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.<br><br>\n";
  } 
  else 
  {
   echo "Upload failed<br><br>";
  }

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