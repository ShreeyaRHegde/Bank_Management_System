<?php
session_start();
if(!isset($_SESSION['cashId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <style>
div.background {
  background: url(images/bg.jpg) repeat;
  border: 2px ;
}
</style>
</head>
<body style="background: url(images/bg.jpg);background-size: 100%">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <a class="navbar-brand" href="#">
    <img src="images/logo1.jfif" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo bankname; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="cindex.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">  <a class="nav-link" href="caccounts.php">My Account Information</a></li>

      </ul>
    <?php include 'csideButton.php'; ?>
   <?php $array = $con->query("select * from employee where empid='$_SESSION[cashId]'"); ?>
  </div>
</nav><br><br><br>
<div class="container-fluid">
  <div class="card  w-100 mx-auto">
  <div class="background text-white text-center">
    My Information
  </div>
  <div class="background text-white">
    <table class="table text-center w-100 mx-auto">
    <div class="background text-white">
    <table class="table  table-bordered">
      <thead>
        <tr>
        <th>Empid</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Salary</th>
          
        </tr>
      </thead>
      <tbody>
        <?php 
          if ($array->num_rows > 0)
          {
            while ($row = $array->fetch_assoc())
            {
              echo "<tr>";
              echo "<td>".$row['empid']."</td>";
              echo "<td>".$row['name']."</td>";
              echo "<td>".$row['number']."</td>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".$row['salary']."</td>";
              echo "</tr>";
            }
          }
         ?>
      </tbody>
    </table>
      
  </div>
  
</div>

</div>
</body>
</html>