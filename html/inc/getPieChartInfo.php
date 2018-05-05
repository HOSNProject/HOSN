<?php
  session_start();
  if(isset($_SESSION['correctInfo']) && $_SESSION['correctInfo'] == true)
  {
    $conn = new mysqli("localhost","IDS_IPS", "IDSIPSADMIN", "IDS_IPS");
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    $sql = "SELECT priority FROM logs";
    $result = $conn->query($sql);
    $data->datasets[0]=array('data'=>[0,0,0],'backgroundColor'=>["rgb(255, 99, 132)","rgb(255, 205, 86)","rgb(54, 162, 235)"]);
    $data->labels = array("Critical","Warning","Logs");
    if ($result->num_rows > 0)
    {
        // output data of each row
        while($row = $result->fetch_assoc())
        {
          if((int)$row['priority'] < 5)
          {
            $data->datasets[0]['data'][0]++;
          }
          else if((int)$row['priority'] < 10)
          {
            $data->datasets[0]['data'][1]++;
          }
          else
          {
            $data->datasets[0]['data'][2]++;
          }
        }
    }
    echo json_encode($data);
  }
  else
  {
    header("Location: ../Home");
  }
 ?>
