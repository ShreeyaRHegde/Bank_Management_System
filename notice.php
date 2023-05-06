<?php
session_start();
if(!isset($_SESSION['userId'])){ header('location:login.php');}
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
    <img src="images/logo.png" style="object-fit:cover;object-position:center center" width="30" height="30" class="d-inline-block align-top" alt="">
   <!--  <i class="d-inline-block  fa fa-building fa-fw"></i> --><?php echo bankname; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active ">  <a class="nav-link" href="accounts.php">Accounts</a></li>
      <li class="nav-item ">  <a class="nav-link" href="statements.php">Account Statements</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transactions</a></li>
      <li class="nav-item ">  <a class="nav-link" href="loan.php">Loan</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'sideButton.php'; ?>
   
  </div>
</nav><br><br><br>
<div class="container-fluid">
  
  <div class="background text-white text-center">
    Notification from Bank
  
  <div class="card-body">
    <?php 
      $array = $con->query("select * from notice where userId = '$_SESSION[userId]' order by date desc");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {
          echo "<div class='background text-white'>$row[notice]</div>";
        }
      }
      else
        echo "<div class='alert alert-info'>Notice box empty</div>";
     ?>
  </div>
  
</div>

</div>
</body>
</html>