#!/bin/sh

mysqldump -u root -proot NJITsoccer | gzip > /var/www/html/NJITsoccer3/backups/mysqldb_`date +%Y%m%d%T%p`.sql.gz
