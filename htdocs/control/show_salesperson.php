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
                <td>name</td>
                <td>store id</td>
                <td>address</td>
                <td>job title</td>
                <td>email</td>
                <td>salary</td>
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

    $products = "SELECT *  FROM salesperson";
    $result = mysqli_query($link,$products);
    while($row = $result->fetch_assoc()) {
        ?>

                 <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['store_id']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><?php echo $row['job_title']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['salary']?></td>
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