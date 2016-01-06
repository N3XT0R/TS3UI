# TS3UI

Develop:
[![Build Status](https://travis-ci.org/N3XT0R/TS3UI.svg?branch=development)](https://travis-ci.org/N3XT0R/TS3UI)
[![Coverage Status](https://coveralls.io/repos/N3XT0R/TS3UI/badge.svg?branch=development)](https://coveralls.io/r/N3XT0R/TS3UI?branch=development)

## Introduction
Web based Management Interface for Teamspeak servers.

![overview](https://raw.githubusercontent.com/N3XT0R/TS3UI/development/docs/screens/overview.png "Overview")

### Features

- Manage dedicated Teamspeak3 Server instances
- Manage virtual Teamspeak3 Server Nodes


Planned Features:

- Provisioning API for Hosters


## Notice
Currently is this Project under development. Do not try to install it.

---------

## Platform Requirements

- PHP 5.5 or higher
    - PHP5-Intl
    - PHP5-pdo
    - PHP5-mbstring
    - PHP5-mcrypt
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

### Create Virtual Host

#### Apache 2.2
```
<VirtualHost *:80>
    ServerName YOUR.FQDN.tld
    DocumentRoot /path/to/TS3UI/public
    <Directory /path/to/TS3UI/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

#### Apache 2.4

```
<VirtualHost *:80>
    ServerName YOUR.FQDN.tld
    DocumentRoot /path/to/TS3UI/public
    <Directory /path/to/TS3UI/public>
        DirectoryIndex index.php
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Login into Application

The Default Credentials for the Application are:

Email: 

admin@example.com

Password:

Administrator