`snort -T -c /etc/snort/snort.conf -l /var/www/snort/snortLogs --daq pcap -A fast 2> /var/www/snort/scripts/isError `
results=`cat /var/www/snort/scripts/isError | grep "ERROR:"`
if [ ${#results} -eq 0 ]
then
	echo "1"
else
	echo `java -cp /var/www/snort/scripts/ getErrorMessage`
fi
