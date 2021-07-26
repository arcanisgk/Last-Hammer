# [LH] Last-Hammer Project PHP.

[![GitHub license](https://img.shields.io/github/license/arcanisgk/Last-Hammer)](https://github.com/arcanisgk/Last-Hammer/blob/main/LICENSE)
[![State](https://img.shields.io/static/v1?label=alpha&message=0.1.3&color=blue 'Latest known version')](https://github.com/arcanisgk/Last-Hammer/tree/v0.1.3-alpha) <!-- __SEMANTIC_VERSION_LINE__ -->
[![GitHub issues](https://img.shields.io/github/issues/arcanisgk/Last-Hammer)](https://github.com/arcanisgk/Last-Hammer/issues)
[![Minimum PHP version](https://img.shields.io/static/v1?label=PHP&message=7.4.0+or+higher&color=blue "Minimum PHP version")](https://www.php.net/releases/7_4_0.php)

Acronym: [LH].

Name: Last-Hammer.

Dependencies: Stand Alone / PHP v7.4.

## What is *[LH]* and what does it do?

*[LH]* is a seed of projects prepared to create them from the middle ground.

After installation using the graphical interface you can:
- Create and Manage Users.
- Manage Permissions.
- Create Development Environments from a Dynamic Template Manager.

## Why use *[LH]*?

Today's developers need tools that improve response time to the growing demand for post-pandemic projects.
At this point we know of the existence of multiple frameworks and even Web-based CRM or ERP, but many of these are not very intuitive and require a long learning and development curve to have a final and acceptable product.

*[LH]* is the intermediate point between a Framework, and a CRM / ERP; that allows developers after installation to start project development from a middle ground; entering directly on the objectives of the project and not requiring extensive adaptations or starting from scratch.

## Where to start with *[LH]*?

### Previous requirements:

you'll need:
- Be able to connect via FTP.
- Change the permissions of some files.
- Ability to run .sh files and add them to crontab / jobs.
- knowledge about: `html5`, `css3`, `javascript`, `php`, `bootstrap`, `jquery`, third party `plugin` implementation.

### Implementation of other Side Projects:

*[LH]* implements other parallel projects such as:

- *[BEH]* [Basic Error Handler (SA) for PHP]

*Note: If you want to use them you must configure these projects first.*

[Basic Error Handler (SA) for PHP]: https://github.com/arcanisgk/BEH-Basic-Error-Handler

### PSR version:

*[LH]* uses the latest version of PSR or code style, we can consider that an anti-pattern of coercion is used, all to push the System to comply with a development environment and good practices that facilitate development. But this will be explained more fully in the paradigm definition and in the explanation of the LH skeleton. Although some people do not like the use of magic methods, we can also see a lot of code around them, to facilitate the implementation of dynamic development environments.

*Common development conventions by the Author and Contributors*


## Installation from GitHub:

Please clone `master` branch to require directory

Via SSH

```cmd
git clone git@github.com:arcanisgk/Last-Hammer.git
```

or HTTP

```cmd
git clone https://github.com/arcanisgk/Last-Hammer.git
```

Or download and unzip

```cmd
https://github.com/arcanisgk/Last-Hammer/archive/master.zip
```

## The Architecture and Skeleton Proposed:

LH has a couple of built-in architectures:
1. Core *[LH]*: In this Area you can find all the code related to *[LH]*, mainly the nucleus and its functionality; It is also suggested not to modify it; since the automatic update system manages this part as well as the support from the *[LH]* team.
2. Dynamic Development Area: By using the LH Core, the Dynamic Development Areas found in a subdirectory of *[LH]* are managed; This is or are the areas where the developers will make their private implementations.

- Basic Example:

```
Core
└─ Dinamic Area
```

- Skeleton Example of *[LH]* with Basic Content Project:

```
Last-Hammer
│   <-------------------------------------- START Core *[LH]* -------------------------------------------->
├─.htaccess
├─.user.ini
├─index.php
├─install.php
├─Autoload.php
├─favicon.ico
├─log
├─asset
│ ├─css
│ ├─font
│ ├─img
│ ├─html
│ ├─dic
│ └─js
├─stand-alone
├─config
│ ├─enviroment
│ │ └─default.php
│ ├─client.xml
│ └─server.php
└─App
  ├─Ext
  ├─Core
  │ ├─Generic
  │ │ ├─Data
  │ │ ├─Doc
  │ │ ├─List
  │ │ ├─Cookie.php
  │ │ ├─Date.php
  │ │ ├─Device.php
  │ │ ├─ExecTime.php
  │ │ ├─File.php
  │ │ ├─Http.php
  │ │ ├─Log.php
  │ │ ├─Mail.php
  │ │ ├─Memory.php
  │ │ ├─Session.php
  │ │ ├─User.php
  │ │ └─Vars.php 
  │ ├─Controllers
  │ │ ├─Controller.php
  │ │ ├─Error.php
  │ │ ├─Lang.php
  │ │ ├─Output.php
  │ │ ├─Process.php
  │ │ └─View.php
  │ ├─rep-tpl
  │ │ ├─c
  │ │ │ └─c_0000.php
  │ │ ├─k
  │ │ │ └─k_0000.php
  │ │ ├─w
  │ │ │ └─w_0000.php
  │ │ └─d
  │ │   ├─dic
  │ │   │ └─dic.xml
  │ │   ├─script
  │ │   │ ├─jsc.js
  │ │   │ ├─event.php
  │ │   │ └─list.php
  │ │   └─tpl
  │ │     ├─form.php
  │ │     ├─form-s.php
  │ │     ├─form-m.php
  │ │     ├─form-ms.php
  │ │     └─form-h.php
  │ └─Sys
  │   └─D_example
  │     ├─dic
  │     │ └─dic.xml
  │     ├─Script
  │     │ ├─Jsc.js
  │     │ ├─Event.php
  │     │ └─List.php
  │     └─tpl
  │       ├─form.php
  │       ├─form-s.php
  │       ├─form-m.php
  │       ├─form-ms.php
  │       └─form-h.php
  │ <-------------------------------------- END Core *[LH]* -------------------------------------------->
  │ <----------------------------- START Dynamic Development Area -------------------------------------->
  └─Workspace
    ├─Generic
    │ ├─Data
    │ │ └─Chain.php
    │ ├─Docs
    │ │ └─Factures.php
    │ └─List
    │   └─Vehicles.php
    ├─Cron
    │ ├─List.php
    │ └─C_0001.php
    ├─Keeper
    │ ├─List.php
    │ └─K_0001.php
    ├─Web-Service
    │ ├─Api.php
    │ └─W_0001.php
    └─Modules
      └─D_example_0001
        ├─dic
        │ └─dic.xml
        ├─Script
        │ ├─Jsc.js
        │ ├─Event.php
        │ └─List.php
        └─tpl
          ├─form.php
          ├─form-s.php
          ├─form-m.php
          ├─form-ms.php
          └─form-h.php
    <----------------------------- END Dynamic Development Area -------------------------------------->
```



## Initial pre-configuration

### Step 1.: [Implementation of other Side Projects]:

We recommend that all separate projects be configured first. before starting LH.

[Implementation of other Side Projects]: https://github.com/arcanisgk/Last-Hammer#implementation-of-other-side-projects

### Step 2.: go to installation URL:


https://project-url/install.php









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



### Contributing:

Thank you for considering contributing to the Last Hammer project! The contribution guide can be found in the Last Hammer documentation.

### Security Vulnerabilities  
If you discover a security vulnerability within Last Hammer, please DO NOT create issue, please contact the author and/or security team instead.

## License 

The Last Hammer project is open-source software licensed under the MIT license.




### Contributors
- (c) 2020 Walter Francisco Núñez Cruz icarosnet@gmail.com [![Donate](https://img.shields.io/static/v1?label=Donate&message=PayPal.me/wnunez86&color=brightgreen)](https://www.paypal.me/wnunez86/4.99USD)
- (c) 2020 Marcus Biesioroff biesior@gmail.com [![Donate](https://img.shields.io/static/v1?label=Donate&message=PayPal.me/biesior&color=brightgreen)](https://www.paypal.me/biesior/4.99EUR)

