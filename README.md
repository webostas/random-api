# API для генерации случайных чисел

Требования
------------

Для разработки использовался Symfony Framework

PHP 7.1+, Nginx/Apache, MySQL 5.7+

Установка
------------

### 1. Склонировать репозиторий

~~~
git clone https://github.com/webostas/random-api.git
~~~

### 2. Установить пакеты composer

~~~
composer install
~~~

### 3. Миграции

Для приложения необходимо создать базу данных random-api

В .env файле заменить данные для авторизации в базе

~~~
DATABASE_URL=mysql://root:root@127.0.0.1:3306/random-api
~~~

И выполнить миграции

~~~
bin/console migrate
~~~

------------

Приложение будет доступно по пути /random-api

В случае apache:

~~~
http://localhost/random-api/public
~~~