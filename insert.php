
<?php 
include './db.php';

//insert.php
if(isset($_POST["framework"]))
{
 $framework = '';
 foreach($_POST["framework"] as $row)
 {
  $framework .= $row . ',';
 }
  $framework = substr($framework, 0, -1);

 $result= file_get_contents("http://127.0.0.1:5000/?symptoms=$framework");

 echo $result;
//  $query = "INSERT INTO like_table(framework) VALUES('".$framework."')";
//  if(mysqli_query($connect, $query))
//  {
//   echo 'Data Inserted';
//  }
}
?>
