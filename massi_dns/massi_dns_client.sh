#!/bin/zsh

PATH=/usr/local/sbin:/usr/local/bin:/usr/bin
URL=

ip=$(curl http://$URL/myip.php)
last_ip=$(<last_update)

if [[ "$ip" != "$last_ip" ]]; then
	if [[ "$(curl -X POST --data-ascii "pc=$HOST" --data-ascii "otp=$(head -n 1 ./otps)" http://$URL/index.php)" -eq "ACK" ]]; then
		sed -e 1d -i ./otps
		echo $ip > ./last_update
	fi
fi
