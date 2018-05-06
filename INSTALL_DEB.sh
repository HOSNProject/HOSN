#!/bin/bash
apt-get install apache2 mysql-server php5 libapache2-mod-php5 php5-mcrypt php5-mysql snort openjdk-8-jdk -y &&
update-rc.d apache2 defaults &&
update-rc.d apache2 enable &&
service apache2 start &&
update-rc.d mysql defaults &&
update-rc.d mysql enable &&
service mysql start &&
rm /etc/snort/snort.conf &&
cp snort.conf /etc/snort/snort.conf &&
cp community.rules /etc/snort/rules/ &&
cp custom.rules /etc/snort/rules/ &&
rm -rf /var/www/html &&
cp -r snort /var/www/ &&
cp -r html /var/www/ &&
cp -r config /var/www/ &&
clear &&
RED="\033[31m"
RE="\033[0m"
GREEN="\033[32m"
username=''
pass=''
AP_pass=''
while [ ${#username} -lt 5 ]
do
echo -n -e "[${GREEN}-${RE}] Please Enter a login username for HOSN webpage ${GREEN}(${RE}username ${GREEN}>${RE} 4${GREEN})${RE}: "
read username
done
while [ ${#pass} -lt 8 ]
do
echo -n -e "[${GREEN}-${RE}] Please Enter a login password for HOSN webpage ${GREEN}(${RE}password ${GREEN}>${RE} 7${GREEN})${RE}: "
read -s pass
done
echo ""
hashedPass=`echo -n $pass | sha512sum | awk -F" " '{print $1}'`
echo "[${GREEN}-${RE}] Please Enter MySQL Password ${GREEN}:${RE}";
mysql -u root -p -e "create database IDS_IPS;use IDS_IPS;create table admins(username varchar(50), password varchar(128));insert into admins value('$username', '$hashedPass');CREATE USER 'IDS_IPS'@'localhost' IDENTIFIED BY 'IDSIPSADMIN';GRANT ALL PRIVILEGES ON *.* TO 'IDS_IPS'@'localhost' WITH GRANT OPTION;CREATE TABLE logs (timestamp varchar(100) DEFAULT NULL,sid varchar(50) DEFAULT NULL,message varchar(200) DEFAULT NULL,classification varchar(100) DEFAULT NULL,priority varchar(15) DEFAULT NULL,tcp_udp varchar(3) DEFAULT NULL,srcip_srcport varchar(50) DEFAULT NULL,desip_desport varchar(50) DEFAULT NULL)" &&
service apache2 restart &&
service mysql restart &&
chown -R www-data /var/www/ &&
chown -R snort /var/www/snort/snortLogs &&
chmod +r /var/www/snort/rules/userAddedRules &&
chmod +r /var/www/snort/rules/notValidatedRules
