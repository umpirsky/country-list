<h3 align="center">
    <a href="https://github.com/umpirsky">
        <img src="https://farm2.staticflickr.com/1709/25098526884_ae4d50465f_o_d.png" />
    </a>
</h3>
<p align="center">
  <a href="https://github.com/umpirsky/Symfony-Upgrade-Fixer">symfony upgrade fixer</a> &bull;
  <a href="https://github.com/umpirsky/Twig-Gettext-Extractor">twig gettext extractor</a> &bull;
  <a href="https://github.com/umpirsky/wisdom">wisdom</a> &bull;
  <a href="https://github.com/umpirsky/centipede">centipede</a> &bull;
  <a href="https://github.com/umpirsky/PermissionsHandler">permissions handler</a> &bull;
  <a href="https://github.com/umpirsky/Extraload">extraload</a> &bull;
  <a href="https://github.com/umpirsky/Gravatar">gravatar</a> &bull;
  <a href="https://github.com/umpirsky/locurro">locurro</a> &bull;
  <b>country list</b> &bull;
  <a href="https://github.com/umpirsky/Transliterator">transliterator</a>
</p>

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
- CSV
- SQL
    * MySQL
    * PostgreSQL
    * SQLite
- PHP
- XLIFF

If you intend to use the package with PHP see [this](https://github.com/umpirsky/country-list/blob/master/bin/build#L11-L19).

Multilingual
------------

All formats are also available in multiple languages, please find full language list [here](https://github.com/umpirsky/country-list/tree/master/data).

Build
-----

Country list is available out of the box, but if you want to submit patches, add new formats,
update data source or contribute in any other way, you will probably want to rebuild the list:

```bash
$ docker-compose run php /var/www/html/bin/build -v
```

Other Interesting Lists
-----------------------

* [Currency List](https://github.com/umpirsky/currency-list)
* [Language List](https://github.com/umpirsky/language-list)
* [Locale List](https://github.com/umpirsky/locale-list)
* [TLD List](https://github.com/umpirsky/tld-list)
