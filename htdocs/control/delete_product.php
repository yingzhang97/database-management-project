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


$sql_pic_name = " SELECT product_pic FROM products WHERE id = '$_POST[delete_box]'";
$pic_name = mysqli_query($link,$sql_pic_name);

if($pic_name)
{
  if (mysqli_num_rows($pic_name) > 0) 
  {
            while($row = mysqli_fetch_assoc($pic_name)) 
            {
              $result_pic_name =  $row["product_pic"];
            }
            $parent_dir = dirname(getcwd());
            $deletedir = $parent_dir ;
            $deletefile = $deletedir.'/pic/'.basename($result_pic_name);
            unlink($deletefile);
            echo 'photo deletion success<br><br>';
         } 
         else 
         {
            echo "0 results";
         }
}



else
{
  echo("query failed: " . mysqli_error($link)."<br><br>");

}


$sql = "DELETE FROM products WHERE id = '$_POST[delete_box]'";


$result = mysqli_query($link,$sql);

if ($result)
{

  echo 'data deletion success<br><br>';

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