<?php
include "../inc/header.php";
if(!isset($_SESSION['correctInfo']) || $_SESSION['correctInfo'] == false)
  {
    include "../inc/unauthenticated.php";
    exit();
  }

echo
'
<script type="text/javascript">
var elem = document.getElementById("AnalyticsMenu");
elem.className +=" active";
</script>
';
?>
<div class="container-fluid">
  <div class="row" style="padding-top:2%">
    <div class="col-4">
      <div class="card">
        <canvas id="myChart1" width="100%" height="60%"></canvas>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <canvas id="myChart" width="100%" height="60%"></canvas>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <canvas id="myChart2" width="100%" height="60%"></canvas>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="../inc/js/analyticsPageCode.js"></script>
</body>
</html>
