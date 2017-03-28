<?php

namespace CodeWave\MysqlDumperCommandBundle\CommandBuilder;

use Doctrine\DBAL\Connection;

class MysqlDumpCommandBuilder extends DumpCommandBuilder
{
    public function buildCommand(Connection $connection, $path)
    {
        if (!$path) {
            $path = '.';
        }

        $fileName = $this->fileNameBuilder->buildName($connection->getDatabase());
        $fullPath = $path . '/' . $fileName;

        $command = 'mysqldump ';

        if ($connection->getUsername()) {
            $command = $command . ' -u ' . $connection->getUsername();
        }

        if ($connection->getPort()) {
            $command = $command . ' --port=' . $connection->getPort();
        }

        if (!$connection->getDatabase()) {
            throw new \RuntimeException('No database!');
        }

        if ($connection->getHost()) {
            $command = $command . ' -h ' . $connection->getHost();
        }

        $command = $command . ' --single-transaction ' . $connection->getDatabase();

        if ($connection->getPassword()) {
            $command = $command . ' -p' . $connection->getPassword();
        }

        $command .= $this->getCompressionCommand();

        $command .= ' > ' . $fullPath;

        $command .= $this->getCompressionExtension();

        return $command;
    }
}
