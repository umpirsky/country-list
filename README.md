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

Country list is available out of the box, but if you want to submit patches, add new formats,
update data source or contribute in any other way, you will probably want to rebuild the list:

```bash
$ composer install --dev
$ ./console build
```

Provinces
---------

If you are looking for the list of provinces of the world, check this [gist](https://gist.github.com/zia-newversion/6755365).


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/umpirsky/country-list/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

