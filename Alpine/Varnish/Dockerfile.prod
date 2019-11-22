FROM lavoweb/varnish

CMD varnishd -f /etc/varnish/default.vcl -s malloc,100M -a 0.0.0.0:${VARNISH_PORT} && tail -f /dev/null