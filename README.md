# Facebook Photos

For Ross D. and Jason T.

## Installation Instructions

1. `git clone https://github.com/kgust/vu-facebook.git`
2. `php composer.phar install` If you don't have composer, see [getcomposer.org](https://getcomposer.org/).
3. Create your database instance.
4. Enter your database configuration values in [config.php](https://github.com/kgust/vu-facebook/blob/master/config.php).
4. Create the photos table (see [schema.sql](https://github.com/kgust/vu-facebook/blob/master/schema.sql)).
5. Run `php fetch.php` to pull photo data from the Vanderbilt Photo
   stream. This can be run as many times as you wish (daily via
   CRON?), it will insert or update the values as appropriate.
6. Configure your webserver to route all links to index.php. I used
   Nginx with PHP-FPM. Alternatively, you can use the PHP built-in
   webserver. `php -S 127.0.0.1:8000 index.php`

## Summary

### Task 1: Retrieve a list of list of photos from the Facebook Graph API.

Start by looking at [fetch.php](https://github.com/kgust/vu-facebook/blob/master/fetch.php)
to see the downloading and parsing logic.

### Task 2: Create an interface that displays a list of photos and allows user to view details.

Look [index.php](https://github.com/kgust/vu-facebook/blob/master/index.php)
for the routes and the [src/](https://github.com/kgust/vu-facebook/tree/master/src)
directory for the interface controllers and views.

## My Process

I took the long route developing this but had a lot of fun creating
it and learned more about the framework bootstrapping process.

I rejected the idea of three simple procedural scripts. While they
would be simple to create, do not show the style of work that I'm
used to now. Plus mixing view, database, and business logic into a
single file is more like 2005 than 2015. Oh, and the URLs would be
really ugly.

Let's call this a micro-microframework. I started by researching the
[route](http://route.thephpleague.com/) package by
[The League of Extraordinary Packages](http://thephpleague.com/).
This is my only dependency. Using `route` allowed me to organize my
code into the familar Model-View-Controller pattern.

I don't actually have the model layer. I'm using a DatabaseProvider
to load the PDO class. My use case is simple enough that I didn't
need to create models. Views also are simple, HTML files with
embedded PHP.

I had no prior experience with the Facebook Graph API and found
that getting the data that I wanted was more challenging than I
initially anticipated. The API, by default, only provides 25 items
in a collection (e.g. 25 photos or 25 Like nodes).

Learning the Facebook paging process gave me access to all of the
photos. Applying the same process to the Like nodes gave me a Like
count. However, the fetching process was very slow and my Like
counts were off.

PHP and Nginx both have a 30 second limit for running PHP scripts.
I changed my fetching logic, moving the code into a command-line
script that runs mostly outside the framework.

I resolved the Like count problem and the performance problems when
I discovered that the Facebook Graph API can produce summaries.  I
now had accurate Like counts and eliminated the Like node paging.
This also fixed the performance issues.

Getting this running on the [LEMP](https://lemp.io/) server was
easy. Getting it running in Docker would also be very easy. :smile:
That would be an exercise for another day. Let me know if you have
any questions. Enjoy!
