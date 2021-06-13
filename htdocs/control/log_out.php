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
   $_SESSION['user_id'] = '';
   $_SESSION['user_name'] = '';
   $_SESSION['bag_total'] = 0 ;

   $clean_table = "DELETE FROM bag";
   
   $result = mysqli_query($link,$clean_table);
   $row = mysqli_fetch_assoc($result); 




   echo "Successfully log out!<br>";
   echo 'You will be redirected to the main page in 3 seconds.';
 
?>

<script>
  setTimeout(goto_main, 3000);
  

  function goto_main()
  {
   window.location.href = '../client_page.php';
  }

  </script>