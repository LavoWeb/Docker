# Example
_docker-compose.yml_:
````
version: "2"
services:
  magento:
    image: lavoweb/php-5.6
    expose:
     - 80
     - 443
    ports:
      - "80:80"
    volumes:
     - ./:/var/www/html
    labels:
     - "traefik.port=80"
     - "traefik.backend=magento"
     - "traefik.frontend.rule=Host:magento.lavoweb.net"
     - "traefik.acme.domains=magento.lavoweb.net"
    links:
     - mysql
    depends_on:
     - mysql
    networks:
     - internal
  mysql:
    image: mysql:5.7
    volumes:
     - ./data/mysql/:/var/lib/mysql
    environment:
     - MYSQL_DATABASE=magento
     - MYSQL_USER=magento
     - MYSQL_PASSWORD=magento
    networks:
     - internal
networks:
  internal:
    driver: bridge
````

_app/etc/local.xml_:
````
<?xml version="1.0"?>
<config>
    <global>
        <install>
            <date><![CDATA[Thu, 18 Feb 2016 11:02:42 +0000]]></date>
        </install>
        <crypt>
            <key><![CDATA[20190b34c71ae046ed6b46c2ad3e320b]]></key>
        </crypt>
        <disable_local_modules>false</disable_local_modules>
        <resources>
            <db>
                <table_prefix><![CDATA[]]></table_prefix>
            </db>
            <default_setup>
                <connection>
                    <host><![CDATA[mysql]]></host>
                    <username><![CDATA[magento]]></username>
                    <password><![CDATA[magento]]></password>
                    <dbname><![CDATA[magento]]></dbname>
                    <active>1</active>
                </connection>
            </default_setup>
        </resources>
        <session_save><![CDATA[files]]></session_save>
    </global>
    <admin>
        <routers>
            <adminhtml>
                <args>
                    <frontName><![CDATA[admin]]></frontName>
                </args>
            </adminhtml>
        </routers>
    </admin>
</config>
````