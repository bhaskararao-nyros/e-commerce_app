<?php 
session_start();
include("connection.php"); ?>
<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

if(isset($_SESSION['user']) && $_SESSION['user'] == 1)
{
  include("header.php");
?>
   <ul class="breadcrumb">
    <li><a href="home.php">Home</a></li>
    <li>Festval offers</li>
  </ul>
  <h2 class="text-center">Festival Dhamaka Sale</h2>
   <div class="row" id="productImages">
      

  </div>
  <div id="message" class="text-center">
        <!-- message on roll data -->

  </div><br><br><br>
</div> <!-- container ending -->
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript' src='./assets/js/auto_scroll_offers.js'></script>
<script src="./assets/js/jquery.rateyo.js"></script>

<?php }else{ 
header('location:login.php');
} ?>
