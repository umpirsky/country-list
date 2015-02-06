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
- Objective-c .strings localizable file
- Android xml string resources

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
$ composer install
$ ./console build
