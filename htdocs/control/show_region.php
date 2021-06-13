 <html>
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
                <td>region_id</td>
                <td>region_name</td>
                <td>region_manager</td>
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

    $products = "SELECT *  FROM region";
    $result = mysqli_query($link,$products);
    while($row = $result->fetch_assoc()) {
        ?>

                 <tr>
                    <td><?php echo $row['region_id']?></td>
                    <td><?php echo $row['region_name']?></td>
                    <td><?php echo $row['region_manager']?></td>
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