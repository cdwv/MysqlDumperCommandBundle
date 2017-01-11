<?php

namespace CodeWave\MysqlDumperCommandBundle\CommandBuilder;

use Doctrine\DBAL\Connection;

interface DumpCommandBuilderInterface
{
    public function buildCommand(Connection $connection, $path);
}