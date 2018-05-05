<?php
  include "../inc/header.php";
  echo
  '
  <script type="text/javascript">
  var elem = document.getElementById("MyRulesMenu");
  elem.className +=" active";
  </script>
  ';
  if($_SESSION['correctInfo'] == false)
  {
    include "../inc/unauthenticated.php";
    exit();
  }
 ?>
    <script type="text/javascript">
      $('body').addClass('bg-dark');
    </script>
    <div class="container-fluid">
      <div class="row">
        <div class="col" style="padding-left:0px; padding-right:0px">
          <button type="button" class="btn btn-warning btn-block" onclick="editRules()" id="myRulesBtn" style="border-radius:0px">Edit Rules</button>
          <table class="table table-dark table-striped text-center" style="margin-bottom:0px; width:100%;" id="NotificationsTable">
            <thead id="userAddedRules_header">
              <tr>
                <th>Action</th>
                <th>Protocol</th>
                <th>Source IP</th>
                <th>Source Port</th>
                <th>Destination IP</th>
                <th>Destination Port</th>
                <th>Options</th>
              </tr>
            </thead>
           <tbody id="userAddedRules">
             <?php
               system('java -cp '.$customScriptsDir.' snortRulesFormatter');
               system('cat '.$snortUserAddedRulesDir.'formattedUserAddedRules');
              ?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
   </body>
 </html>
