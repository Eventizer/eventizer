#!/bin/sh

# Site cronjobs
echo "Running main cronjob"

fileLock='./cron/cron.lock'

if [ -f $fileLock ];
then 
    echo "Lock file exists, skipping execution";
else
    touch $fileLock;
   	/usr/bin/php cron.php -s site_admin -c cron/cron > cron/log/cron.log
    rm -f $fileLock;
fi