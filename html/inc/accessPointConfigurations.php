<?php
  //var_dump(http_response_code(204));
  include 'config.php';
  session_start();
  if(!isset($_SESSION['correctInfo']) || isset($_SESSION['correctInfo']) == false)
  {
    header('Location: ../Home');
  }
  else
  {
    if(isset($_POST['ssid']) && isset($_POST['password']) && $_POST['ssid'] != "" && $_POST['password'] != "")
    {
      $WIFIConfigurations ='interface=wlan0\ndriver=nl80211\nssid='. $_POST['ssid']. '\nhw_mode=g\nchannel=6\nmacaddr_acl=0\nauth_algs=1\nignore_broadcast_ssid=0\nwpa=2\nwpa_passphrase='. $_POST['password']. '\nwpa_key_mgmt=WPA-PSK\n#wpa_pairwise=TKIP\nrsn_pairwise=CCMP\nieee80211n=1          # 802.11n support\nwmm_enabled=1         # QoS support\nht_capab=[HT40][SHORT-GI-20][DSSS_CCK-40]';
      exec('echo \''.$WIFIConfigurations.'\' > '.$accessPointConfig.'wifiConfigurations.conf');
      echo "Yes";
    }
    else
    {
      echo "No";
    }
  }
 ?>
