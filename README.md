# Trip Booking App

## Introduction

* Recycled from https://github.com/Jerry-BloodBerry/Symfony-Trip-e-commerce

## Installation

1. Configure your MySQL / Mariadb database URL in your `.env.local` file

```
# .env.local
DATABASE_URL=mysql://root:root@localhost:3306/trip_booking_app?serverVersion=11.2.2-MariaDB&charset=utf8mb4
```

2. Install third party PHP dependencies

```
$ symfony composer install
```

3. Setup the database

```
$ symfony console doctrine:database:create
$ symfony console doctrine:migration:migrate
$ symfony console doctrine:fixtures:load
```

4. Run the Symfony local PHP Web server

```
$ symfony server:start -d
```

5. Open the application in your Web browser

```
$ open https://127.0.0.1:8000/
```