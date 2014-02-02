The Starbow Forum
=====================

This is the code base for the forum.


Requirements
----------------

```bash
$ sudo apt-get install apache2 php5 mysql-server mysql-client php5-intl php5-gd php5-mysql php5-curl php-apc
```


Installation
----------------

1. Set the forum up to /forum/
2. Go to /forum/install and follow the directions.
3. touch /forum/install/lock, or delete the folder if on production.
4. In admin settings, enable the browserid plugin and disable account registration.

