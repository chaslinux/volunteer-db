
[Set Document Root]

sudo ln -s /path/to/your/project /var/www/html/volunteer_registration
sudo chown -R www-data:www-data /var/www/html/volunteer_registration
sudo chmod -R 755 /var/www/html/volunteer_registration

[ Configure Database ]

sudo mysql -u root -p

CREATE DATABASE volunteer_registration;
CREATE USER 'volunteer_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON volunteer_registration.* TO 'volunteer_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

[ Test Setup ]
[APACHE]
echo "Hello, Ubuntu Server!" > /var/www/html/index.html
[PHP]
echo "<?php phpinfo(); ?>" > /var/www/html/info.php
[DATABASE CONNECTION]
<?php
$servername = "localhost";
$username = "volunteer_user";
$password = "password";
$dbname = "volunteer_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
[APACHE SECURITY]
sudo ufw allow 'Apache Full'

