#!bin/bash
apt-get install apache2 mysql-server php libapache2-mod-php php-mcrypt php-mysql snort openjdk-9-jdk -y &&
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
mysql -u root -p -e "create database IDS_IPS;use IDS_IPS;create table admins(username varchar(50), password varchar(128));CREATE USER 'IDS_IPS'@'localhost' IDENTIFIED BY 'IDSIPSADMIN';GRANT ALL PRIVILEGES ON *.* TO 'IDS_IPS'@'localhost' WITH GRANT OPTION;" &&
mysql -u root -p -e "use IDS_IPS;insert into admins value('admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');" &&
service apache2 restart &&
service mysql restart &&
chown -R www-data /var/www/ &&
chown -R snort /var/www/snort/snortLogs &&
chmod +r /var/www/snort/rules/userAddedRules &&
chmod +r /var/www/snort/rules/notValidatedRules
