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
        <a class="nav-link " href="mindex.php">Customer Accounts <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">  <a class="nav-link" href="maccounts.php">Employee Accounts</a></li>
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
if (isset($_POST['saveAccount']))
{
  if (!$con->query("insert into employee (email,password,name,salary,number) values ('$_POST[email]','$_POST[password]','$_POST[name]','$_POST[salary]','$_POST[number]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from employee where empid ='$_GET[del]'");
}
  $array = $con->query("select * from employee");
  
 ?>
 
<div class="container-fluid">
<div class="card w-100 text-center shadowBlack">
  
  <div class="background text-white">
     All Staff Accounts 
</div>

    
    <div class="background text-white">
    <table class="table  table-bordered">
      <thead>
        <tr>
          <th>Email</th>
          <th>Name</th>
          <th>Empid</th>
          <th>Phone Number</th>
          <th>Salary</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if ($array->num_rows > 0)
          {
            while ($row = $array->fetch_assoc())
            {
              echo "<tr>";
              echo "<td>".$row['email']."</td>";
              echo "<td>".$row['name']."</td>";
              echo "<td>".$row['empid']."</td>";
              echo "<td>".$row['number']."</td>";
              echo "<td>".$row['salary']."</td>";
              echo "<td><a href='maccounts.php?del=$row[empid]' class='btn btn-danger btn-sm'>Delete</a></td>";
              echo "</tr>";
            }
          }
         ?>
      </tbody>
    </table>
    <button class="btn btn-success btn-sm " data-toggle="modal" data-target="#exampleModal">Add New Account</button>
  </div>
        
  
    
   
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Employee Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST">
          <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input class="form-control" type="email" name="email" id="email" required placeholder="Email">
          </div>
          <div for="password" class="form-group">
            <label  class="control-label">Password</label>
            <input class="form-control" type="password" name="password" id="password" required placeholder="Password">
          </div>
          <div class="form-group">
            <label  class="control-label">Name</label>
            <input class="form-control" type="text" name="name"  required placeholder="">
          </div>
          <div class="form-group">
            <label  class="control-label">Salary</label>
            <input class="form-control" type="number" name="salary"  required placeholder="">
          </div>
          <div class="form-group">
            <label  class="control-label">Phone Number</label>
            <input class="form-control" type="number" name="number"  required placeholder="">
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="saveAccount" class="btn btn-primary">Save Account</button>
      </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>