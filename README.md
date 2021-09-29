. . <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Local Deploy

Follow these steps for local enviroment setup.

0. Install Composer and Node JS if you don'tnhave them.
1. Clone the repository.
2. Start Aapche and MySQL services if you are using XAMPP.
3. Create a databse in your DB Manager.
5. Edit the .env file, expecially information about application and database.
6. Run the following command in the same order:
	- composer install
	- npm install
	- npm run dev
	- php artisan migrate
	- php artisan db:seed
	- php artisan serve
	
If everything is fine you can open your app on http://localhost:8000 if not fix the errors shown in the termin in order to enable the app to run.

## Server Deploy

1Follow these steps and setup the production Docker enviroment setup for the app.

0. Please be sure you have installed certbot, docker, docker-compose and nginx on your server.
1. In /home/docker create a folder named 'brucifer' and inside create 2 subfolders: 'app', 'db'.
2. In the app folder clone the repository.
3. From the repository open subfolder 'docker' and copy the docker-compose.yml to the root of 'brucifer' folder on server. Also, copy everthing from other subfolders in the same way on the server.
4. Create a new DNS A record for the apropriate subdomain.
5. From the nginx subfolder copy the server.conf into '/etc/nginx/sites-available' and change the respective subdomain. Also, after that create a symbolic link to this file in '/etc/nginx/sites-enabled/'.
6. Run certbot and create a certificate for the subdomain without redirects. In the server configuration file change the name of certificates according to your domain.
7. From the root 'brucifer' folder edit docker-compose.yml so that the given locations are linked properly as well as available ports.
8. From 'brucifer/app' copy 'apache_conf' and edit subdomain name.
9. return to 'brucifer' root folder and run: sudo docker-compose up -d --build --force-recreate --no-deps 
10. If everything is fine your app will work on your subdomain, if not, check with 'sudo docker-compose ps' if the container is running or run 'sudo docker logs container_name' for more information.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
