### Setting up volunteer_db

## Step #1 - install server dependencies

Run the ./install-dependencies.sh script on an Ubuntu server. If you use Debian, you will probably have to modify
the script to install default-mysql-server, rather than the mysql-server package that Ubuntu server uses.

## Step #2 - copy PHP files to appropriate directory

Copy the PHP files and .css files from this project to whatever directory you plan to use under /var/www/html. 

For example:
sudo cp *.php *.css /var/www/html/volunteer_registration

## Step #3 - adjust permissions

sudo chown -R www-data:www-data /var/www/html/volunteer_registration
sudo chmod -R 755 /var/www/html/volunteer_registration

## Step #4 - create the database

sudo mysql -u root -p

CREATE DATABASE volunteer_registration;
CREATE USER 'volunteer_user'@'localhost' IDENTIFIED BY 'changethispassword';
GRANT ALL PRIVILEGES ON volunteer_registration.* TO 'volunteer_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

## Step #5 - import the .sql into the database

mysql -u volunteer_user -p volunteer_registration < volunteer.sql

If this does not work, make sure your database username matches, that you have the correct password, and that 
you are in the directory that volunteer.sql is in.

## Step #6 - edit /etc/apache2/sites-available/000-default.conf

In /etc/apache2/sites-available/000-default.conf change the DocumentRoot line from /var/www/html to:

DocumentRoot /var/www/html/volunteer_registration

## Step #7 - reboot 
