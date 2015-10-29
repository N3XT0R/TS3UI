# TS3UI

Develop:
[![Build Status](https://travis-ci.org/N3XT0R/TS3UI.svg?branch=development)](https://travis-ci.org/N3XT0R/TS3UI)
[![Coverage Status](https://coveralls.io/repos/N3XT0R/TS3UI/badge.svg?branch=development)](https://coveralls.io/r/N3XT0R/TS3UI?branch=development)

## Introduction
Web based Management Interface for Teamspeakservers.


## Notice
Currently is this Project under development. Do not try to install it.

---------

## Installation

### Install Composer 

```
php composer.phar self-update
php composer.phar install
```

### Create Database & Import Data

```
./vendor/bin/doctrine-module orm:schema-tool:drop --force
./vendor/bin/doctrine-module orm:schema-tool:create
./vendor/bin/doctrine-module orm:validate-schema
./vendor/bin/doctrine-module orm:generate:proxies
./vendor/bin/doctrine-module data-fixture:import
```