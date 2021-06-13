<?php  
    session_start();
    $id = $_SESSION['user_id'];
    $name = $_SESSION['user_name'];
    $bag_total =$_SESSION['bag_total'];


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

    $products = "SELECT *  FROM products ORDER BY id DESC  LIMIT 3";
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


<!DOCTYPE html>
<html>


<style type="text/css">

h1 {
    font-style:Serif;
    color:black;
    font-size:45px;
   }

h2 {
  position: absolute;
  left: 30px;
  top:120px;
  font-size: 40px;
}

h3 {
  position: absolute;
  left: 30px;
  top:700px;
  font-size: 40px;
}


.search{
  position: absolute;
  right: 200px;
  top: 90px;
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

.user_info{
  position: absolute;
  right: 170px;
  top: 35px;
}


input[name=search_button]{
  position: absolute;
  right: -130px;
  top: 0px;
}

.categories{
  position: absolute;
  left: 200px;
  top: 90px;
}

.category_button{
  font-style: Serif;
  color: black;
  text-decoration: none;
  font-size: 20px;

}

.product_img{
  height:300px;
  width:150px;
}

.products{
  position: absolute;
  left: 100px;
  top: 200px;
}

.pull-left { 
  float:left; 
  padding: 50px;
  display: inline-block;
}

</style>


<body>

<div class='shop name' style="border: 0px solid #000000; width: 400px; height: 100px;margin: 0 auto;top:50px;">
<h1 >Noob digital shop</h1>
</div>

<div class ='search'; style="border: 0px solid #000000; width: 100px; height: 100px">
<form action='./control/search.php'  method='post' enctype='multipart/form-data'>
<input type='text' name='search_box' required>
<input type='submit' name='search_button' value='Search'>
</form>
</div>

<div class = 'sign_up' id='sign_up'>
  <form action="sign_up.html">
  <input type='submit' name='Sign_up_button' value='Sign Up' style="width:60px" >
</form>
</div>

<div  class = 'login' id='login'>
  <form action="./control/login.php">
  <input type='submit' name='login_button' value='Login' style="width:60px">
</form>
</div>


<div class = 'log_out' >
  <form action="./control/log_out.php">
  <input type='submit' id='log_out' name='Log_out_button' value='Log out' style="width:60px ;visibility: hidden" >
</form>
</div>


<p class = "user_info" id="user_info"></p>

<div class='categories' id='cat' >
  <span style="padding-left:170px">
  <a class="category_button" href='./products/laptop.php' title='Laptop'>Laptop</a>
  </span>
  <span style="padding-left:90px">
  <a class="category_button" href='./products/phone.php' title='Phone'>Phone</a>
  </span>
  <span style="padding-left:90px">
  <a class="category_button" href='./products/camera.php' title='Camera'>Camera</a>
  </span>
  <span style="padding-left:90px">
  <a class="category_button" href='./products/headphone.php' title='Headphone'>Headphone</a>
  </span>
  <span style="padding-left:90px">
  <a class="category_button" href='./products/TV.php' title='TV'>TV</a>
  </span>
    </div>
  
<hr>

<div  style="border: 0px solid #000000; width: 300px; height: 10px;margin: 0 auto;">
<h2>New Arrivals</h2>
</div>

<div id = "products" class="pull-left"></div>
   
</body>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script>
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


    var element_bag = document.createElement("a");
    element_bag.href = './control/buy.php';
    element_bag.innerHTML = 'Bag('+ <?php echo $_SESSION['bag_total']; ?> +')';
    element_bag.style = 'font-style: Serif;color: black;text-decoration: none;position: absolute;left: 50px;top: 50px;';
    document.body.appendChild(element_bag);


    var p_div = document.getElementById("products");

    for(i = 0; i < data.length;i ++ )
    {
    
     var element_form = document.createElement("form")
     element_form.action = "./control/buy.php";
     element_form.method='post' ;
     element_form.enctype='multipart/form-data';
     element_form.style='float:left;padding: 80px;';


     var element_div = document.createElement("div")

     var img_name = "p" + i +"_image";
     var element_img = document.createElement("img");
     element_img.src = "./pic/" + data[i].product_pic;
     element_img.style = "width:260px;height:250px";
     element_form.appendChild(element_img);

     var p_name = data[i].product_name;
     var name_text = document.createElement("p");
     name_text.innerHTML = p_name;
     element_form.appendChild(name_text);

     var p_price = data[i].price;
     var price_text = document.createElement("p")
     price_text.innerHTML = '$' +  p_price ;
     element_form.appendChild(price_text);
 
     var input_record_name = document.createElement("input");
     input_record_name.name = "input_name";
     input_record_name.style = "visibility:hidden;width:0px";
     input_record_name.value = data[i].product_name;
     element_form.appendChild(input_record_name);


     var input_record_id = document.createElement("input");
     input_record_id.name = "input_id";
     input_record_id.style = "visibility:hidden;width:0px";
     input_record_id.value = data[i].id;
     element_form.appendChild(input_record_id);
     
     var input_record_price = document.createElement("input");
     input_record_price.name = "input_price";
     input_record_price.style = "visibility:hidden;width:0px";
     input_record_price.value = data[i].price;
     element_form.appendChild(input_record_price);

     var buy_button = document.createElement("input");
     buy_button.type = "submit";
     buy_button.value = "Buy";

     element_form.appendChild(buy_button);
     
     p_div.appendChild(element_form);

 

    }
   
</script>

</html>
