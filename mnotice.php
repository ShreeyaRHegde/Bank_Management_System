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
        <a class="nav-link active" href="mindex.php">Customer Accounts <span class="sr-only">(current)</span></a>
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
  $array = $con->query("select * from useraccounts where id = '$_GET[id]'");
  $row = $array->fetch_assoc();


 ?>
<div class="container-fluid">
<div class="card w-100 text-center shadowWhite">
  
  <div class="background text-white">
    <form method="POST">
          <div class="background">
            <h5>Send notice for <?php echo $row['name'] ?></h5>
            <input type="hidden" name="userId" value="<?php echo $row['id'] ?>">
            <textarea class="form-control" name="notice" required placeholder="Write your message"></textarea>
            <button type="submit" name="send" class="btn btn-danger btn-block btn-sm my-1">Send</button>
          </div>
      </form><?php
    if (isset($_POST['send']))
    {
      if ($con->query("insert into notice (notice,userId) values ('$_POST[notice]','$_POST[userId]')")) {
        echo "<div class='alert alert-success'>Successfully sent</div>";
      }else
      echo "<div class='alert alert-danger'>Not sent Error is:".$con->error."</div>";
    }
    
    ?>  
  </div>
  
</div>

</body>
</html>