<?php  
    session_start();
    $id = $_SESSION['user_id'];
    $name = $_SESSION['user_name'];
   
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

 $products = "SELECT *  FROM products WHERE kind ='headphone' ";
    $result = mysqli_query($link,$products);
  
    function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
    }


    $rows = resultToArray($result);


?>


<style type="text/css">
.user_info{
  position: absolute;
  right: 170px;
  top: 35px;
}

.login{
  position: absolute;
  right: 170px;
  top: 50px;
}

.log_out{
  position: absolute;
  right: 70px;
  top: 50px;

}

.sign_up{
  position: absolute;
  right: 240px;
  top: 50px;
}

.back{
  position: absolute;
  left: 140px;
  top: 50px;
}

h1 {
    font-style:Serif;
    color:black;
    font-size:45px;
   }

</style>


<div class='shop name' style="border: 0px solid #000000; width: 400px; height: 100px;margin: 0 auto;">
<h1>Noob digital shop</h1>
</div>

<div class = 'sign_up' id='sign_up'>
  <form action="../sign_up.html">
  <input type='submit' name='Sign_up_button' value='Sign Up' style="width:60px" >
</form>
</div>

<div  class = 'login' id='login'>
  <form action="../control/login.php">
  <input type='submit' name='login_button' value='Login' style="width:60px">
</form>
</div>


<div class = 'log_out' >
  <form action="./control/log_out.php">
  <input type='submit' id='log_out' name='Log_out_button' value='Log out' style="width:60px ;visibility: hidden" >
</form>
</div>

<hr>

<p class = "user_info" id="user_info"></p>


<div id = "products" class="inline"></div>


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script>
    var element_bag = document.createElement("a");
    element_bag.href = '../control/buy.php';
    element_bag.innerHTML = 'Bag('+ <?php echo $_SESSION['bag_total']; ?> +')';
    element_bag.style = 'font-style: Serif;color: black;text-decoration: none;position: absolute;left: 50px;top: 50px;';
    document.body.appendChild(element_bag);

   if( "<?php echo $id; ?>" != "")
    {
      document.getElementById("sign_up").style = "visibility: hidden";
      document.getElementById("login").style = "visibility: hidden";
      document.getElementById("log_out").style = "visibility: visible";
      document.getElementById("user_info").innerHTML = "Hello, " + "<?php echo $name ?>" +"!";
    }
    else
    {
      document.getElementById("sign_up").style = "visibility: visible";
      document.getElementById("login").style = "visibility: visible";
      document.getElementById("log_out").style = "visibility: hidden";
      document.getElementById("user_info").innerHTML = "";
    }

    var data = <?php echo(json_encode($rows)); ?>;
    console.log(data);
    var p_div = document.getElementById("products");
    for(i = 0; i < data.length;i ++ )
    {
    
     var element_form = document.createElement("form")
     element_form.action = "../control/buy.php";
     element_form.method='post' ;
     element_form.enctype='multipart/form-data';
     element_form.style='float:left;padding: 80px;';
     
     var element_div = document.createElement("div")


     var img_name = "p" + i +"_image";
     var element_img = document.createElement("img");
     element_img.src = "../pic/" + data[i].product_pic;
     element_img.style = "width:200px;height:250px";
     element_form.appendChild(element_img);

     var p_name = data[i].product_name;
     var name_text = document.createElement("p")
     name_text.innerHTML = p_name;
     element_form.appendChild(name_text);

     var p_price = data[i].price;
     var price_text = document.createElement("p")
     price_text.innerHTML = '$' +  p_price;
     element_form.appendChild(price_text);

     var input_record_id = document.createElement("input")
     input_record_id.name = "input_id";
     input_record_id.style = "visibility:hidden;width:0px";
     input_record_id.value = data[i].id;
     element_form.appendChild(input_record_id);

     var input_record_name = document.createElement("input");
     input_record_name.name = "input_name";
     input_record_name.style = "visibility:hidden;width:0px";
     input_record_name.value = data[i].product_name;
     element_form.appendChild(input_record_name);     
     
     var input_record_price = document.createElement("input")
     input_record_price.name = "input_price";
     input_record_price.style = "visibility:hidden;width:0px";
     input_record_price.value = data[i].price;
     element_form.appendChild(input_record_price);

     var buy_button = document.createElement("input")
     buy_button.type = "submit";
     buy_button.value = "Buy";

     element_form.appendChild(buy_button);
     
     element_div.appendChild(element_form);
     p_div.appendChild(element_div);

 

    }
   

</script>

<br>
<button class = 'back' onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>