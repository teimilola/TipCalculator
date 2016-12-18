<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
</head>
<body>
<style>
  input[type=submit]{
     background-color: #678594;
     height: 35px;
     width: 65px;
     border: none;
     padding: 30px, 15px;
     margin-left: 135px;
  }
  .box{
     border: 1px solid #678594;
     width: 340px;
     margin-left: 45px;
     height: 40%;
  }
  .vis{
     border: 0px solid red;
     width: 80%;
     height: 70px;

  }
  h2{
     margin-left: 37px;
     font-family: Lobster, sans-serif;
     font-size: 22px;
     text-align: center;
     text-decoration-color: #4099FF;
     padding-top: 10px;
  }
  input[type=radio]{
     width: 23px;
     height: 22px;
      text-align: justify;
      border: 2px solid #b0bec5;
      margin-left: 26px;
  }

  input[type=radio]:focus{
     background-color: #678594;
  }
  .small-box{
      background-color: #8e9599;
      padding: 0px;
      width: 100%;
      height: 50px;
  }
  label{
     text-align: left;
     margin-left: 26px;
  }
  .fun-div{
    margin-left: 26px;
  }
  input[input=text}{
      width: 60%;
      height: 100px;
      margin-left:26px;
      margin-top:26px;
      margin-bottom:26px;
      padding-top: 10px;
      padding-left: 10px;
      /*margin: 8px 0;*/
      box-sizing: border-box;
      border: 1px solid #eceff1;
      -webkit-transition: 0.5s;
      transition: 0.5s;
      outline: none;
  }
  input[input=text]:focus{
     border-color: #bobec5;
  }
</style>
<div class="box">
<div class="small-box">
<h2>Tip Calculator</h2>
</div>
<br>
<form method= "post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<label for= "bill">Bill Subtotal: $</label>
<input type = "text" style="width:60%;" id= "bill" name="bill" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST"){ echo format_input($_POST["bill"]); } ?>"><br><br>
<label for= "tips" class="vis" id="vis">Tip Percentage: </label> <br><br>
<?php
   for($i = 0; $i < 3; $i++){
   ?>
      <input type = "radio" name = "tips" id= "<?php echo $i;?>" value="<?php echo ($i + 2)*5;?>"
         <?php if($_SERVER["REQUEST_METHOD"] == "POST"){ $tip = format_input($_POST["tips"]);if($tip == (($i+2)*5)) {echo "checked";}}?> > <?php echo($i+2) *5; ?>
  <?php
   }
?>
<br><input type="radio" name= "tips" id= "4" value="4" <?php if($_SERVER["REQUEST_METHOD"] == "POST"){ $tip = format_input($_POST["tips"]);if(($tip != 10) && ($tip != 15) && ($tip != 20) && ($tip != 0)) {echo "checked";}}?> > Custom:
<input type="text" id= "custom" name = "custom" style = "width: 48px;" value="<?php if($_SERVER["REQUEST_METHOD"] == "POST"){ echo format_input($_POST["custom"]); } ?>"> %

<br><br>
<input type="submit">
</form>

<div class = "fun-div">
<?php
   header('Access-Control-Allow-Origin: *');
   $bill = "";
   $tip = 0;
   $total = 0;
   $tip_amount = 0;
   //$dom = new DOMDocument();
   //$dom->loadHTMLfile('127.0.0.1/php');
   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $bill = format_input($_POST["bill"]);
      $tip = format_input($_POST["tips"]);
      $custom = format_input($_POST["custom"]);
      if(!is_numeric($tip)){
         $tip = 0;
       }
      if($tip == 4){
          $tip = $custom;
      }

      //also check if a radio button is clicked &&
      if(is_numeric($bill) && $bill > 0 && $tip > 0 && is_numeric($tip)){
         $tip_amount = ($bill * $tip)/ 100;
         $total = $bill + $tip_amount;
         echo "<br>";
         echo "Bill: $" . $bill;
         echo "<br><br>";
         echo "Tip Amount: $" . $tip_amount;
         echo "<br><br>";
         echo "Total Bill: $" . $total;
         echo "<br><br>";
      } else if(!is_numeric($bill) || $bill < 0){
          //change input text color to red
          echo '<script type="text/javascript">',
          'document.getElementById("bill").style.border= "2px solid red";',
          '</script>';
      } else if(!is_numeric($tip) || $tip < 0){
             //other input text
            echo '<script type="text/javascript">',
            'document.getElementById("custom").style.border= "2px solid red";',
            '</script>';
       }else if($tip == 0){
             echo '<script type="text/javascript">',
             'document.getElementById("vis").style.border= "2px solid red";',
              '</script>';
       }
   }

   function format_input($input){
      $input = trim($input);
      $input = stripslashes($input);
      $input = htmlspecialchars($input);
      return $input;
   }
?>
</div>
<br><br>
</div>
</body>
</html>
