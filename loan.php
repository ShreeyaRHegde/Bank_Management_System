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
      <li class="nav-item ">  <a class="nav-link" href="statements.php">Account Statements</a></li>
      <li class="nav-item ">  <a class="nav-link" href="transfer.php">Transaction</a></li>
      <li class="nav-item active">  <a class="nav-link" href="loan.php">Loan</a></li>
      <!-- <li class="nav-item ">  <a class="nav-link" href="profile.php">Profile</a></li> -->


    </ul>
    <?php include 'sideButton.php'; ?>
    
  </div>
</nav><br><br><br>
<?php
if (isset($_POST['submitApplication']))
{
  if (!$con->query("insert into loan (loanid,loantype,amt,duration,c_id) values ('$_POST[loanid]','$_POST[loantype]','$_POST[amt]','$_POST[duration]','$_POST[c_id]')")) {
    echo "<div claass='alert alert-success'>Failed. Error is:".$con->error."</div>";
  }
  else
    echo "<div class='alert alert-info text-center'>Applied Successfully</div>";

}
if (isset($_GET['del']) && !empty($_GET['del']))
{
  $con->query("delete from login where id ='$_GET[del]'");
}
  
  
 ?>
<div class="container-fluid">
<div class="background text-white text-center">
   Loan Application Form
  </div>
  <div class="background text-white text-center">
    <table class="table">
      <tbody>
        <tr>
          <form method="POST">
          <th>Loan ID</th>
          <td><input type="text" name="loanid" readonly value="<?php echo time() ?>" class="form-control input-sm" required></td>
          <th>Loan Type and Intereset</th>
          <td>
            <select class="form-control input-sm" name="loantype" required>
              <option value="Education Loan-4%" selected>Education Loan-4%</option>
              <option value="Vehicle Loan-6%" selected>Vehicle Loan-6%</option>
              <option value="Home Loan-5%" selected>Home Loan-5%</option>
              <option value="Gold Loan-7%" selected>Gold Loan-7%</option>
              <option value="Business Loan-8%" selected>Business Loan-8%</option>
            </select>
          </td>
        </tr>
        <tr>
        <th>Account Number</th>
          <td><input type="" name="c_id" readonly value="<?php echo $userData['accountNo']; ?>" class="form-control input-sm" required></td>
          <th>Amount</th>
          <td><input type="number" name="amt" class="form-control input-sm" required></td>
        </tr>
        <tr>
        
          <th>Duration</th>
          <td><input type="text" name="duration" class="form-control input-sm" required></td>
        </tr>
        
        
          <td colspan="4">
            <button type="submit" name="submitApplication" class="btn btn-primary btn-sm ">Submit Application</button>
            <button type="Reset" class="btn btn-secondary btn-sm">Reset</button></form>
          </td>
        </tr>
      </tbody>
    </table>
    

  </div>
 
</div>


<!-- Modal -->

      
      
    
    

</body>
</html>