<?php
include 'config.php';
session_start();
if(!isset($_SESSION['correctInfo']) || $_SESSION['correctInfo'] == false)
{
  header('Location: ../Home');
}
else
{
  $rule = "";
  $options = "";
  $flags = "flags:";
  $flagsSet=false;
  $fragBits = "fragbits:";
  $fragBitsSet=false;
  if(isset($_POST['ruleAction']) && isset($_POST['TCP_UDP']) && isset($_POST['msgValue']) && isset($_POST['srcIP']) && isset($_POST['srcPort']) && isset($_POST['desIP']) && isset($_POST['desPort']))
  {
    $rule = $_POST['ruleAction']." ".$_POST['TCP_UDP']." ".$_POST['srcIP']." ".$_POST['srcPort']." -> ".$_POST['desIP']." ".$_POST['desPort']." (msg:".$_POST['msgValue'].";sid:".time().";";

    if(isset($_POST['classificationValue']))
    {
      $options = $options."classtype:".$_POST['classificationValue'].";";
    }
    if(isset($_POST['priorityField']))
    {
      $options=$options."priority:".$_POST['priorityField'].";";
    }
    if(isset($_POST['SYN']))
    {
      $flagsSet=true;
      $flags=$flags."S";
    }
    if(isset($_POST['ACK']))
    {
      $flagsSet=true;
      $flags=$flags."A";
    }
    if(isset($_POST['FIN']))
    {
      $flagsSet=true;
      $flags=$flags."F";
    }
    if(isset($_POST['URG']))
    {
      $flagsSet=true;
      $flags=$flags."U";
    }
    if(isset($_POST['PSH']))
    {
      $flagsSet=true;
      $flags=$flags."P";
    }
    if(isset($_POST['RST']))
    {
      $flagsSet=true;
      $flags=$flags."R";
    }
    if(isset($_POST['flagsModifiers']))
    {
      $flagsSet=true;
      if($flags == 'flags:')
      {
        if($_POST['flagsModifiers'] == "0")
        {
          $flags = $flags."0";
        }
        else
        {
          $flags = $flags.'0'.$_POST['flagsModifiers'];
        }
      }
      else if($_POST['flagsModifiers'] == '0'){}
      else
        $flags=$flags.$_POST['flagsModifiers'];
    }
    if(isset($_POST['seqField']))
    {
      $options=$options."seq:".$_POST['seqField'].";";
    }
    if(isset($_POST['itypeField']))
    {
      $options=$options."itype:".$_POST['itypeField'].";";
    }
    if(isset($_POST['icodeField']))
    {
      $options=$options."icode:".$_POST['icodeField'].";";
    }
    if(isset($_POST['ackField']))
    {
      $options=$options."ack:".$_POST['ackField'].";";
    }
    if(isset($_POST['fragbitsValue1']))
    {
      $fragBitsSet=true;
      $fragBits=$fragBits.$_POST['fragbitsValue1'];
    }
    if(isset($_POST['fragbitsValue2']))
    {
      $fragBits=$fragBits.$_POST['fragbitsValue2'];
    }
    if(isset($_POST['flowValue']))
    {
      $options=$options."flow:".$_POST['flowValue'].";";
    }
    if(isset($_POST['contentField']))
    {
      $options=$options."content:".$_POST['contentField'].";nocase;";
    }
    if(isset($_POST['ipoptsValue']))
    {
      $options=$options."ipopts:".$_POST['ipoptsValue'].";";
    }
    if(isset($_POST['idField']))
    {
      $options=$options."id:".$_POST['idField'].";";
    }
    if($flagsSet)
      $options = $options.$flags.";";
    if($fragBitsSet)
      $options = $options.$fragBits.";";
    $rule = $rule.$options.")";

    //ADD NULL FLAGS
  }
  else
  {
    echo 'No';
    return;
  }
  exec('echo "'.$rule.''.'" > '.$snortUserAddedRulesDir.'notValidatedRules');
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
    echo "No";
  }
}
/*
*/
?>
