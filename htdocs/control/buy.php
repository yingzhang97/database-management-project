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



/*
$inventory_amount = "SELECT inventory_amount FROM products WHERE id = '$_POST[input_id]'";
$result = mysqli_query($link,$inventory_amount);
$row =  mysqli_fetch_assoc($result);
*/

session_start();
$id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];

$product_id = "SELECT 1 FROM bag WHERE product_id = '$_POST[input_id]'";
$result = mysqli_query($link,$product_id);
$row = mysqli_fetch_assoc($result);


if($id == "")
{
  echo 'You must login first!';
}
else
{
  if($row == NULL)
  {
    $insert_new = "INSERT INTO bag (product_id, product_name, quantity, price) VALUES ('$_POST[input_id]' ,'$_POST[input_name]', 1 , '$_POST[input_price]')";
    $result = mysqli_query($link,$insert_new);
    echo 'Successfully add to shopping cart!';
  }
  else
  {
    $increase_amount = "UPDATE bag SET quantity = quantity + 1 WHERE product_id = '$_POST[input_id]'";
    mysqli_query($link,$increase_amount);
    echo 'Successfully add to shopping cart!';
  }
}


$sum = "SELECT SUM(quantity) AS total FROM bag";
$result = mysqli_query($link,$sum);
$row = mysqli_fetch_assoc($result);
$row = $row['total'];

$_SESSION['bag_total'] = $row;

if( $_SESSION['bag_total'] == NULL)
{

  $_SESSION['bag_total'] = 0;
}

$sum = 0;

$two_mul = "SELECT quantity * price AS total FROM bag";
$result_m = mysqli_query($link,$two_mul);
while($row = mysqli_fetch_assoc($result_m)) 
            {
              $sum=  $row["total"] + $sum;
            }



/*
$sum_m = "SELECT SUM(total) AS t FROM bag";
$result_m = mysqli_query($link,$sum_m);
$row_m = mysqli_fetch_assoc($result_m);
echo mysqli_error($link);

echo $row_m;
*/




/*
if ($row['inventory_amount']==0)
{
  echo 'This product is currently out of stock!';
}
elseif ($id == "") 
{
  echo 'You must login first!';
}
else
{

  $sum = "SELECT COUNT(order_number) AS total FROM transactions";
  $result = mysqli_query($link,$sum);
  $order_number = mysqli_fetch_assoc($result);
  
  $order_number = $order_number['total'] + 1;



  $decrement_amount = "UPDATE products SET inventory_amount = inventory_amount - 1 WHERE id = '$_POST[input_id]'";
  $result = mysqli_query($link,$decrement_amount);

  $select_salesperson = "SELECT name FROM salesperson ORDER BY RAND ()  LIMIT 1";
  $result_salesperson = mysqli_query($link,$select_salesperson);
  $row =  mysqli_fetch_assoc($result_salesperson);
   
  $date = date("Y/m/d");
  
  
  $insert_trans = "INSERT INTO transactions ( order_number,  customer_id ,salesperson_name , date  ,price, product_id) VALUES 
  ('$order_number', '$id', '$row[name]', '$date', '$_POST[input_price]','$_POST[input_id]')";
  $result_trans = mysqli_query($link,$insert_trans);

  if($result&&$result_trans)
  {
    echo "Your purchase is successful. The product will be shipped to your address soon!";
  }
  else
  {
    echo "An error occur!";
    echo "query failed: " . mysqli_error($link)."<br><br>";
  }

}

*/
?>

<html>
<br>
<br>
  <style type="text/css">
  table, th, td {
  border: 1px solid black;
}
</style>
    <head>
        <title>Region</title>
    </head>
    <body>
        <table>
        <thead>
            <tr>
                <td>product id</td>
                <td>product name</td>
                <td>quantity</td>
                <td>price</td>
            </tr>
        </thead>
        <tbody>

 <?php 

    $bag = "SELECT *  FROM bag";
    $result = mysqli_query($link,$bag);
    while($row = $result->fetch_assoc()) {
        ?>

                 <tr>
                    <td><?php echo $row['product_id']?></td>
                    <td><?php echo $row['product_name']?></td>
                    <td><?php echo $row['quantity']?></td>
                    <td><?php echo $row['price']?></td>
                </tr>
            
          <?php
            }
            ?>
            </tbody>
            </table>
    </body>




<p>
Total price: $<?php echo $sum; ?> 
</p>

<hr>

<div class = 'check' id='check'>
  <form action="check.php">
  <input type='submit' name='check_button' value='check' style="width:60px" >
</form>
</div>

<br>



<br>



<button onclick="goBack()">Go Back</button>

<script>

function goBack() {
  window.history.back();
}
</script>
