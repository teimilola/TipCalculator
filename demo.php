<?php

header('Access-Control-Allow-Origin: *');
$url = "10.175.114.173";
$con = mysqli_connect("localhost:3306", "root", "godiat2mi", "user_test");
//$con = mysqli_connect("localhost:3306", "root", "19Chem96", "user_test");
if (!$con)
  {
    die('Could not connect: ' . mysqli_error());
  }

if(isset($_REQUEST))
{

     //echo "yup here";
     //$data = json_decode(file_get_contents('php://input'), true);
     //var_dump($_POST);
     //$type = $data->type;
     $type = $_REQUEST['type'];
     if($type == "putopentext")
      {

               $UserId = intval($_REQUEST['UserId']);
               $QId= mysqli_real_escape_string($con, $_REQUEST['QId']);
               $Text = mysqli_real_escape_string($con, $_REQUEST['Text']);
               //Create Query
               $query= "INSERT INTO `open response` (`User Number`, `QuestionID`, `Response`) VALUES ('$UserId', '$QId', '$Text')";
               //Fire Query
               $result = mysqli_query($con, $query);
               if ( false===$result ) {
                 printf("error: %s\n", mysqli_error($con));
               }
               else {
                $output = json_encode($result);
                echo $output;
               }
                //echo "Good stuff";
       }

       if($type == "putmultichoice")
       {

               $UserId = intval($_REQUEST['UserId']);
               $QId= mysqli_real_escape_string( $con,$_REQUEST['QId']);
               $CId = mysqli_real_escape_string($con, $_REQUEST['CId']);

               //Create Query
               $query= "INSERT INTO `selectedchoices` (`User Number`, `QuestionID`, `Selection`, `EntryDateTime`) VALUES ('$UserId', '$QId', '$CId', '')";
               //Fire Query
               $result = mysqli_query($con, $query);
                //$result = mysqli_query($con, $query) or trigger_error(mysqli_error($con)." ".$query);
                if ( false===$result ) {
                  printf("error: %s\n", mysqli_error($con));
                }
                else {
                 $output = json_encode($result);
                 echo $output;
                }

                //echo "Good stuff";

       }

       if($type == "newsession")
              {
                      //Create Query
                      $query= "INSERT INTO `mobileusers` () VALUES ()";
                      //Fire Query
                      $result = mysqli_query($con, $query);
                      $last_id = mysqli_insert_id($con);
                       //$result = mysqli_query($con, $query) or trigger_error(mysqli_error($con)." ".$query);
                       if ( false===$result ) {
                         printf("error: %s\n", mysqli_error($con));
                       }
                       else {
                        $output = json_encode($last_id);
                        echo $output;
                       }

                       //echo "Good stuff";

              }
}
?>

