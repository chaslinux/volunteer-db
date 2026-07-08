#!/bin/bash

sudo apt update && sudo apt upgrade -y

sudo apt -y install apache2
sudo systemctl start apache2
sudo systemctl status apache2
sudo systemctl enable apache2

sudo apt -y install mysql-server
sudo mysql_secure_installation

sudo systemctl start mysql
sudo systemctl status mysql
sudo systemctl enable mysql

sudo apt -y install php libapache2-mod-php php-mysql
sudo apt -y install php-mbstring
sudo systemctl restart apache2

sudo apt -y install git

sudo a2enmod rewrite
sudo systemctl restart apache2


