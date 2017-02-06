# TS3UI

Develop:
[![Build Status](https://travis-ci.org/N3XT0R/TS3UI.svg?branch=development)](https://travis-ci.org/N3XT0R/TS3UI)
[![Coverage Status](https://coveralls.io/repos/N3XT0R/TS3UI/badge.svg?branch=development)](https://coveralls.io/r/N3XT0R/TS3UI?branch=development)


## Introduction
Web based Management Interface for Teamspeak servers.

![overview](https://raw.githubusercontent.com/N3XT0R/TS3UI/development/docs/screens/overview.png "Overview")


## Announcement
At the current time i am searching an experienced Webdesigner for this Project.

When you (yes you ;) ) are interested in a great project and also live the opensource Community
maybe you are the right man.

Requirements:

- Experience:
  - Bootstrap
  - Jquery 
  - JS
  - HTML 

* Languages:
Either English or German



have experiences with Bootstrap, Jquery and a good hand for UX and also want to join 
a community Project write me a Message.



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

This Explanation is based on a default LAMP Installation.

### Install Packages

#### Debian / Ubuntu

```
apt-get update
apt-get upgrade -y && apt-get dist-upgrade -y
apt-get install mysql-server apache2 php5 php5-intl php5-mcrypt php5-mysql
```

## Whitelisting

Also when you had running Teamspeak on another server than the Webinterface should run,
you need to modify the whitelist of the Teamspeak-Server.

You find it in the root directory of your Teamspeak-Server:

query_ip_whitelist.txt

Edit it, and append in the next line your webinterface IP-Address.

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

#### PHP.ini
Replace the error_reporting with following:

```
error_reporting=E_ALL & ~ E_DEPRECATED & ~ E_USER_DEPRECATED & ~ E_STRICT
```

## Login into Application

Notice:
You can login into the Application with Email or Username.

The default Credentials for the Application are:

Email: 

admin@example.com

Username:
Administrator

Password:

Administrator