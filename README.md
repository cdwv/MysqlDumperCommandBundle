[![Build Status](https://travis-ci.org/cdwv/MysqlDumperCommandBundle.svg)](https://github.com/cdwv/MysqlDumperCommandBundle) [![Latest Stable Version](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/v/stable)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle) [![Total Downloads](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/downloads)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle) [![Latest Unstable Version](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/v/unstable)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle) [![License](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/license)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle)

Description
------------
Simple Symfony task for create backup/dump mysql database

Installation
------------

```
composer require cdwv/mysql-dumper-command-bundle
```

add bundle to AppKernel:
```
 new CodeWave\MysqlDumperCommandBundle\CodeWaveMysqlDumperCommandBundle(),
```

Run:
------------

```
    app/console cdwv:database:dump
```

Configuration:
--------------

```
code_wave_mysql_dumper_command:
    date_template: 'Y-m-d_H:i:s'
    base_directory: '%kernel.root_dir%/../database_dump'
```

Defaults:
---------

```
code_wave_mysql_dumper_command:
    date_template: 'd-m-Y_h-i'
    base_directory: '.'
```


## License
The MIT License &copy; 2015 - 2016
