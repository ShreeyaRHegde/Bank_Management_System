<?php
session_start();
if(!isset($_SESSION['managerId'])){ header('location:login.php');}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Banking</title>
  <?php require 'assets/autoloader.php'; ?>
  <?php require 'assets/db.php'; ?>
  <?php require 'assets/function.php'; ?>
  <?php if (isset($_GET['delete'])) 
  {
    if ($con->query("delete from useraccounts where id = '$_GET[delete]'"))
    {
      header("location:mindex.php");
    }
  } ?>
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
        <a class="nav-link active" href="mindex.php">Customer Accounts<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="maccounts.php">Employee Accounts</a></li>
      <li class="nav-item ">  <a class="nav-link" href="maddnew.php">Add New Account</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mfeedback.php">Feedback</a></li>
      <li class="nav-item ">  <a class="nav-link" href="mloan.php">Loans</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="transfer.php">Funds Transfer</a></li> -->
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'msideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<div class="container-fluid">
<div class="card w-500 text-center shadowBlack">
  
   
  
  <div class="background text-white">
   <table class="table table-bordered table-sm text-white">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Holder Name</th>
      <th scope="col">Account No.</th>
      <th scope="col">Branch Name</th>
      <th scope="col">Current Balance</th>
      <th scope="col">Account type</th>
      <th scope="col">Contact</th>
      <th scope="col">PanNo</th>
      <th scope="col">Nationality</th>
      
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
</div>
    <?php
      $i=0;
      $array = $con->query("select * from useraccounts,branch where useraccounts.branch = branch.branchId");
      if ($array->num_rows > 0)
      {
        while ($row = $array->fetch_assoc())
        {$i++;
    ?>
      <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['accountNo'] ?></td>
        <td><?php echo $row['branchName'] ?></td>
        <td>Rs.<?php echo $row['balance'] ?></td>
        <td><?php echo $row['accountType'] ?></td>
        <td><?php echo $row['number'] ?></td>
        <td><?php echo $row['panNo'] ?></td>
        <td><?php echo $row['nationName'] ?></td>
        
        <td>
          <a href="show.php?id=<?php echo $row['id'] ?>" class='btn btn-info btn-sm' data-toggle='tooltip' title="View More info">View Profile</a>
          <a href="mnotice.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="Send notice to this">Send Notice</a>
          <a href="mindex.php?delete=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Delete this account">Delete</a>
        </td>
        
      </tr>
     
    <?php
        }
      }
     ?>
  </tbody>
</table>
<a href="gpdf.php" class="btn btn-primary float-right">Download Transaction details</a> 
<a href="gpdf1.php" class="btn btn-success float-right">Download Accounts details</a>


</body>
</html>