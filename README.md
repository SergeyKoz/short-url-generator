Project 
==================
The web application allows: generate short Urls. Based on Laravel 7

Installation
==================
As the project is dockerized. Yo need to install [docker](https://www.docker.com/)

- Download project from repository
```bash
git clone git@github.com:SergeyKoz/short-url-generator.git
```

Configuration

Create and config file `.env` from `.env.examle`

- Run and init containers
```bash
chmod -R o+w storage
docker-compose up
docker exec url-gen-app /bin/sh -lc "composer install"
docker exec url-gen-app /bin/sh -lc "php artisan migrate"
```

The application is allowed by address [http://127.0.0.1](http://127.0.0.1/)
