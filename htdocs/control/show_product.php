 <html>
  <style type="text/css">
  table, th, td {
  border: 1px solid black;
}
</style>
    <head>
        <title>Products</title>
    </head>
    <body>
        <table>
        <thead>
            <tr>
                <td>id</td>
                <td>product_name</td>
                <td>inventory_amount</td>
                 <td>price</td>
                 <td>kind</td>
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

    $products = "SELECT *  FROM products";
    $result = mysqli_query($link,$products);
    while($row = $result->fetch_assoc()) {
        ?>

                 <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['product_name']?></td>
                    <td><?php echo $row['inventory_amount']?></td>
                    <td><?php echo $row['price']?></td>
                    <td><?php echo $row['kind']?></td>
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