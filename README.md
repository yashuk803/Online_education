Symfony DEMO Onlain Education Application
===================

This Application  in future  will be a  that platform is designed to create and distribute interactive educational content . Platform is suitable for a multitude of e-learning activities.

------------

Requirements
-----
* PHP 7.3 or higher;
* Nginx:1.15;
* mysql:5.7;
* and the usual [Symfony website-skeleton.](https://symfony.com/doc/current/setup.html );

Installation
----------------

Clone this project 

```
$ https://github.com/yashuk803/Online_education.git
```


Usage
----------------
At start enter in root folder of application
```
cd my_project/
```

Create file .env.local
 
Replace your values instead of variables "user"
```
APP_ENV=dev
APP_SECRET=fe69862aa989924eea75eb93ed33d64c
DATABASE_URL=mysql://user:user@mysql:3306/your_database
  
MYSQL_DATABASE=user
MYSQL_USER=user
MYSQL_PASSWORD=user
MYSQL_HOST=mysql
MYSQL_PORT=3306
```

Run command:

```
$ docker-compose up
```

Tests
-------

Execute this command to run tests:

```
$ cd my_project/
$ ./bin/phpunit
```
