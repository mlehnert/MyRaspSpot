#!/bin/sh
# Utils for my RaspSpot
# Testbranch

connectssid=`iwgetid $2|cut -d: -f 2|sed "s/\"//g"`
myssid=`cat /etc/hostapd/hostapd.conf|grep ssid=|head -1|cut -d= -f 2`
dumptxt=/var/www/dump.txt
wpaconf=/etc/wpa.conf.test

case $1 in
	status)
		echo "<b>Status $2:</b><br>SSID="
		iwgetid $2|cut -d: -f2
		echo "<br>"
		ifconfig $2|grep "inet addr"
		echo "<br>default gateway:"
		route -n|head -3|tail -1|awk '{print $2}'
		echo "<br>"
		iwlist $2 rate|grep "Bit Rate"
		echo "<br>"
		ifconfig $2 |grep "RX bytes"
		;;
	clients)
		echo "<b>Connected Clients at $2</b></br>"
		#clients=`cat /proc/net/arp|grep $2|wc -l`
		#echo "$clients"
		for i in `cat /proc/net/arp|grep $2|awk '{print $1}' `;do
			clientname=`busybox dumpleases|grep $i|awk '{print $3}'`
			echo "$clientname ($i)<br>"
		done
		;;
	scanwlan)
	for i in `iwlist $2 scan|grep -B1 ESSID:|cut -d":" -f 2|sed "s/ /§/g"|sed "s/\"//g"`;do
	if [ "$i" != "--" ]; then
		if [ "$i" = "off" ]; then
			secure=open
		else
			if [ "$i" = "on" ]; then
				secure=encrypted
			else
				if [ "$i" != "$myssid" ]; then
                    wlan=`echo "$i ($secure)"|sed "s/§/ /g"`
                    echo "<li  class=\"radiobutton\">"
                    echo "<span class=\"name\">$wlan</span>"
                    if [ "$i" = "$connectssid" ]; then
                        echo "<input name=\"wlan\" type=\"radio\" value=\"$wlan\" checked></li>"
                    else
                        echo "<input name=\"wlan\" type=\"radio\" value=\"$wlan\"></li>"
                    fi
				fi
			fi
		fi
	fi
	done
	;;
	wanwkey)
	if [ "$2" = "get" ]; then
		cat $wpaconf|grep psk=|cut -d= -f 2|sed "s/\"//g"
	fi
	;;
	setwanwlan)
	wanwlan=`echo $2|cut -d"(" -f 1|sed "s/.$//"`
	encrypted=`echo $2|cut -d"(" -f 2|cut -d")" -f 1`
	echo "network={\n ssid=\"$wanwlan\"" > $wpaconf
	if [ "$encrypted" = "encrypted" ] ; then
		echo -n " psk=$3\n" >> $wpaconf
	fi
	echo " }" >> $wpaconf
	echo -n "alert(\\\"SSID=$wanwlan\\\");"
#	echo -n "<a href=\"index.php\" onClick=\"return confirm('Set $wanwlan');\">los</a>\n"
	;;
	*)
		echo "PIUTILS -Params"
		echo "status <Adapter>, shows some informations of Adapter"
		echo "clients <Adapter>, shows actually connected clients at Adapter."
		echo "scanwlan <Adapter>, scan for available WLAN's at Adapter"
		echo "wanwkey <get>, get set the WAN side WLAN key"
		echo "setwanwlan <WLAN> <encrypted/open> <KEY>, set and connect to this WLAN" 
		;;
esac
exit 0
