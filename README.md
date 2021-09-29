# BRUCIFER 

Web application for selling tickets to freshmen students and registrating entered guests on festival.

## Local Deploy

Follow these steps for local enviroment setup.

0. Install Composer and Node JS if you don't have them.
1. Clone the repository.
2. Start Apache and MySQL services if you are using XAMPP.
3. Create a databse in your DB Manager named 'brucifer'.
5. Rename the .env.example file to .env file.
6. Make changes to your .env file: 
	- set APP_URL to 'http://localhost' (add port if necessary)  
	- set APP_ENV to 'local'
	- set APP_DEBUG to 'true'
	- create Google OAuth credentials and enter GOOGLE_ID, GOOGLE_SECRET, GOOGLE_REDIRECT ('http://localhost/auth/google/callback)
	- create a local database 'brucifer' iusing your DB manager
	- set DB_HOST to '127.0.0.1'
	- set DB_USERNAME to 'root' or to a username you are using
	- set DB_PASSWORD to your root/chosen user password or leave empty if you don't use it
7. Check the rest of the information in the .env file to be sure if anything else needs to be changed depending on your local setup (for example DB_PORT or DB_NAME).
8. Run the following commands in the same order:
	- composer install --ignore-platform-reqs
	- npm install
	- npm run dev
	- php artisan key:generate
	- php artisan migrate
	- php artisan db:seed
	- php artisan serve
	
If everything is correct, you can open your app on http://localhost:8000. If not, fix the errors shown in the output in order to enable the app to run normally.

If you want to use the app after login, set the column 'role' in the DB directly to the value 1 or open endpoint /make_admin.

## Server Deploy

Follow these steps and setup the production Docker enviroment prepared for the app.

0. Please be sure you have installed 'certbot', 'docker', 'docker-compose' and 'nginx' (or other web server) on your machine.
1. In /home/docker create a folder named 'brucifer' and inside create 2 subfolders: 'app' and 'db'.
	1.1. Create subfoder 'init' if you have an SQL database example with dummy data to start with and put the database into the subfolder.
2. In the 'app' folder clone the app repository.
3. From the Git repository ('brucosijada-karte') open the subfolder 'docker' and copy the 'docker-compose.yml' to the root of 'brucifer' folder on server.
4. Edit the 'docker-compose.yml':
	- set 'MYSQL_ROOT_PASSWORD' in 'brucifer-db' service
	- change 'ports' inside 'brucifer-app' service if needed
5. From 'brucifer/app/brucosijada-karte/docker/app' copy the Dockerfile and apache_conf into 'brucifer/app'.
6. In the 'apache_conf' change the ServerName and ServerAdmin information.
7. Create a new DNS A record for the apropriate subdomain you are going to use for your app with TTL 300.
8. From the 'brucifer/app/brucosijada-karte/docker/nginx' subfolder copy the 'brucifer.conf' into '/etc/nginx/sites-available' and change the data under comments. After that create a symbolic link to this file in '/etc/nginx/sites-enabled/' directory. (If you are using nginx as outher web server).
9. Run 'certbot' and create a certificate for the subdomain without redirects. In the nginx server configuration file change the name of certificates according to your domain.
10. Rename the .env-example to -env file and edit_
	- set 'APP_ENV' to 'production'
	- set 'APP_DEBUG' to 'false'
	- set the 'APP_URL' 
	- set 'GOOGLE_ID', 'GOOGLE_SECRET' and 'GOOGLE_REDIRECT' with the new credentials
	- set 'DB_HOST' to database container name
	- set 'DB_USERNAME' to 'root'
	- set 'DB_PASSWORD' the same as 'MYSQL_ROOT_PASSWORD' from the 'docker-compose.yml'
	- check if ports or any other information is necessary to change
11. Return to 'brucifer' root folder and run the command: 'sudo docker-compose up -d --build --force-recreate --no-deps'. 
12. If everything is fine your app will work on your subdomain, if not, check with 'sudo docker-compose ps' if the container is running or run 'sudo docker logs container_name' for more information.



