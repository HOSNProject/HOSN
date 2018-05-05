#!/bin/bash
RED="\033[31m"
RE="\033[0m"
GREEN="\033[32m"
clear
echo -e "[${RED}1${RE}] Intrusion Detection System (IDS)"
echo -e "[${RED}2${RE}] Intrusion Prevention System (IPS)"

read -p "Run on which mode : " choose
if [[ $choose = 1 ]]
then
  cp IDSorIPS/IDS/* html/inc/
  rm html/inc/snortConfig.php 2> /dev/null
  echo -e "${GREEN}Snort is Runing as IDS${RE}";
elif [[ $choose = 2 ]]
then
  echo -e -n "Enter two interfaces ${GREEN}(${RE}interface1:interface2${GREEN})${RE} : "
  read interfaces
  echo '<?php $interface = "'$interfaces'";?>' > IDSorIPS/IPS/snortConfig.php
  cp IDSorIPS/IPS/* html/inc/
  echo -e "${GREEN}Snort is Runing as IPS${RE}";
else
  echo -e "${RED}WRONG OPTION !${RE}"
fi
