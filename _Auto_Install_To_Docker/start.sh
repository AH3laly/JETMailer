#!/bin/bash
# Start JETMailer

sudo docker stop JETMailerPHP > /dev/null 2>&1
sudo docker start JETMailerPHP > /dev/null 2>&1 || (echo "Error: Cannot start Docker Container")
sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan queue:work &
sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan serve --host JETMailerWeb --port 8090

echo
echo 'Done'

