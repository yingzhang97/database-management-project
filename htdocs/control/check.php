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


session_start();
$id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$bag_total = $_SESSION['bag_total'];

$id_in_bag = "SELECT product_name, product_id,quantity FROM bag";
$result = mysqli_query($link,$id_in_bag);
$flag = True;


while($row = $result->fetch_assoc()) 
{

 $inventory = "SELECT inventory_amount FROM products WHERE id = '$row[product_id]'";
 $result_i = mysqli_query($link,$inventory);
 $row_i = mysqli_fetch_assoc($result_i);

 if($row_i["inventory_amount"] - $row["quantity"] < 0) 
 {
   echo "Sorry, we don't have enough ". $row["product_name"]. "!  ";
   echo "Please log out and add items to shopping cart again!";
   $flag = False;
 }
}


if($flag == True)
{  
   $sum = "SELECT COUNT(order_number) AS total FROM transactions";
   $result_s = mysqli_query($link,$sum);
   $order_number = mysqli_fetch_assoc($result_s);
   if($order_number == 0)
   {
   	$order_number = 1;
   }
   else
   {
    $sum = "SELECT order_number FROM transactions ORDER BY order_number DESC  LIMIT 1";
    $result_s = mysqli_query($link,$sum);
    $order_number = mysqli_fetch_assoc($result_s);
    $order_number = $order_number['order_number'] + 1;
   }
  

    
   $id_in_bag = "SELECT product_name, product_id,quantity FROM bag";
   $result = mysqli_query($link,$id_in_bag);
   

   $select_salesperson = "SELECT name FROM salesperson ORDER BY RAND ()  LIMIT 1";
   $result_salesperson = mysqli_query($link,$select_salesperson);
   $row_p =  mysqli_fetch_assoc($result_salesperson);
   $date = date("Y/m/d");
   
   while($row = $result->fetch_assoc()) 
   {
     $inventory = "SELECT inventory_amount, price,id FROM products WHERE id = '$row[product_id]'";
     $result_i = mysqli_query($link,$inventory); 
     $row_i = mysqli_fetch_assoc($result_i);

     $update = "UPDATE products SET inventory_amount = inventory_amount - $row[quantity] WHERE id = '$row[product_id]'";
     $result_u = mysqli_query($link,$update);

     $insert_trans = "INSERT INTO transactions ( order_number,  customer_id ,salesperson_name , date ,price, product_id , quantity) VALUES ('$order_number', '$id', '$row_p[name]', '$date','$row_i[price]','$row_i[id]','$row[quantity]')";
     $result_trans = mysqli_query($link,$insert_trans);


     }

     
   echo "Congratulation! Your order has been successfully placed! <br>";
   echo 'You will be redirected to the main page in 3 seconds.';

   $_SESSION['bag_total'] = 0 ;

   $clean_table = "DELETE FROM bag";
   
   $result = mysqli_query($link,$clean_table);
   $row = mysqli_fetch_assoc($result); 




}


?>


<br>

<br>
<button class="back" onclick="goBack()">Go Back</button>

<script type="text/javascript">
function goBack() {
  window.history.back();
}


</script>

<script>



if( <?php echo $flag ?>)
{


  setTimeout(goto_main, 3000);
  

  function goto_main()
  {
   window.location.href = '../client_page.php';
  }

}





</script>
