## `Last-Hammer` project

[![State](https://img.shields.io/static/v1?label=alpha&message=0.1.3&color=blue 'Latest known version')](https://github.com/arcanisgk/Last-Hammer/tree/0.1.3-alpha) <!-- __SEMANTIC_VERSION_LINE__ -->
![Updated](https://img.shields.io/static/v1?label=upated&message=2020-08-26+18:04:54&color=lightgray 'Latest known update date') <!-- __SEMANTIC_UPDATED_LINE__ -->
[![Minimum PHP version](https://img.shields.io/static/v1?label=PHP&message=7.2.0+or+higher&color=blue "Minimum PHP version")](https://www.php.net/releases/7_2_0.php)

Last Hamer is a pre-built platform for creating applications, as if you were working with a framework; but particularly it has a graphical interface that allows starting in the following way:
-   Configure the System data.
-   Configure the Client / User / Company data.
-   Raise the system structure, based on form screens:
    -   Maintenance.
    -   Process stages screens.
    -   Approvals.
    -   Reports and Lists.

Note: It also has support for the Execution of Crons Jobs; but requires access to the System Cron Task Manager

## What you need to know when starting development:

- Mainly used PHP in its latest version 7.2
- HTML5 and a custom version of Bootstrap will also be used simply to enrich the color palette (Bootstrap 4.5).
- Also CSS3 is used and in the Extensions area you will find the additional libraries and their versions.

## PSR version:

Last-Hammer does not use a specific version of PSR or code style, we can really consider that an anti-pattern is used, and all the system is embedded in the defined objects and constants, this will be better explained in the definition of classes, functions, variables and constants.

#### (The architecture proposed)

-   to be defined

## Contributing:

Thank you for considering contributing to the Last Hammer project! The contribution guide can be found in the Last Hammer documentation.

### Security Vulnerabilities  
If you discover a security vulnerability within Last Hammer, please DO NOT create issue, please contact the author and/or security team instead.

## License 

The Last Hammer project is open-source software licensed under the MIT license.

## Installation from GitHub:

Please clone `master` branch to required directory

```
git clone https://github.com/arcanisgk/Last-Hammer.git
```

Or download and unzip

```
https://github.com/arcanisgk/Last-Hammer/archive/master.zip
```

## Initial configuration

#### Step 1.: Setup .htaccess

set correct path to error handler with pattern `<DocumentRoot>/configs/error/error.php`  
Where `<DocumentRoot>` is equal to your vhost's `DocumentRoot` directive, samples:

```
#php_value auto_prepend_file "/var/www/html/configs/error/error.php"
php_value auto_prepend_file "C:/xampp/htdocs/configs/error/error.php"
```

And Remove Error not supported from the list:

```
    ErrorDocument 100 /configs/error/errorstatus.php
    ErrorDocument 101 /configs/error/errorstatus.php
    ErrorDocument 102 /configs/error/errorstatus.php
    ErrorDocument 201 /configs/error/errorstatus.php
    ErrorDocument 202 /configs/error/errorstatus.php
    ErrorDocument 203 /configs/error/errorstatus.php
    ErrorDocument 204 /configs/error/errorstatus.php
    ErrorDocument 205 /configs/error/errorstatus.php
    ErrorDocument 206 /configs/error/errorstatus.php
    ErrorDocument 207 /configs/error/errorstatus.php
    ErrorDocument 208 /configs/error/errorstatus.php
    ErrorDocument 226 /configs/error/errorstatus.php
    ErrorDocument 300 /configs/error/errorstatus.php
    ErrorDocument 301 /configs/error/errorstatus.php
    ErrorDocument 302 /configs/error/errorstatus.php
    ErrorDocument 303 /configs/error/errorstatus.php
    ErrorDocument 304 /configs/error/errorstatus.php
    ErrorDocument 305 /configs/error/errorstatus.php
    ErrorDocument 307 /configs/error/errorstatus.php
    ErrorDocument 308 /configs/error/errorstatus.php
    ErrorDocument 400 /configs/error/errorstatus.php
    ErrorDocument 401 /configs/error/errorstatus.php
    ErrorDocument 402 /configs/error/errorstatus.php
    ErrorDocument 403 /configs/error/errorstatus.php
    ErrorDocument 404 /configs/error/errorstatus.php
    ErrorDocument 405 /configs/error/errorstatus.php
    ErrorDocument 406 /configs/error/errorstatus.php
    ErrorDocument 407 /configs/error/errorstatus.php
    ErrorDocument 408 /configs/error/errorstatus.php
    ErrorDocument 409 /configs/error/errorstatus.php
    ErrorDocument 410 /configs/error/errorstatus.php
    ErrorDocument 411 /configs/error/errorstatus.php
    ErrorDocument 412 /configs/error/errorstatus.php
    ErrorDocument 413 /configs/error/errorstatus.php
    ErrorDocument 414 /configs/error/errorstatus.php
    ErrorDocument 415 /configs/error/errorstatus.php
    ErrorDocument 416 /configs/error/errorstatus.php
    ErrorDocument 417 /configs/error/errorstatus.php
    ErrorDocument 421 /configs/error/errorstatus.php
    ErrorDocument 422 /configs/error/errorstatus.php
    ErrorDocument 423 /configs/error/errorstatus.php
    ErrorDocument 424 /configs/error/errorstatus.php
    ErrorDocument 426 /configs/error/errorstatus.php
    ErrorDocument 428 /configs/error/errorstatus.php
    ErrorDocument 429 /configs/error/errorstatus.php
    ErrorDocument 431 /configs/error/errorstatus.php
    ErrorDocument 451 /configs/error/errorstatus.php
    ErrorDocument 500 /configs/error/errorstatus.php
    ErrorDocument 501 /configs/error/errorstatus.php
    ErrorDocument 502 /configs/error/errorstatus.php
    ErrorDocument 503 /configs/error/errorstatus.php
    ErrorDocument 504 /configs/error/errorstatus.php
    ErrorDocument 505 /configs/error/errorstatus.php
    ErrorDocument 506 /configs/error/errorstatus.php
    ErrorDocument 507 /configs/error/errorstatus.php
    ErrorDocument 508 /configs/error/errorstatus.php
    ErrorDocument 510 /configs/error/errorstatus.php
    ErrorDocument 511 /configs/error/errorstatus.php
```

#### Step 2.: Setup DB Connection

go to and Edit: `/build/setup/config-inc.php`

Set your credential for DB Connection:

```php
<?php

# ! Warning do not change DBDEFAULT_NAME, DBSOFT_NAME, DBSOFT_SUBSYSTEM

CoreApp::$ovars['SYS']['CONF'] = [
    'SOFTWARE' => [
        'SOFT_VERSION'     => '1.0',
        'HOST_LICENSE'     => '',
        'HOST_KEY'         => '',
        'DBDEFAULT_HOST'   => '127.0.0.1',
        'DBDEFAULT_PORT'   => '3306',
        'DBDEFAULT_NAME'   => 'lasthammer',
        'DBDEFAULT_USER'   => 'root',
        'DBDEFAULT_PASS'   => '123456',
        'DBSOFT_NAME'      => 'last_hammer',
        'DBSOFT_SUBSYSTEM' => 'lh_subsystem',
        'DBSOFT_USER'      => 'root',
        'DBSOFT_PASS'      => '123456',
        'USADMIN_NAME'     => 'admin',
        'USADMIN_PASS'     => 'admin'
    ]
];
```

#### Step 3.: Setup Software Configuration

go to and Edit: `/configs/const /conf.xml`

Set your software configuration:

```xml
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xml>
<data>
    <setup>
        <protocol>HTTP</protocol>
        <session_expiration>true</session_expiration>
        <session_inactivity>true</session_inactivity>
        <cookies_httponly>true</cookies_httponly>
        <session_byhour>8</session_byhour>
        <user_acc_restore>true</user_acc_restore>
        <user_acc_restore_by>email,cid,username</user_acc_restore_by>
        <user_acc_change_pass>true</user_acc_change_pass>
        <user_acc_registry>true</user_acc_registry>
        <user_acc_registry_by_mod>true</user_acc_registry_by_mod>
    </setup>
</data>
```

#### Step 4.: Setup Client Configuration

go to and Edit: `/configs/const/client.xml`

Set your Client configuration:

```xml
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE xml>
<data>
    <company>
        <cname>Icaros Net S.A.</cname>
        <cid>RUC: 6-711-334 DIV: 40</cid>
        <caddress>Panama</caddress>
        <cphone>+507 6314-6497</cphone>
        <cemail>w.nunez.09@outlook.com</cemail>
        <curlmain>localhost</curlmain>
        <curlstore></curlstore>
    </company>
    <contact>
        <contname>Tecnología</contname>
        <contlastname>y Desarrollo</contlastname>
        <contmail>w.nunez.09@outlook.com</contmail>
        <contphone>+507 6314-6497</contphone>
    </contact>
    <software>
        <sysname>Last Hammer Open Source ERP</sysname>
        <sysnamec>Last-Hammer-Open-Source-ERP</sysnamec>
        <sysowner>Last Hammer</sysowner>
        <license>#############################</license>
        <token>#############################</token>
        <version>1.0</version>
        <build>2020.06</build>
        <zone>America/Panama</zone>
        <home help="1=Dashboard,2=Web Site,3=Web Store">1</home>
        <lang>es_LA</lang>
        <appandroid>#############################</appandroid>
        <appios>#############################</appios>
    </software>
</data>
```

