<?php
  include 'config.php';
  include 'snortConfig.php';
  session_start();
  if(!isset($_SESSION['correctInfo']) || $_SESSION['correctInfo'] == false)
  {
    header('Location: ../Home');
  }
  else
  {
    if(isset($_POST['advanceRulesField']))
    {
      exec('echo "'.$_POST['advanceRulesField'].''.'" > '.$snortUserAddedRulesDir.'notValidatedRules');
      $results = exec($customScriptsDir."validRules.sh");
      if($results == '1')
      {
        exec('cat '.$snortUserAddedRulesDir.'notValidatedRules >> '.$snortUserAddedRulesDir.'userAddedRules');
        exec('echo -n "" > '.$snortUserAddedRulesDir.'notValidatedRules');
        exec('sudo /usr/bin/killall -9 snort');
        exec('sudo /usr/sbin/snort -Q -i '.$interface.' -c /etc/snort/snort.conf -l '.$snortLogsDir.' -A fast -d -D --daq afpacket --daq-mode inline -u snort -g snort');
        echo "Yes";
      }
      else {
        exec('echo -n "" > '.$snortUserAddedRulesDir.'notValidatedRules');
        echo $results;
      }
    }
    else
    {
      echo "No";
    }
  }
 ?>
