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
                <td>customer id</td>
                <td>name</td>
                <td>address</td>
                 <td>kind</td>
                 <td>password</td>
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

    $products = "SELECT *  FROM customer";
    $result = mysqli_query($link,$products);
    while($row = $result->fetch_assoc()) {
        ?>

                 <tr>
                    <td><?php echo $row['customer_id']?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['kind']?></td>
                    <td><?php echo $row['password']?></td>
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