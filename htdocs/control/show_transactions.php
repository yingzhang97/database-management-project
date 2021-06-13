 <html>
 <style type="text/css">
  table, th, td {
  border: 1px solid black;
}
</style>
    <head>
        <title>Transaction</title>
    </head>
    <body>
        <table>
        <thead>
            <tr>
                <td>order_number</td>
                <td>customer_id</td>
                <td>salesperson_name</td>
                <td>date</td>
                <td>price</td>
                <td>product_id</td>
                <td>quantity</td>
            </tr>
        </thead>
        <tbody>


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

    $products = "SELECT *  FROM transactions";
    $result = mysqli_query($link,$products);
    while($row = $result->fetch_assoc()) {
        ?>

                 <tr>
                    <td><?php echo $row['order_number']?></td>
                    <td><?php echo $row['customer_id']?></td>
                    <td><?php echo $row['salesperson_name']?></td>
                    <td><?php echo $row['date']?></td>
                    <td><?php echo $row['price']?></td>
                    <td><?php echo $row['product_id']?></td>
                    <td><?php echo $row['quantity']?></td>  
                </tr>
            
          <?php
            }
            ?>
            </tbody>
            </table>
    </body>

<br>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>

    
</html>