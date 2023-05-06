
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
  <?php
    $error = "";
    if (isset($_POST['userLogin']))
    {
      $error = "";
        $user = $_POST['email'];
        $pass = $_POST['password'];
       
        $result = $con->query("select * from userAccounts where email='$user' AND password='$pass'");
        if($result->num_rows>0)
        { 
          session_start();
          $data = $result->fetch_assoc();
          $_SESSION['userId']=$data['id'];
          $_SESSION['user'] = $data;
          header('location:index.php');
         }
        else
        {
          $error = "<div class='alert alert-warning text-center rounded-0'>Username or password wrong try again!</div>";
        }
    }

   ?>
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
        <a class="nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">  <a class="nav-link" href="accounts.php">Accounts</a></li>
      <li class="nav-item active">  <a class="nav-link" href="statements.php">Account Statements</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transaction</a></li>
      <li class="nav-item ">  <a class="nav-link" href="loan.php">Loan</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'sideButton.php'; ?>
  </div>
</nav><br><br><br>
<div class="container-fluid">
  
  <div class="background text-white text-center">
    Transaction made against you account
  </div>
  <div class="background text-white text-center">
  
    
    <?php 
      $array = $con->query("select * from transaction where userId = '$userData[id]' order by date desc");
      if ($array ->num_rows > 0) 
      {
         while ($row = $array->fetch_assoc()) 
         {
            if ($row['action'] == 'withdraw') 
            {
              echo "<div class='background text-white text-center'>You withdraw Rs.$row[debit] from your account at $row[date]</div>";
            }
            if ($row['action'] == 'deposit') 
            {
              echo "<div class='background text-white text-center'>You deposit Rs.$row[credit] in your account at $row[date]</div>";
            }
            if ($row['action'] == 'deduction') 
            {
              echo "<div class='background text-white text-center'>Deduction have been made for  Rs.$row[debit] from your account at $row[date] in case of $row[other]</div>";
            }
            if ($row['action'] == 'transfer') 
            {
             
              echo "<div class='background text-white text-center'>Transfer have been made for  Rs.$row[debit] from your account at $row[date] in  account no.$row[other]</div>";
            }

         }
      } else{
        echo "<div class='text-center'><small class='text-muted'><i>No Transcaction has been made yet.</i></small></div>";
      }
    ?>  
  </div>
  </div>
    </div>



</body>
</html>