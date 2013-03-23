Country List
============

List of all countries with names and ISO 3166-1 codes in all languages and all data formats.

Formats Available
-----------------

- Text
- JSON
- YAML
- XML
- HTML
    * Select ([demo](http://country-list.umpirsky.com/country.html))
    * Flags ([demo](http://country-list.umpirsky.com/country.flags.html))
- CSV
- SQL
    * MySQL
    * PostgreSQL
    * SQLite
    * SQL Server
- PHP

Multilingual
------------

All formats are also available in multiple languages, please find full language list [here](https://github.com/umpirsky/country-list/tree/master/country/cldr).

Where Does the Data Come From?
------------------------------

For now, I have implemented two data importers:

* ICU (imports data from [ICU](http://site.icu-project.org/))
* CLDR (imports data from [CLDR](http://cldr.unicode.org/))

So, if country list changes in the future, it will be very easy to update our country list.

Build
-----

To build all available country-list data, execute the following commands.

Checkout the github repo:

```bash
$ git clone git://github.com/umpirsky/country-list.git
$ cd country-list
```

On Debian/Ubuntu, execute:

```bash
$ sudo apt-get -y install php5 php5-intl 
$ curl -sS https://getcomposer.org/installer | php
$ ./composer.phar update # to install the runtime dependencies
$ php console list # to list all available console commands
$ php console build # to create all the nice country-list data formats
```

After this, you will get all the country-list files in the formats listed above.

To list the generated files, execute:

```bash
$ ls -1 country/*/*
```
