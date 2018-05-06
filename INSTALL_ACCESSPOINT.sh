RED="\033[31m"
RE="\033[0m"
GREEN="\033[32m"
echo -e "${GREEN}Installing packages...${RE}"
apt-get install hostapd > /dev/null &&
SSID=''
AP_PASS=''
while [[ ${#SSID} -lt 1 ]]
do
  echo -n -e "[${GREEN}-${RE}] Please Enter the SSID for the WiFi${GREEN}(${RE}SSID ${GREEN}>${RE} 0${GREEN})${RE}: "
  read SSID
done
while [[ ${#AP_PASS} -lt 8 ]]
do
  echo -n -e "[${GREEN}-${RE}] Please Enter the password for the WiFi${GREEN}(${RE}Password ${GREEN}>${RE}7${GREEN})${RE}: "
  read -s AP_PASS
  echo ""
done
echo -e "[${GREEN}-${RE}] Writing password to configuration file..."
echo -n -e "interface=wlan0\ndriver=nl80211\nssid=$SSID\nhw_mode=g\nchannel=6\nmacaddr_acl=0\nauth_algs=1\nignore_broadcast_ssid=0\nwpa=2\nwpa_passphrase=$AP_PASS\nwpa_key_mgmt=WPA-PSK\n#wpa_pairwise=TKIP\nrsn_pairwise=CCMP\nieee80211n=1          # 802.11n support\nwmm_enabled=1         # QoS support\nht_capab=[HT40][SHORT-GI-20][DSSS_CCK-40]" > config/wifiConfigurations.conf
echo -e "${GREEN}Success !${RE}"
cp config/hostapd /etc/default/ 
