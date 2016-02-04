[![Build Status](https://travis-ci.org/cdwv/MysqlDumperCommandBundle.svg)](https://travis-ci.org/KarolNet/TwigRatingFilter) [![Latest Stable Version](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/v/stable)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle) [![Total Downloads](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/downloads)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle) [![Latest Unstable Version](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/v/unstable)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle) [![License](https://poser.pugx.org/cdwv/mysql-dumper-command-bundle/license)](https://packagist.org/packages/cdwv/mysql-dumper-command-bundle)

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