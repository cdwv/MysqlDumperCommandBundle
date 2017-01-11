<?php

namespace CodeWave\MysqlDumperCommandBundle\FileSystem;

interface FileNameBuilderInterface
{
    public function buildName($databaseName);
}