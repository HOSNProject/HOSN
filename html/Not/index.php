<?php
  include "../inc/header.php";
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
           <div class="col" style="padding-left:0px;padding-right:0px;">
            <form method="post" action="../inc/clearNotifications.php" style="margin-bottom:0px">
                <button class="btn btn-info btn-block" type="submit" name="button" style="border-radius: 0;">Clear Notifications</button>
            </form>
           </div>
       </div>
       <div class="row">
         <div class="col" style="padding:0px">
           <table class="table table-dark text-center" style="margin-bottom:0px; width:100%;" id="NotificationsTable">
             <thead>
               <tr>
                 <th scope="col">Time Stamp</th>
                 <th scope="col">SID</th>
                 <th scope="col">Message</th>
                 <th scope="col">Classification</th>
                 <th scope="col">Priority</th>
                 <th scope="col">TCP/UDP</th>
                 <th scope="col">SrcIP : SrcPort</th>
                 <th scope="col">DesIP : DesPort</th>
               </tr>
             </thead>
            <tbody id="notTableContent">
            <?php
              system('cd '.$customScriptsDir.';java -cp .:mysql.jar snortLogReformater');
              $conn = new mysqli("localhost","IDS_IPS", "IDSIPSADMIN", "IDS_IPS");
              if ($conn->connect_errno) {
                  echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
              }
              $sql = "SELECT * FROM logs";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc())
                  {
                    if((int)$row['priority'] > 3)
                    {
                      echo "
                      <tr class='bg-dark'>
                        <td>".$row['timestamp']."</td>
                        <td>".$row['sid']."</td>
                        <td>".$row['message']."</td>
                        <td>".$row['classification']."</td>
                        <td>".$row['priority']."</td>
                        <td>".$row['tcp/udp']."</td>
                        <td>".$row['srcip/srcport']."</td>
                        <td>".$row['desip/desport']."</td>
                      </tr>
                      ";
                    }
                    else
                    {
                      echo "
                      <tr class='bg-danger'>
                        <td>".$row['timestamp']."</td>
                        <td>".$row['sid']."</td>
                        <td>".$row['message']."</td>
                        <td>".$row['classification']."</td>
                        <td>".$row['priority']."</td>
                        <td>".$row['tcp/udp']."</td>
                        <td>".$row['srcip/srcport']."</td>
                        <td>".$row['desip/desport']."</td>
                      </tr>
                      ";
                    }
                  }
              }
             ?>
          </tbody>
          </table>
         </div>
       </div>
     </div>

     <script type="text/javascript">
       $('#NotificationsTable').DataTable(
         {
           "searching": false,
           "lengthChange": false,
           "info":false,
           "paging":false,
         }
       );
     </script>
    </body>


</html>
