#!/bin/bash
# Uninstall JETMailer

sudo docker stop JETMailerPHP > /dev/null 2>&1
sudo docker rm JETMailerPHP > /dev/null 2>&1
sudo docker stop JETMailerMySQL > /dev/null 2>&1
sudo docker rm JETMailerMySQL > /dev/null 2>&1

echo
echo 'Done'


