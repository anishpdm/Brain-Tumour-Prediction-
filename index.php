<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>

  <nav class="navbar navbar-expand-sm bg-success navbar-dark">
    <ul class="navbar-nav">

      <li class="nav-item active">
        <a class="nav-link" href="cancerpredict.php">Brain Tumour Prediction</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">LogOut</a>
      </li>

    </ul>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col col-sm-2">


      </div>

      <div class="col col-sm-8 col-12">
        <form action="" method="post" enctype="multipart/form-data">
          <table class="table">
            <tr>
              <td></td>
              <td>
                <h4> Brain Tumour Prediction using Deep Learning</h4>
              </td>
            </tr>
            <tr>
              <td>Upload MRI of your brain</td>
              <td>
                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
              </td>
            </tr>


            <tr>
              <td></td>
              <td><button class="btn btn-success" name="but" type="submit">CHECK</button></td>
            </tr>

            <br>
            <br>


            <tr>
              <td></td>
              <td>

              </td>
            </tr>




          </table>
        </form>

      </div>


      <div class="col col-sm-2">


      </div>


    </div>

  </div>

</body>

</html>



<?php
if (isset($_POST["but"])) {

  $target_dir = "uploads/";
  $target_file = $target_dir . "testimage.jpg";

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "File Uploaded Succesfully";

    $res = file_get_contents("http://127.0.0.1:5000/image");

    $obj = json_decode($res);



    $benignValue = $obj->{'no'};
    $malignantValue = $obj->{'yes'};
    $beninper = $benignValue * 100;
    $malignantper = $malignantValue * 100;

    echo "<table class='table'>";

    if ($benignValue > $malignantValue) {
      echo "<tr> <td> Prediction Result  </td>

  <td> <div class='p-3 mb-2 bg-success text-white'>NO CANCER</div>  </td>
  </tr>

  <tr>
<td> Score </td>


<td>
$beninper
</td>
</tr>
<tr>
<td>
Note
</td>

<td>

This MRI contains non-cancerous tumor


</td>





  </tr>

  ";


      // echo " <h4>Prediction Result : </h4> <div class='p-3 mb-2 bg-success text-white'>benign</div>
      // <td>Benign tumors are non-malignant/non-cancerous tumor.</td>";

      // echo "Prediction Score :".$benignValue*100 ." %";

    } else {
      echo "<tr> <td> Prediction Result  </td>

  <td> <div class='p-3 mb-2 bg-danger text-white'>Malignant</div>  </td>
  </tr>

  <tr>
<td> Score </td>


<td>
$malignantper %
</td>
</tr>
<tr>
<td>
Note
</td>



<td>

MRI maybe cancerous tumor. Please visit a DOCTOR Immediately


</td>





  </tr>

  ";

      // echo " <h4>Prediction Result : </h4> <div class='p-3 mb-2 bg-danger text-white'>malignant</div>
      // <td>Malignant tumors maybe cancerous tumor. Please visit a DOCTOR Immediately</td>";
      // echo "Prediction Score :".$malignantValue*100 ." %";

    }

    //  echo $res;
    // "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


?>
