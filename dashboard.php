
<?php



  include 'conn.php';

  if(!isset($_SESSION['id'])){
    header('location:index.php');
  }

  if($_SESSION['designation']=="admin"){
    header('location:admin_dashboard.php');
  }

  $email = $_SESSION['id'];

  // $table1 = "bot_data_collection";



 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" href="images/favicon.ico">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="styles.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     <script src="https://kit.fontawesome.com/32a2cfb574.js" crossorigin="anonymous"></script>
  <title>Document</title>
</head>
<body>
<div style="height: 1rem;"></div>
  <div style="margin top: 100px;">
  <center><h1>DashBoard for Officers</h1></center>
</div>
<div style="height: 2rem;"></div>
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4 cols">Officer ID : <?php echo $email; ?></div>
    <div class="col-sm-6 col-md-4 cols">Officer Designation : <?php echo $_SESSION['designation']; ?></div>
    <div class="col-sm-6 col-md-4 cols">Alloted Pin Code : <?php echo $_SESSION['pincode']; ?></div>
  </div>
</div>

  <br>
  <br>

  <table class="table table-striped table-bordered table-hover">
              <tr class="bg-dark text-light text-center">
              <th>S No</th>  
              <th>Type of Incident</th>
                <th>Description</th>
                <th>Image</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Pincode</th>
                <th>Is resolved</th>
        
              </tr>

              <?php

              $pincode = $_SESSION['pincode'];


              $q = "SELECT * from bot_data_collection where pincode=$pincode and is_resolved='no'";
              $query = mysqli_query($con,$q);

                $sno = 1;

                
  
                while($res = mysqli_fetch_array($query)){

               ?>

              <tr class="text-center" style="">
                <td><?php echo $sno++; ?></td>
                <td><?php echo $res['type_of_incident']; ?></td>
                <td><?php echo $res['description']; ?></td>
                
                <td><a href="<?php echo $res['photo_url']; ?>" >Download Image</a> </td>
                <td><?php echo $res['latitude']; ?></td>
                <td><?php echo $res['longitude']; ?></td>
                <td><?php echo $res['pincode']; ?></td>
                <td><?php echo $res['is_resolved']; ?></td>
                
              </tr>
              <?php
              
                 }
                 
               ?>
            </table>

            <div class="row">
    
    
    <div class="col-sm-12 col-md-12 center"><center><button id="logout_btn" class="btn btn-danger text-center" onclick="document.location='logout.php'">logout of the dashboard</button></center></div>

  </div>
</div>
</body>
</html>