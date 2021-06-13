 <html>
<style type="text/css">
  table, th, td {
  border: 1px solid black;
}
</style>


    <head>
        <title>Store</title>
    </head>
    <body>
        <table>
        <thead>
            <tr>
                <td>store_id</td>
                <td>address</td>
                <td>salesperson_number</td>
                <td>manager</td>
                <td>region_id</td>
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

    $products = "SELECT *  FROM store";
    $result = mysqli_query($link,$products);
    while($row = $result->fetch_assoc()) {
        ?>


                 <tr>
                    <td><?php echo $row['store_id']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['salesperson_number']?></td>
                    <td><?php echo $row['manager']?></td>
                    <td><?php echo $row['region_id']?></td>
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