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
    if ($con->query("delete from useraccounts where id = '$_GET[id]'"))
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
<?php 
  $array = $con->query("select * from useraccounts,branch where useraccounts.id = '$_GET[id]' AND useraccounts.branch = branch.branchId");
  $row = $array->fetch_assoc();
 ?>
<div class="container-fluid">
<div class="background text-white text-center">
    Account profile for <?php echo $row['name'];echo "<kbd>#";echo $row['accountNo'];echo "</kbd>"; ?>
  
  
    <table class="table table-bordered text-red">
      <tbody>
        <tr>
          <td>Name</td>
          <th><?php echo $row['name'] ?></th>
          <td>Account No</td>
          <th><?php echo $row['accountNo'] ?></th>
        </tr><tr>
          <td>Branch Name</td>
          <th><?php echo $row['branchName'] ?></th>
          <td>Branch Code</td>
          <th><?php echo $row['branchNo'] ?></th>
        </tr><tr>
          <td>Current Balance</td>
          <th><?php echo $row['balance'] ?></th>
          <td>Account Type</td>
          <th><?php echo $row['accountType'] ?></th>
        </tr><tr>
          <td>Cnic</td>
          <th><?php echo $row['cnic'] ?></th>
          <td>City</td>
          <th><?php echo $row['city'] ?></th>
        </tr><tr>
          <td>Contact Number</td>
          <th><?php echo $row['number'] ?></th>
          <td>Address</td>
          <th><?php echo $row['address'] ?></th>
        </tr>
        </tr><tr>
          <td>Pan card Number</td>
          <th><?php echo $row['panNo'] ?></th>
          <td>Nationality</td>
          <th><?php echo $row['nationName'] ?></th>
          
        </tr>
      </tbody>
    </table>
</div>
</div>

</body>
</html>