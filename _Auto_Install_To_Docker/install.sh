#!/bin/bash
# Install JETMailer

TEMP_DIR=/tmp

# Create (if not exists) and move to the temprary directory
mkdir $TEMP_DIR > /dev/null 2>&1
cp docker-compose.yml $TEMP_DIR > /dev/null 2>&1 || (echo "Error: Cannot access docker-compose.yml file"; exit)
cd $TEMP_DIR > /dev/null 2>&1 || (echo "Error: Cannot open the temp dir"; exit)

# Check required commands
composer -V > /dev/null 2>&1 || (echo "Composer Not Installed"; echo Please Install Composer; exit)
git --version > /dev/null 2>&1 || (echo "Git Not Installed"; echo Please install Git; exit)
docker -v > /dev/null 2>&1 || (echo "docker Not Installed"; echo Please install Docker; exit)
docker-compose -v > /dev/null 2>&1 || (echo "docker-compose Not Installed"; echo Please install Docker-Compose; exit)

# Stop and remove JETMailer Docker containers if exist
sudo docker stop JETMailerPHP > /dev/null 2>&1
sudo docker rm JETMailerPHP > /dev/null 2>&1
sudo docker stop JETMailerMySQL > /dev/null 2>&1
sudo docker rm JETMailerMySQL > /dev/null 2>&1

# Build docker machines
sudo docker-compose up -d

# Install some php libraries to Docker container
echo Installing PHP Libraries to Docker Container.
echo Please Wait ....
sudo docker-compose exec JETMailerWeb docker-php-ext-install pdo pdo_mysql mbstring > /dev/null 2>&1

# Do cleanup before starting
rm -rf FinalProject > /dev/null 2>&1
rm -rf LaravelFresh/ > /dev/null 2>&1
rm -rf JETMailer/ > /dev/null 2>&1

# Download fresh Laravel project
composer create-project --prefer-dist laravel/laravel LaravelFresh

# Download JetMailer from github
git clone https://github.com/AH3laly/JETMailer.git

# Merge fresh Laravel project with JETMailer
mkdir FinalProject
cp -rf LaravelFresh/*.* FinalProject > /dev/null 2>&1
cp -rf LaravelFresh/* FinalProject > /dev/null 2>&1
cp -rf LaravelFresh/.* FinalProject > /dev/null 2>&1
cp -rf JETMailer/*.* FinalProject > /dev/null 2>&1
cp -rf JETMailer/* FinalProject > /dev/null 2>&1
cp -rf JETMailer/.* FinalProject > /dev/null 2>&1

# Update JETMailer configuration on Docker container
cd FinalProject > /dev/null 2>&1 || (echo Error selecting project directory; exit)
sed -i 's/DB_PASSWORD=/DB_PASSWORD=A123654Z/g' .env
sed -i 's/QUEUE_CONNECTION=sync/QUEUE_CONNECTION=database/g' .env
sed -i "s/DB_HOST=127.0.0.1/DB_HOST=JETMailerDB/g" .env
composer update
cd ..

# Copy project folder to Docker container
sudo docker cp "FinalProject/" JETMailerPHP:"/var/www/html/JETMailer"

# Initialize and install JETMailer on Docker container
sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan migrate:fresh

sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan jetMailer:CreateMTA --host=smtp1.somedomain.local --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"

sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan jetMailer:CreateMTA --host=smtp2.somedomain.local --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"

sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan jetMailer:CreateMTA --host=smtp3.somedomain.local --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"

sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan jetMailer:CreateMTA --host=smtp4.somedomain.local --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"

sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan jetMailer:CreateMTA --host=smtp5.somedomain.local --port=587 --security=tls --username=smtpuser --password="MyVeryLongAndComplexPassword"

sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan queue:work &
sudo docker exec -itd JETMailerPHP php /var/www/html/JETMailer/artisan serve --host JETMailerWeb --port 8090

# Do Cleanup
rm -rf FinalProject > /dev/null 2>&1
rm -rf LaravelFresh/ > /dev/null 2>&1
rm -rf JETMailer/ > /dev/null 2>&1


echo JETMailer is running on: http://localhost:8090
echo
echo 'To stop the Container execute: stop.sh'
echo 'To start the Container execute: start.sh'
echo
