# TS3UI

Develop:
[![Build Status](https://travis-ci.org/N3XT0R/TS3UI.svg?branch=development)](https://travis-ci.org/N3XT0R/TS3UI)
[![Coverage Status](https://coveralls.io/repos/N3XT0R/TS3UI/badge.svg?branch=development)](https://coveralls.io/r/N3XT0R/TS3UI?branch=development)

## Introduction
Web based Management Interface for Teamspeak servers.

![overview](https://raw.githubusercontent.com/N3XT0R/TS3UI/development/docs/screens/overview.png "Overview")


## Notice
Currently is this Project under development. Do not try to install it.

---------

## Platform Requirements

- PHP 5.5 or higher
    - PHP5-Intl
    - PHP5-pdo
    - PHP5-mbstring
- MySQL or MariaDB
- Apache-Webserver or etc. (Nginx, Lighttpd, ...)
- git

## Installation

### Get it from git

```
git clone https://github.com/N3XT0R/TS3UI.git
cd TS3UI
```

### Install Composer 

```
php composer.phar self-update
php composer.phar install
php composer.phar update
```

### Configure Database

Edit /config/autoload/database.global.php and configure there your Database-
Connection.


### Create Database-Schema & Import initial Data

```
./vendor/bin/doctrine-module orm:schema-tool:drop --force
./vendor/bin/doctrine-module orm:schema-tool:create
./vendor/bin/doctrine-module orm:validate-schema
./vendor/bin/doctrine-module orm:generate:proxies
./vendor/bin/doctrine-module data-fixture:import
```

### Generate Assets

```
php ./public/index.php assetmanager warmup
```

## Login into Application

The Default Credentials for the Application are:

Email: 

admin@example.com

Password:

Administrator