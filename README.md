ladensia
========

An E-Commerce Project based on Symfony2.

You can see a demo of Ladensia Shop on http://demo.ladensia.de

Please notice that not all Bundles of this Application are not fully functional, tested and 
still in development. And shouldn't be used in a productiv enviroment without modification and/or testing.

This document contains information on how to install and start
using Ladensia Shop System. 

## [Help the project](http://pledgie.com/campaigns/20121)

[![Help the project](http://www.pledgie.com/campaigns/20121.png?skin_name=chrome)](http://pledgie.com/campaigns/20121)

1. Installation
---------------

The following Folders must be writeable:

- app/cache
- app/logs
- web/uploads

If you don't have installed Composer read the Instructions on this Site:

http://getcomposer.org/ 

Install the vendors:

 curl -s http://getcomposer.org/installer | php

 php composer.phar install

You need to change the database parameters in app/config/parameters.ini so
the application can connect to your database.

You can use 

 php app/console doctrine:schema:create
 
to create the database schema or you can import the ladensia.sql file.

You need to create a super admin user to access the admin interface use
this command to create on:

 php app/console fos:user:create adminuser --super-admin
 
you can find more details here:

https://github.com/FriendsOfSymfony/FOSUserBundle/blob/master/Resources/doc/command_line_tools.md

2. System Requirements
----------------------

- PHP 5.3 or higher
- php intl extension
- set date.timezone in your php.ini
- php apc extension
- php mod rewrite extension
- php gd2 extension
- php imagick extension

3. Images - Shop Frontend
-------------------------

Homepage
![](http://ladensia.de/img/demo1.png)

Product Details
![](http://ladensia.de/img/demo5.png)
